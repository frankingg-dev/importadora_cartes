<template>
  <Head title="Usuarios" />
  <AdminLayout>
    <div class="space-y-8">
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <StatCard icon="directions_car" label="Vehiculos en catalogo" :value="stats.autos" />
        <StatCard icon="mark_email_unread" label="Cotizaciones pendientes" :value="stats.cotizaciones" accent />
        <StatCard icon="group" label="Usuarios registrados" :value="stats.usuarios" />
        <StatCard icon="local_shipping" label="Unidades en transito" :value="stats.transito" />
      </div>

      <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-7 border-b border-slate-100">
          <h3 class="font-black text-xl text-slate-950 tracking-tight">Usuarios registrados</h3>
          <p class="text-sm text-slate-500 mt-1">Usuarios reales de la tabla users con sus roles.</p>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-50/50">
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Nombre</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Correo</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">Roles</th>
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-right">Registro</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="usuario in usuarios" :key="usuario.id" class="hover:bg-slate-50 transition-colors">
                <td class="px-7 py-5 font-bold text-slate-950">{{ usuario.name }}</td>
                <td class="px-7 py-5 text-sm text-slate-600">{{ usuario.email }}</td>
                <td class="px-7 py-5 text-center">
                  <span v-for="role in usuario.roles" :key="role" class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-[10px] font-bold uppercase text-slate-600 border border-slate-200">
                    {{ role }}
                  </span>
                </td>
                <td class="px-7 py-5 text-sm font-bold text-slate-600 text-right">{{ usuario.created_at }}</td>
              </tr>
              <tr v-if="!usuarios.length">
                <td colspan="4" class="px-7 py-10 text-center text-sm text-slate-500">No hay usuarios registrados.</td>
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
import { Head, usePage } from '@inertiajs/vue3';
import StatCard from './Partials/StatCard.vue';

defineProps({
  stats: { type: Object, required: true },
  usuarios: { type: Array, default: () => [] },
});

usePage().props.title = 'Usuarios';
</script>
