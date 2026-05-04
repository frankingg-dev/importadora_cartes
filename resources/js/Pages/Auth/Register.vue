<template>
  <div class="min-h-screen flex items-center justify-center bg-slate-50">
    <form @submit.prevent="form.post('/register')" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 w-full max-w-md">
      <h2 class="text-2xl font-black mb-6">Crear Cuenta</h2>

      <input v-model="form.name" type="text" placeholder="Nombre" class="w-full p-3 mb-4 border rounded-lg" />
      <input v-model="form.email" type="email" placeholder="Correo" class="w-full p-3 mb-4 border rounded-lg" />
      <input v-model="form.password" type="password" placeholder="Contraseña" class="w-full p-3 mb-4 border rounded-lg" />
      <input v-model="form.password_confirmation" type="password" placeholder="Confirmar" class="w-full p-3 mb-6 border rounded-lg" />

      <button type="submit" class="w-full bg-[#e2b808] text-black font-bold py-3 rounded-lg hover:bg-[#b59200]">
        Registrarse
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});
</script>
