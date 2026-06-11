<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class TicketController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $isAdmin = $user->hasRole('admin');

        $tickets = Ticket::query()
            ->with(['auto:id,marca,modelo,anio,imagen', 'cliente:id,name,email', 'admin:id,name,email'])
            ->withCount('mensajes')
            ->when(! $isAdmin, fn ($query) => $query->where('cliente_id', $user->id))
            ->when($isAdmin && $request->query('filtro') === 'sin_reclamar', fn ($query) => $query
                ->whereNull('admin_id')
                ->where('estado', '!=', 'cerrado'))
            ->orderByDesc('last_message_at')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->through(fn (Ticket $ticket) => $this->ticketRow($ticket));

        return Inertia::render('Tickets/Index', [
            'isAdmin' => $isAdmin,
            'filtro' => $request->query('filtro', 'todos'),
            'tickets' => $tickets,
        ]);
    }

    public function start(Request $request, Auto $auto): RedirectResponse
    {
        abort_unless($auto->publicado, 404);

        $user = $request->user();

        DB::beginTransaction();

        try {
            $ticket = Ticket::query()
                ->where('auto_id', $auto->id)
                ->where('cliente_id', $user->id)
                ->where('estado', 'abierto')
                ->first();

            if (! $ticket) {
                $ticket = Ticket::create([
                    'auto_id' => $auto->id,
                    'cliente_id' => $user->id,
                    'titulo' => $this->ticketTitle($auto, $user->name),
                    'estado' => 'abierto',
                    'last_message_at' => now(),
                ]);

                TicketMessage::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user->id,
                    'mensaje' => "Hola, quiero consultar por el {$auto->marca} {$auto->modelo} {$auto->anio}.",
                ]);
            }

            DB::commit();

            return redirect("/tickets/{$ticket->id}");
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'general' => 'No se pudo iniciar el chat. Intentalo nuevamente.',
            ]);
        }
    }

    public function show(Request $request, Ticket $ticket): Response
    {
        $this->authorizeTicket($request, $ticket);

        $ticket->load([
            'auto:id,marca,modelo,anio,imagen,precio',
            'cliente:id,name,email',
            'admin:id,name,email',
            'mensajes.user:id,name',
        ]);

        return Inertia::render('Tickets/Show', [
            'isAdmin' => $request->user()->hasRole('admin'),
            'ticket' => $this->ticketDetail($ticket),
        ]);
    }

    public function message(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorizeTicket($request, $ticket);

        if ($request->user()->hasRole('admin') && ! $ticket->admin_id) {
            return back()->withErrors([
                'mensaje' => 'Primero reclama este ticket para poder responder.',
            ]);
        }

        if ($request->user()->hasRole('admin') && $ticket->admin_id !== $request->user()->id) {
            return back()->withErrors([
                'mensaje' => 'Este ticket ya fue reclamado por otro administrador.',
            ]);
        }

        $data = $request->validate([
            'mensaje' => ['required', 'string', 'max:2000'],
        ]);

        DB::beginTransaction();

        try {
            TicketMessage::create([
                'ticket_id' => $ticket->id,
                'user_id' => $request->user()->id,
                'mensaje' => $data['mensaje'],
            ]);

            $ticket->forceFill([
                'last_message_at' => now(),
            ])->save();

            DB::commit();

            return back();
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'mensaje' => 'No se pudo enviar el mensaje. Intentalo nuevamente.',
            ]);
        }
    }

    public function claim(Request $request, Ticket $ticket): RedirectResponse
    {
        abort_unless($request->user()->hasRole('admin'), 403);

        DB::beginTransaction();

        try {
            $lockedTicket = Ticket::query()
                ->whereKey($ticket->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedTicket->admin_id && $lockedTicket->admin_id !== $request->user()->id) {
                DB::rollBack();

                return back()->withErrors([
                    'general' => 'Este ticket ya fue reclamado por otro administrador.',
                ]);
            }

            $lockedTicket->forceFill([
                'admin_id' => $request->user()->id,
            ])->save();

            DB::commit();

            return back()->with('message', 'Ticket reclamado. Ya puedes responder al cliente.');
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'general' => 'No se pudo reclamar el ticket. Intentalo nuevamente.',
            ]);
        }
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        abort_unless($request->user()->hasRole('admin'), 403);

        $data = $request->validate([
            'estado' => ['required', 'in:abierto,respondido,cerrado'],
        ]);

        $ticket->update($data);

        return back()->with('message', 'Ticket actualizado.');
    }

    private function authorizeTicket(Request $request, Ticket $ticket): void
    {
        abort_unless(
            $request->user()->hasRole('admin') || $ticket->cliente_id === $request->user()->id,
            403
        );
    }

    private function ticketTitle(Auto $auto, string $cliente): string
    {
        return "{$auto->marca} {$auto->modelo} {$auto->anio} - {$cliente} - ".now()->format('d/m/Y');
    }

    private function ticketRow(Ticket $ticket): array
    {
        return [
            'id' => $ticket->id,
            'titulo' => $ticket->titulo,
            'estado' => $ticket->estado,
            'mensajes_count' => $ticket->mensajes_count,
            'fecha' => $ticket->created_at?->format('d/m/Y H:i'),
            'last_message_at' => $ticket->last_message_at?->format('d/m/Y H:i'),
            'auto' => [
                'id' => $ticket->auto->id,
                'nombre' => "{$ticket->auto->marca} {$ticket->auto->modelo} {$ticket->auto->anio}",
                'imagen' => $ticket->auto->imagen,
            ],
            'cliente' => [
                'name' => $ticket->cliente->name,
                'email' => $ticket->cliente->email,
            ],
            'admin' => $ticket->admin ? [
                'id' => $ticket->admin->id,
                'name' => $ticket->admin->name,
                'email' => $ticket->admin->email,
            ] : null,
        ];
    }

    private function ticketDetail(Ticket $ticket): array
    {
        return [
            'id' => $ticket->id,
            'titulo' => $ticket->titulo,
            'estado' => $ticket->estado,
            'fecha' => $ticket->created_at?->format('d/m/Y H:i'),
            'auto' => [
                'id' => $ticket->auto->id,
                'nombre' => "{$ticket->auto->marca} {$ticket->auto->modelo} {$ticket->auto->anio}",
                'imagen' => $ticket->auto->imagen,
                'precio' => $ticket->auto->precio,
            ],
            'cliente' => [
                'name' => $ticket->cliente->name,
                'email' => $ticket->cliente->email,
            ],
            'admin' => $ticket->admin ? [
                'id' => $ticket->admin->id,
                'name' => $ticket->admin->name,
                'email' => $ticket->admin->email,
            ] : null,
            'mensajes' => $ticket->mensajes
                ->sortBy('created_at')
                ->map(fn (TicketMessage $message) => [
                    'id' => $message->id,
                    'mensaje' => $message->mensaje,
                    'created_at' => $message->created_at?->format('d/m/Y H:i'),
                    'user' => [
                        'id' => $message->user->id,
                        'name' => $message->user->name,
                    ],
                ])
                ->values(),
        ];
    }
}
