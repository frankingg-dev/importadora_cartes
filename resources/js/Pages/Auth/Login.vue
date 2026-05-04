<template>
  <div class="min-h-screen flex items-center justify-center bg-slate-100">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
      <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">Iniciar Sesión</h2>

      <form @submit.prevent="form.post('/login')">
        <div class="mb-4">
          <label class="block text-sm font-medium text-slate-700">Correo Electrónico</label>
          <input
            v-model="form.email"
            type="email"
            class="w-full p-3 mt-1 border rounded-lg focus:ring-2 focus:ring-[#e2b808] outline-none"
            :class="{'border-red-500': form.errors.email}"
            required
          />
          <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-slate-700">Contraseña</label>
          <input
            v-model="form.password"
            type="password"
            class="w-full p-3 mt-1 border rounded-lg focus:ring-2 focus:ring-[#e2b808] outline-none"
            :class="{'border-red-500': form.errors.password}"
            required
          />
          <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
        </div>

        <button
          type="submit"
          :disabled="form.processing"
          class="w-full bg-[#e2b808] text-black font-bold py-3 rounded-lg hover:bg-[#b59200] transition duration-200"
        >
          {{ form.processing ? 'Ingresando...' : 'Entrar' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});
</script>
