<template>
  <div class="flex min-h-screen bg-slate-50">
    <aside class="fixed z-20 flex h-full w-64 flex-col border-r border-slate-200 bg-white">
      <div class="flex h-20 items-center border-b border-slate-50 px-8">
        <Logo size="w-100 h-auto" />
      </div>

      <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">
        <p class="mb-4 px-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Menu Principal</p>

        <Link href="/admin/panel" :class="navClass('/admin/panel')">
          <span class="material-symbols-outlined">dashboard</span>
          <span class="font-bold">Inicio</span>
        </Link>

        <Link href="/admin/autos" :class="navClass('/admin/autos')">
          <span class="material-symbols-outlined">directions_car</span>
          <span class="font-bold">Vehiculos</span>
        </Link>

        <Link href="/admin/usuarios" :class="navClass('/admin/usuarios')">
          <span class="material-symbols-outlined">group</span>
          <span class="font-bold">Usuarios</span>
        </Link>

        <Link href="/admin/ventas" :class="navClass('/admin/ventas')">
          <span class="material-symbols-outlined">payments</span>
          <span class="font-bold">Ventas</span>
        </Link>

        <Link href="/tickets" :class="navClass('/tickets')">
          <span class="material-symbols-outlined">forum</span>
          <span class="font-bold">Tickets</span>
          <span
            v-if="unclaimedTickets > 0"
            class="ml-auto rounded-full bg-[#e2b808] px-2 py-0.5 text-[10px] font-black text-slate-950"
          >
            {{ unclaimedTickets }}
          </span>
        </Link>
      </nav>

      <div class="border-t border-slate-100 p-4">
        <button
          class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold text-slate-500 transition-all hover:bg-slate-100 hover:text-slate-900"
          @click="router.visit('/')"
        >
          <span class="material-symbols-outlined">outbound</span>
          Volver al Sitio
        </button>
        <button
          class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold text-slate-500 transition-all hover:bg-red-50 hover:text-red-600"
          @click="router.post('/logout')"
        >
          <span class="material-symbols-outlined">logout</span>
          Cerrar Sesion
        </button>
      </div>
    </aside>

    <div class="ml-64 flex flex-1 flex-col">
      <nav class="sticky top-0 z-10 flex h-20 w-full items-center justify-between border-b border-slate-200 bg-white/80 px-8 backdrop-blur-md">
        <div class="flex items-center gap-4">
          <span class="font-light text-slate-300">></span>
          <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500">
            Panel de Control / {{ $page.props.title }}
          </h2>
        </div>

        <div class="flex items-center gap-4">
          <Link
            href="/tickets?filtro=sin_reclamar"
            class="relative flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 shadow-sm transition-colors hover:bg-yellow-50 hover:text-slate-950"
            title="Tickets sin reclamar"
          >
            <span class="material-symbols-outlined">notifications</span>
            <span
              v-if="unclaimedTickets > 0"
              class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-[#e2b808] px-1.5 text-[10px] font-black leading-none text-slate-950 ring-2 ring-white"
            >
              {{ unclaimedTickets > 9 ? '9+' : unclaimedTickets }}
            </span>
          </Link>

          <span class="mx-2 h-6 w-px bg-slate-200"></span>

          <div class="flex items-center gap-3 pl-2">
            <div class="hidden text-right sm:block">
              <p class="text-sm font-black leading-none text-slate-950">Admin</p>
              <p class="mt-1 text-[10px] font-bold uppercase tracking-tight text-[#e2b808]">Super User</p>
            </div>
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 font-bold text-[#e2b808] shadow-lg shadow-slate-200">
              A
            </div>
          </div>
        </div>
      </nav>

      <main class="max-w-[1600px] p-10">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Logo from '@/Components/Logo.vue';

const page = usePage();
const unclaimedTickets = computed(() => page.props.adminNotifications?.unclaimedTickets || 0);

const navClass = (url) => {
  const active = page.url === url || (url !== '/' && page.url.startsWith(url));

  return [
    'flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all duration-200',
    active
      ? 'bg-slate-950 text-[#e2b808] shadow-lg shadow-slate-200'
      : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900',
  ];
};
</script>

<style scoped>
.material-symbols-outlined {
  font-variation-settings: 'wght' 300, 'opsz' 20;
}
</style>
