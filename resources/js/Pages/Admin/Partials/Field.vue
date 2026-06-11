<template>
  <label class="block">
    <span class="block text-sm font-semibold text-slate-700 mb-2">{{ label }}</span>
    <slot />
    <span v-if="error" class="mt-2 block text-sm text-red-600">{{ error }}</span>
  </label>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  label: { type: String, required: true },
  errorKey: { type: String, required: true },
});

const page = usePage();
const error = computed(() => page.props.errors?.[props.errorKey]);
</script>
