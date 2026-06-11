<template>
  <nav class="bg-white/95 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 shadow-sm shadow-slate-200/60">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex justify-between h-20 items-center relative">
        <div class="flex items-center gap-4">
          <Link href="/" class="flex items-center">
            <Logo class="h-16 w-auto" />
          </Link>
        </div>

        <div class="hidden md:flex items-center gap-2">
          <Link href="/" :class="navLink('/')">Inicio</Link>
          <Link href="/catalogo" :class="navLink('/catalogo')">Vehiculos</Link>
          <Link href="/como-importamos" :class="navLink('/como-importamos')">Como comprar</Link>

          <Link href="/quienes-somos" :class="navLink('/quienes-somos', true)">
            Quienes somos
          </Link>
        </div>

        <div class="flex items-center gap-4">
          <div class="hidden sm:flex items-center gap-3">
            <template v-if="$page.props.auth?.user">
              <Link
                v-if="isAdmin"
                href="/admin/panel"
                class="inline-flex items-center justify-center rounded-full bg-slate-100 px-5 py-2.5 text-sm font-black text-slate-800 hover:bg-slate-200 transition-all"
              >
                Panel
              </Link>
              <Link
                href="/tickets"
                class="inline-flex items-center justify-center rounded-full bg-slate-100 px-5 py-2.5 text-sm font-black text-slate-800 hover:bg-slate-200 transition-all"
              >
                {{ isAdmin ? 'Tickets' : 'Mis tickets' }}
              </Link>
              <Link
                href="/perfil"
                class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-yellow-100 bg-yellow-50 text-slate-950 shadow-sm hover:bg-yellow-500 hover:border-yellow-500 transition-all"
                title="Editar perfil"
              >
                <span class="material-symbols-outlined text-2xl">person</span>
              </Link>
              <Link
                href="/logout"
                method="post"
                as="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 hover:border-red-100 hover:bg-red-50 hover:text-red-600 transition-all"
                title="Cerrar sesion"
              >
                <span class="material-symbols-outlined text-xl">close</span>
              </Link>
            </template>
            <template v-else>
              <Link href="/login" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-black text-slate-700 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950 transition-all">
                Iniciar sesion
              </Link>
              <Link href="/contacto" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-950 px-5 py-2.5 text-sm font-black text-white hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/15">
                Contacto
                <span class="material-symbols-outlined text-base">arrow_forward</span>
              </Link>
            </template>
          </div>

          <a href="https://wa.me/56954083118" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100 hover:bg-emerald-600 hover:text-white hover:ring-emerald-600 transition-all">
            <span class="material-symbols-outlined text-xl">chat</span>
          </a>
        </div>

        <div class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-yellow-400/80 to-transparent"></div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Logo from '@/Components/Logo.vue';

const page = usePage();
const isAdmin = page.props.auth?.user?.roles?.includes('admin');

const isActive = (href) => page.url === href || (href !== '/' && page.url.startsWith(href));

const navLink = (href, highlighted = false) => {
  const active = isActive(href);

  if (highlighted) {
    return [
      'px-5 py-2.5 rounded-full text-sm font-black transition-all',
      active
        ? 'bg-[#e2b808] text-slate-950 shadow-lg shadow-[#e2b808]/20'
        : 'bg-yellow-50 text-slate-800 ring-1 ring-yellow-100 hover:bg-[#e2b808] hover:text-slate-950 hover:ring-[#e2b808]',
    ];
  }

  return [
    'px-3 py-2 rounded-full text-sm font-semibold transition-colors',
    active ? 'text-slate-950 bg-slate-100' : 'text-slate-600 hover:text-slate-950 hover:bg-yellow-50',
  ];
};
</script>
