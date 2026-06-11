<template>
  <Head title="Tickets" />
  <Navbar v-if="!isAdmin" />

  <component :is="isAdmin ? AdminLayout : 'main'" :class="isAdmin ? '' : 'bg-slate-50 min-h-screen py-16'">
    <section class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
          <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Chat de consultas</p>
          <h1 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-950">
            {{ isAdmin ? 'Tickets de clientes' : 'Mis tickets' }}
          </h1>
          <p class="mt-2 text-slate-500">
            {{ isAdmin ? 'Conversaciones abiertas desde el catalogo.' : 'Revisa tus consultas y respuestas del equipo.' }}
          </p>
        </div>

        <Link
          v-if="!isAdmin"
          href="/catalogo"
          class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 py-3 text-sm font-black text-white hover:bg-slate-800"
        >
          Ver vehiculos
          <span class="material-symbols-outlined text-lg">directions_car</span>
        </Link>
      </div>

      <div v-if="$page.props.flash?.message" class="mb-6 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
        {{ $page.props.flash.message }}
      </div>

      <div v-if="$page.props.errors?.general" class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-sm font-bold text-red-700">
        {{ $page.props.errors.general }}
      </div>

      <div v-if="isAdmin" class="mb-6 flex flex-wrap gap-3">
        <Link
          href="/tickets"
          :class="filtro === 'todos' ? 'bg-slate-950 text-white' : 'bg-white text-slate-600 hover:bg-slate-50'"
          class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-black shadow-sm"
        >
          Todos
        </Link>
        <Link
          href="/tickets?filtro=sin_reclamar"
          :class="filtro === 'sin_reclamar' ? 'bg-yellow-500 text-slate-950 border-yellow-500' : 'bg-white text-slate-600 hover:bg-yellow-50'"
          class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-black shadow-sm"
        >
          <span class="material-symbols-outlined text-lg">notifications</span>
          Sin reclamar
        </Link>
      </div>

      <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-50/70">
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Ticket</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Cliente</th>
                <th v-if="isAdmin" class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Asignacion</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">Estado</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-right">Actividad</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="ticket in tickets.data" :key="ticket.id" class="hover:bg-slate-50 transition-colors">
                <td class="px-7 py-5">
                  <Link :href="`/tickets/${ticket.id}`" class="flex items-start gap-4 min-w-[320px]">
                    <img class="w-20 h-14 rounded-xl object-cover bg-slate-100" :src="ticket.auto.imagen || '/img/home-auto.avif'" :alt="ticket.auto.nombre">
                    <div>
                      <span class="block text-base font-black text-slate-950 hover:text-yellow-600">{{ ticket.titulo }}</span>
                      <span class="block mt-1 text-xs font-semibold text-slate-400">{{ ticket.auto.nombre }} · {{ ticket.mensajes_count }} mensajes</span>
                    </div>
                  </Link>
                </td>
                <td class="px-7 py-5 text-sm text-slate-600">
                  <span class="block font-bold text-slate-950">{{ ticket.cliente.name }}</span>
                  <span class="block text-xs text-slate-400">{{ ticket.cliente.email }}</span>
                </td>
                <td v-if="isAdmin" class="px-7 py-5 text-sm text-slate-600">
                  <div v-if="ticket.admin" class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <span class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Reclamado por</span>
                    <span class="mt-1 block font-bold text-slate-950">{{ ticket.admin.name }}</span>
                  </div>
                  <button
                    v-else
                    type="button"
                    @click="claim(ticket.id)"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-500 px-4 py-3 text-xs font-black uppercase tracking-widest text-slate-950 hover:bg-yellow-400"
                  >
                    Reclamar
                    <span class="material-symbols-outlined text-base">front_hand</span>
                  </button>
                </td>
                <td class="px-7 py-5 text-center">
                  <span :class="statusClass(ticket.estado)">{{ ticket.estado }}</span>
                </td>
                <td class="px-7 py-5 text-right text-sm font-bold text-slate-500">
                  {{ ticket.last_message_at || ticket.fecha }}
                </td>
              </tr>
              <tr v-if="!tickets.data.length">
                <td :colspan="isAdmin ? 5 : 4" class="px-7 py-12 text-center text-sm text-slate-500">
                  No hay tickets todavia.
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-if="tickets.links?.length > 3" class="px-7 py-5 border-t border-slate-100 flex flex-wrap gap-2">
          <Link
            v-for="link in tickets.links"
            :key="link.label"
            :href="link.url || '#'"
            preserve-scroll
            :class="[
              'min-w-10 rounded-xl border px-3 py-2 text-center text-sm font-bold',
              link.active ? 'border-slate-950 bg-slate-950 text-white' : 'border-slate-200 text-slate-600 hover:bg-slate-50',
              !link.url ? 'pointer-events-none opacity-40' : ''
            ]"
            v-html="link.label"
          />
        </div>
      </div>
    </section>
  </component>

  <Footer v-if="!isAdmin" />
</template>

<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
  isAdmin: Boolean,
  filtro: { type: String, default: 'todos' },
  tickets: { type: Object, required: true },
});

usePage().props.title = 'Tickets';

const statusClass = (status) => [
  'inline-flex rounded-full border px-3 py-1 text-[10px] font-black uppercase',
  status === 'cerrado'
    ? 'border-slate-200 bg-slate-50 text-slate-500'
    : status === 'respondido'
      ? 'border-blue-100 bg-blue-50 text-blue-700'
      : 'border-emerald-100 bg-emerald-50 text-emerald-700',
];

const claim = (ticketId) => {
  router.post(`/admin/tickets/${ticketId}/claim`, {}, {
    preserveScroll: true,
  });
};
</script>
