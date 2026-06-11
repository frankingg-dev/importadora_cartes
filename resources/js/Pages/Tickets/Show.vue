<template>
  <Head :title="ticket.titulo" />
  <Navbar v-if="!isAdmin" />

  <component :is="isAdmin ? AdminLayout : 'main'" :class="isAdmin ? '' : 'bg-slate-50 min-h-screen py-12'">
    <section class="max-w-7xl mx-auto px-6 lg:px-8">
      <div v-if="$page.props.flash?.message" class="mb-6 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
        {{ $page.props.flash.message }}
      </div>

      <div v-if="$page.props.errors?.general" class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-sm font-bold text-red-700">
        {{ $page.props.errors.general }}
      </div>

      <div class="mb-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
          <Link href="/tickets" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-yellow-600 mb-3">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
            Volver a tickets
          </Link>
          <h1 class="text-2xl md:text-3xl font-extrabold text-slate-950">{{ ticket.titulo }}</h1>
          <p class="mt-1 text-sm text-slate-500">{{ ticket.fecha }}</p>
        </div>

        <div v-if="isAdmin" class="flex flex-col gap-3 sm:flex-row sm:items-center">
          <button
            v-if="!ticket.admin"
            type="button"
            @click="claim"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-500 px-5 py-3 text-sm font-black text-slate-950 hover:bg-yellow-400"
          >
            Reclamar ticket
            <span class="material-symbols-outlined text-lg">front_hand</span>
          </button>

          <select
            :value="ticket.estado"
            @change="actualizarEstado($event.target.value)"
            class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold uppercase text-slate-700 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500"
          >
            <option value="abierto">Abierto</option>
            <option value="respondido">Respondido</option>
            <option value="cerrado">Cerrado</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <aside class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-6">
          <img class="aspect-[16/10] w-full rounded-2xl object-cover bg-slate-100" :src="ticket.auto.imagen || '/img/home-auto.avif'" :alt="ticket.auto.nombre">
          <div>
            <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Vehiculo consultado</p>
            <h2 class="mt-2 text-xl font-black text-slate-950">{{ ticket.auto.nombre }}</h2>
            <p class="mt-1 text-lg font-extrabold text-slate-950">{{ precio(ticket.auto.precio) }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50 p-4">
            <p class="text-xs font-black uppercase tracking-widest text-slate-400">Cliente</p>
            <p class="mt-2 font-bold text-slate-950">{{ ticket.cliente.name }}</p>
            <p class="text-sm text-slate-500">{{ ticket.cliente.email }}</p>
          </div>
          <div v-if="isAdmin" class="rounded-2xl border p-4" :class="ticket.admin ? 'border-emerald-100 bg-emerald-50' : 'border-yellow-100 bg-yellow-50'">
            <p class="text-xs font-black uppercase tracking-widest" :class="ticket.admin ? 'text-emerald-700' : 'text-yellow-700'">
              {{ ticket.admin ? 'Ticket reclamado' : 'Ticket sin reclamar' }}
            </p>
            <template v-if="ticket.admin">
              <p class="mt-2 font-bold text-slate-950">{{ ticket.admin.name }}</p>
              <p class="text-sm text-slate-600">{{ ticket.admin.email }}</p>
            </template>
            <p v-else class="mt-2 text-sm font-semibold text-slate-700">
              Reclama este ticket para que otros administradores sepan que lo estas atendiendo.
            </p>
          </div>
          <Link :href="`/autos/${ticket.auto.id}`" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-black text-slate-700 hover:bg-slate-50">
            Ver ficha publica
            <span class="material-symbols-outlined text-lg">visibility</span>
          </Link>
        </aside>

        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
          <div class="h-[560px] overflow-y-auto p-6 space-y-4 bg-slate-50/70">
            <div
              v-for="mensaje in ticket.mensajes"
              :key="mensaje.id"
              :class="mensaje.user.id === $page.props.auth.user.id ? 'ml-auto bg-slate-950 text-white' : 'mr-auto bg-white text-slate-800 border border-slate-200'"
              class="max-w-[78%] rounded-2xl px-5 py-4 shadow-sm"
            >
              <div class="mb-2 flex items-center justify-between gap-4">
                <span class="text-xs font-black uppercase tracking-widest opacity-70">{{ mensaje.user.name }}</span>
                <span class="text-[11px] font-semibold opacity-60">{{ mensaje.created_at }}</span>
              </div>
              <p class="text-sm leading-relaxed whitespace-pre-line">{{ mensaje.mensaje }}</p>
            </div>
          </div>

          <form @submit.prevent="send" class="border-t border-slate-100 p-5 bg-white">
            <div v-if="form.errors.mensaje" class="mb-3 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-bold text-red-700">
              {{ form.errors.mensaje }}
            </div>
            <div v-if="isAdmin && !canReply" class="mb-3 rounded-xl border border-yellow-100 bg-yellow-50 px-4 py-3 text-sm font-bold text-yellow-800">
              {{ ticket.admin ? 'Este ticket esta siendo atendido por otro administrador.' : 'Reclama este ticket para poder responder.' }}
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
              <textarea
                v-model="form.mensaje"
                rows="2"
                :disabled="isAdmin && !canReply"
                class="min-h-[56px] flex-1 resize-none rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-950 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500"
                placeholder="Escribe tu mensaje..."
              ></textarea>
              <button type="submit" :disabled="form.processing || (isAdmin && !canReply)" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-500 px-6 py-3 text-sm font-black text-slate-950 hover:bg-yellow-400 disabled:opacity-50">
                Enviar
                <span class="material-symbols-outlined text-lg">send</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </component>

  <Footer v-if="!isAdmin" />
</template>

<script setup>
import { computed } from 'vue';
import { Head, Link, router, useForm, usePage, usePoll } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  isAdmin: Boolean,
  ticket: { type: Object, required: true },
});

usePage().props.title = 'Ticket';
usePoll(5000);

const form = useForm({
  mensaje: '',
});

const canReply = computed(() => !props.isAdmin || props.ticket.admin?.id === usePage().props.auth.user.id);

const send = () => {
  form.post(`/tickets/${props.ticket.id}/mensajes`, {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
};

const actualizarEstado = (estado) => {
  router.put(`/admin/tickets/${props.ticket.id}`, { estado }, {
    preserveScroll: true,
  });
};

const claim = () => {
  router.post(`/admin/tickets/${props.ticket.id}/claim`, {}, {
    preserveScroll: true,
  });
};

const precio = (valor) => new Intl.NumberFormat('es-CL', {
  style: 'currency',
  currency: 'CLP',
  maximumFractionDigits: 0,
}).format(valor || 0);
</script>
