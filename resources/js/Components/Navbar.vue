<template>
  <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex justify-between h-20 items-center">

        <Link href="/" class="flex-shrink-0 flex items-center font-black text-2xl tracking-tighter text-slate-950">
          IMP<span class="text-[#e2b808]">-CARTES</span>
        </Link>

        <div class="hidden md:flex items-center space-x-8">
          <Link href="/" class="text-sm font-semibold text-slate-600 hover:text-[#e2b808] transition-colors">Inicio</Link>
          <Link href="/catalogo" class="text-sm font-semibold text-slate-600 hover:text-[#e2b808] transition-colors">Catálogo</Link>
          <Link href="/como-importamos" class="text-sm font-semibold text-slate-600 hover:text-[#e2b808] transition-colors">¿Cómo Importamos?</Link>

          <Link href="/quienes-somos" class="bg-[#e2b808] px-5 py-2.5 rounded-full font-bold text-slate-950 text-sm hover:shadow-lg hover:shadow-[#e2b808]/20 transition-all">
            ¿Quiénes Somos?
          </Link>
        </div>

        <div class="flex items-center gap-6">
          <div class="hidden sm:flex items-center gap-4">
            <template v-if="$page.props.auth.user">
              <Link href="/dashboard" class="text-sm font-semibold text-slate-600 hover:text-slate-950">Dashboard</Link>
            </template>
            <template v-else>
              <Link href="/login" class="text-sm font-bold text-slate-600 hover:text-slate-950">Entrar</Link>
              <Link href="/register" class="bg-slate-950 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-slate-800 transition-all shadow-lg">
                Registrarse
              </Link>
            </template>
          </div>

          <a href="https://wa.me/TUNUMERO" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition-all">
             <span class="material-symbols-outlined text-xl">chat</span>
          </a>
        </div>

      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
