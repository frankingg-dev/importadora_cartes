<template>
  <Head title="Inicio" />
  <AdminLayout>
    <div class="space-y-8">
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <StatCard icon="directions_car" label="Vehiculos en catalogo" :value="stats.autos" />
        <StatCard icon="mark_email_unread" label="Cotizaciones pendientes" :value="stats.cotizaciones" accent />
        <StatCard icon="group" label="Usuarios registrados" :value="stats.usuarios" />
        <StatCard icon="local_shipping" label="Unidades en transito" :value="stats.transito" />
      </div>

      <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="space-y-4">
          <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Acciones rapidas</h3>
          <Link href="/admin/autos" class="flex items-center gap-4 w-full bg-[#e2b808] p-5 rounded-2xl font-black text-slate-950 hover:shadow-xl hover:shadow-[#e2b808]/30 transition-all">
            <span class="material-symbols-outlined text-3xl">add_box</span>
            <div>
              <span class="block text-base leading-tight">Nuevo vehiculo</span>
              <span class="block text-xs font-bold uppercase opacity-60">Subir al catalogo</span>
            </div>
          </Link>
          <Link href="/admin/ventas" class="flex items-center gap-4 w-full bg-white p-5 rounded-2xl font-bold text-slate-950 border border-slate-200 shadow-sm hover:bg-slate-950 hover:text-white transition-all">
            <span class="material-symbols-outlined text-3xl text-[#e2b808]">request_quote</span>
            <div>
              <span class="block text-base leading-tight">Ver cotizaciones</span>
              <span class="block text-xs font-medium text-slate-500">Solicitudes del formulario</span>
            </div>
          </Link>
        </div>

        <div class="xl:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
          <div class="p-7 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-black text-xl text-slate-950 tracking-tight">Ultimas unidades agregadas</h3>
            <Link href="/admin/autos" class="text-xs font-bold uppercase tracking-widest text-[#e2b808] hover:text-slate-950">Ver todo</Link>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-slate-50/50">
                  <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Modelo</th>
                  <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">Ano</th>
                  <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-right">Precio</th>
                  <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">Estado</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="auto in ultimosAutos" :key="auto.id" class="hover:bg-slate-50 transition-colors">
                  <td class="px-7 py-5">
                    <span class="block font-bold text-slate-950 text-base">{{ auto.marca }} {{ auto.modelo }}</span>
                    <span class="block text-xs text-slate-400">{{ auto.version || 'Sin version' }}</span>
                  </td>
                  <td class="px-7 py-5 text-sm font-bold text-slate-600 text-center">{{ auto.anio }}</td>
                  <td class="px-7 py-5 text-base font-black text-slate-950 text-right">{{ precio(auto.precio) }}</td>
                  <td class="px-7 py-5 text-center">
                    <span class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-[10px] font-bold uppercase text-slate-600 border border-slate-200">{{ auto.estado }}</span>
                  </td>
                </tr>
                <tr v-if="!ultimosAutos.length">
                  <td colspan="4" class="px-7 py-10 text-center text-sm text-slate-500">Aun no hay vehiculos cargados.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import StatCard from './Partials/StatCard.vue';

defineProps({
  stats: { type: Object, required: true },
  ultimosAutos: { type: Array, default: () => [] },
  ultimasCotizaciones: { type: Array, default: () => [] },
});

usePage().props.title = 'Inicio';

const precio = (valor) => new Intl.NumberFormat('es-CL', {
  style: 'currency',
  currency: 'CLP',
  maximumFractionDigits: 0,
}).format(valor || 0);
</script>
