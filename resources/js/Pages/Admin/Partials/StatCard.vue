<template>
  <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
    <div class="flex items-start justify-between">
      <div :class="accent ? 'bg-[#e2b808] text-slate-950' : 'bg-slate-950 text-[#e2b808]'" class="w-14 h-14 rounded-full flex items-center justify-center transition-transform group-hover:scale-110">
        <span class="material-symbols-outlined text-3xl">{{ icon }}</span>
      </div>
    </div>
    <p class="text-slate-400 text-sm mt-6 font-medium">{{ label }}</p>
    <p class="text-4xl font-black text-slate-950 tracking-tight">{{ value }}</p>
  </div>
</template>

<script setup>
defineProps({
  icon: { type: String, required: true },
  label: { type: String, required: true },
  value: { type: [Number, String], required: true },
  accent: Boolean,
});
</script>
