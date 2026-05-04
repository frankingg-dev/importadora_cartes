<template>
  <div class="min-h-screen bg-slate-50 flex">
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col py-6 fixed h-full z-20">
      <div class="px-6 mb-8">
        <h1 class="text-xl font-black text-slate-950 tracking-tighter">K-AUTO <span class="text-[#e2b808]">ADMIN</span></h1>
      </div>

      <nav class="flex-1 px-3 space-y-1">
        <Link href="/admin/dashboard" :class="['flex items-center gap-3 px-4 py-3 rounded-lg', $page.url === '/admin/dashboard' ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100']">
          <span class="material-symbols-outlined">dashboard</span> Dashboard
        </Link>
        <Link href="/admin/autos" :class="['flex items-center gap-3 px-4 py-3 rounded-lg', $page.url.startsWith('/admin/autos') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100']">
          <span class="material-symbols-outlined">directions_car</span> Inventory
        </Link>
        <Link href="/admin/usuarios" :class="['flex items-center gap-3 px-4 py-3 rounded-lg', $page.url.startsWith('/admin/usuarios') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100']">
          <span class="material-symbols-outlined">group</span> Users
        </Link>
      </nav>
    </aside>

    <main class="ml-64 flex-1 p-8">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
