<template>
  <AdminLayout>
    <h2 class="text-3xl font-black text-slate-950 mb-8">Dashboard Overview</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
      <div v-for="stat in stats" :key="stat.title" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <p class="text-xs font-bold uppercase text-slate-400">{{ stat.title }}</p>
        <p class="text-4xl font-black text-slate-950 mt-2">{{ stat.value }}</p>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
      <h3 class="font-bold text-lg mb-6">Recent Inventory</h3>
      <table class="w-full text-left">
        <thead>
          <tr class="text-xs text-slate-400 uppercase">
            <th class="pb-4">Auto</th>
            <th class="pb-4">Estado</th>
            <th class="pb-4 text-right">Precio</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr v-for="car in cars" :key="car.id">
            <td class="py-4 font-bold">{{ car.name }}</td>
            <td class="py-4"><span class="px-2 py-1 bg-[#e2b808]/20 text-[#b59200] rounded text-xs font-bold">{{ car.status }}</span></td>
            <td class="py-4 text-right font-mono">{{ car.price }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({ stats: Array, cars: Array });
</script>
