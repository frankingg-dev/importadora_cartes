<template>
  <Head title="Ventas" />
  <AdminLayout>
    <div class="space-y-8">
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <StatCard icon="directions_car" label="Vehiculos en catalogo" :value="stats.autos" />
        <StatCard icon="mark_email_unread" label="Cotizaciones pendientes" :value="stats.cotizaciones" accent />
        <StatCard icon="group" label="Usuarios registrados" :value="stats.usuarios" />
        <StatCard icon="local_shipping" label="Unidades en transito" :value="stats.transito" />
      </div>

      <div v-if="$page.props.flash?.message" class="rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
        {{ $page.props.flash.message }}
      </div>

      <div v-if="$page.props.errors?.general" class="rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-sm font-bold text-red-700">
        {{ $page.props.errors.general }}
      </div>

      <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-7 border-b border-slate-100 flex items-center justify-between">
          <div>
            <h3 class="font-black text-xl text-slate-950 tracking-tight">Cotizaciones recibidas</h3>
            <p class="text-sm text-slate-500 mt-1">Solicitudes creadas desde el formulario de contacto.</p>
          </div>
          <Link href="/contacto" class="text-xs font-bold uppercase tracking-widest text-[#e2b808] hover:text-slate-950">Nueva prueba</Link>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-50/50">
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Cliente</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Modelo</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Contacto</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">Estado</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-right">Fecha</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="cotizacion in cotizaciones.data" :key="cotizacion.id" class="hover:bg-slate-50 transition-colors align-top">
                <td class="px-7 py-5">
                  <span class="block font-bold text-slate-950">{{ cotizacion.nombre }}</span>
                  <span class="block text-xs text-slate-400 max-w-xs truncate">{{ cotizacion.mensaje || 'Sin mensaje adicional' }}</span>
                </td>
                <td class="px-7 py-5 text-sm font-semibold text-slate-600">
                  {{ cotizacion.auto || cotizacion.modelo_interes || 'No especificado' }}
                </td>
                <td class="px-7 py-5 text-sm text-slate-600">
                  <span class="block">{{ cotizacion.email }}</span>
                  <span class="block text-xs text-slate-400">{{ cotizacion.telefono }}</span>
                </td>
                <td class="px-7 py-5 text-center">
                  <select
                    :value="cotizacion.estado"
                    @change="actualizarEstado(cotizacion.id, $event.target.value)"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold uppercase text-slate-700 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500"
                  >
                    <option value="pendiente">Pendiente</option>
                    <option value="contactado">Contactado</option>
                    <option value="cerrado">Cerrado</option>
                    <option value="descartado">Descartado</option>
                  </select>
                </td>
                <td class="px-7 py-5 text-sm font-bold text-slate-600 text-right">{{ cotizacion.fecha }}</td>
              </tr>
              <tr v-if="!cotizaciones.data.length">
                <td colspan="5" class="px-7 py-10 text-center text-sm text-slate-500">Aun no hay cotizaciones recibidas.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import StatCard from './Partials/StatCard.vue';

defineProps({
  stats: { type: Object, required: true },
  cotizaciones: { type: Object, required: true },
});

usePage().props.title = 'Ventas';

const actualizarEstado = (id, estado) => {
  router.put(`/admin/cotizaciones/${id}`, { estado }, {
    preserveScroll: true,
  });
};
</script>
