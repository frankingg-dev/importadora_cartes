<template>
  <Head title="Crear cuenta" />

  <main class="min-h-screen bg-slate-100 px-6 py-8">
    <div class="mx-auto grid min-h-[calc(100vh-4rem)] max-w-6xl grid-cols-1 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-200/80 lg:grid-cols-2">
      <section class="relative hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between">
        <img class="absolute inset-0 h-full w-full object-cover opacity-35" src="/img/home-auto.avif" alt="Vehiculo Importadora Cartes">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-950/90 to-slate-900/60"></div>

        <div class="relative">
          <Link href="/" class="inline-flex rounded-2xl bg-white px-5 py-3">
            <Logo class="h-14 w-auto" />
          </Link>
        </div>

        <div class="relative max-w-md">
          <p class="mb-4 inline-flex rounded-full bg-yellow-500 px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-950">
            Cuenta cliente
          </p>
          <h1 class="text-4xl font-extrabold leading-tight">
            Crea tu cuenta y conversa por cada vehiculo.
          </h1>
          <p class="mt-5 text-sm leading-relaxed text-slate-300">
            Al consultar un auto se genera un ticket con historial, respuestas del administrador y seguimiento de tu solicitud.
          </p>
        </div>
      </section>

      <section class="flex items-center justify-center p-6 sm:p-10">
        <div class="w-full max-w-md">
          <div class="mb-8 flex items-center justify-between gap-4">
            <Link href="/" class="lg:hidden">
              <Logo class="h-14 w-auto" />
            </Link>
            <Link href="/" class="ml-auto inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-50">
              <span class="material-symbols-outlined text-base">arrow_back</span>
              Inicio
            </Link>
          </div>

          <div class="mb-8">
            <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Nuevo cliente</p>
            <h2 class="mt-2 text-3xl font-extrabold text-slate-950">Crear cuenta</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">
              Ingresa tus datos para iniciar consultas y recibir respuestas desde el panel.
            </p>
          </div>

          <form @submit.prevent="form.post('/register')" class="space-y-5">
            <label class="block">
              <span class="mb-2 block text-sm font-bold text-slate-700">Nombre</span>
              <div :class="inputWrapClass(form.errors.name)">
                <span class="material-symbols-outlined text-lg text-slate-400">person</span>
                <input v-model="form.name" type="text" class="field" placeholder="Nombre completo" autocomplete="name" required>
              </div>
              <span v-if="form.errors.name" class="mt-2 block text-sm font-semibold text-red-600">{{ form.errors.name }}</span>
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-bold text-slate-700">Correo electronico</span>
              <div :class="inputWrapClass(form.errors.email)">
                <span class="material-symbols-outlined text-lg text-slate-400">mail</span>
                <input v-model="form.email" type="email" class="field" placeholder="cliente@correo.cl" autocomplete="email" required>
              </div>
              <span v-if="form.errors.email" class="mt-2 block text-sm font-semibold text-red-600">{{ form.errors.email }}</span>
            </label>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Contrasena</span>
                <div :class="inputWrapClass(form.errors.password)">
                  <span class="material-symbols-outlined text-lg text-slate-400">lock</span>
                  <input v-model="form.password" type="password" class="field" placeholder="Min. 8" autocomplete="new-password" required>
                </div>
              </label>

              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Confirmar</span>
                <div :class="inputWrapClass(form.errors.password_confirmation)">
                  <span class="material-symbols-outlined text-lg text-slate-400">verified_user</span>
                  <input v-model="form.password_confirmation" type="password" class="field" placeholder="Repetir" autocomplete="new-password" required>
                </div>
              </label>
            </div>

            <div v-if="form.errors.password" class="rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
              {{ form.errors.password }}
            </div>
            <div v-if="form.errors.password_confirmation" class="rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
              {{ form.errors.password_confirmation }}
            </div>

            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-yellow-500 px-6 py-4 text-sm font-black text-slate-950 shadow-lg shadow-yellow-500/20 transition-colors hover:bg-yellow-400 disabled:opacity-50"
            >
              {{ form.processing ? 'Creando cuenta...' : 'Crear mi cuenta' }}
              <span class="material-symbols-outlined text-lg">person_add</span>
            </button>
          </form>

          <div class="mt-8 rounded-2xl border border-slate-100 bg-slate-50 p-4 text-center">
            <p class="text-sm text-slate-600">
              ¿Ya tienes cuenta?
              <Link href="/login" class="font-black text-slate-950 hover:text-yellow-600">Iniciar sesion</Link>
            </p>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Logo from '@/Components/Logo.vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const inputWrapClass = (error) => [
  'flex items-center gap-3 rounded-2xl border bg-white px-4 py-3 transition-all focus-within:ring-2 focus-within:ring-yellow-500',
  error ? 'border-red-300' : 'border-slate-200 focus-within:border-transparent',
];
</script>

<style scoped>
.field {
  @apply w-full border-0 bg-transparent p-0 text-sm text-slate-950 placeholder:text-slate-400 focus:ring-0;
}
</style>
