<template>
  <Head title="Mi perfil" />
  <Navbar />

  <main class="min-h-screen bg-slate-50 py-16">
    <section class="mx-auto max-w-6xl px-6 lg:px-8">
      <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Cuenta cliente</p>
          <h1 class="mt-2 text-4xl font-extrabold text-slate-950">Mi perfil</h1>
          <p class="mt-2 text-slate-500">Actualiza tus datos para que podamos contactarte correctamente.</p>
        </div>

        <Link href="/tickets" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-3 text-sm font-black text-white hover:bg-slate-800">
          Mis tickets
          <span class="material-symbols-outlined text-lg">forum</span>
        </Link>
      </div>

      <div v-if="$page.props.flash?.message" class="mb-6 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
        {{ $page.props.flash.message }}
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <aside class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
          <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-yellow-500 text-slate-950 shadow-lg shadow-yellow-500/20">
            <span class="material-symbols-outlined text-4xl">person</span>
          </div>
          <h2 class="mt-6 text-2xl font-extrabold text-slate-950">{{ user.name }}</h2>
          <p class="mt-1 text-sm text-slate-500">{{ user.email }}</p>
          <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-sm leading-relaxed text-slate-600">
            Estos datos se usan para tus tickets de consulta y para que el administrador pueda responderte mejor.
          </div>
        </aside>

        <div class="lg:col-span-2 space-y-8">
          <form @submit.prevent="profileForm.put('/perfil')" class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="mb-6">
              <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Datos personales</p>
              <h3 class="mt-2 text-2xl font-extrabold text-slate-950">Nombre y correo</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Nombre</span>
                <input v-model="profileForm.name" class="input" type="text" autocomplete="name">
                <span v-if="profileForm.errors.name" class="mt-2 block text-sm font-semibold text-red-600">{{ profileForm.errors.name }}</span>
              </label>

              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Correo</span>
                <input v-model="profileForm.email" class="input" type="email" autocomplete="email">
                <span v-if="profileForm.errors.email" class="mt-2 block text-sm font-semibold text-red-600">{{ profileForm.errors.email }}</span>
              </label>
            </div>

            <button type="submit" :disabled="profileForm.processing" class="mt-6 inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-500 px-6 py-3 text-sm font-black text-slate-950 hover:bg-yellow-400 disabled:opacity-50">
              Guardar cambios
              <span class="material-symbols-outlined text-lg">save</span>
            </button>
          </form>

          <form @submit.prevent="passwordForm.put('/perfil/contrasena')" class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="mb-6">
              <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Seguridad</p>
              <h3 class="mt-2 text-2xl font-extrabold text-slate-950">Cambiar contrasena</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Actual</span>
                <input v-model="passwordForm.current_password" class="input" type="password" autocomplete="current-password">
                <span v-if="passwordForm.errors.current_password" class="mt-2 block text-sm font-semibold text-red-600">{{ passwordForm.errors.current_password }}</span>
              </label>

              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Nueva</span>
                <input v-model="passwordForm.password" class="input" type="password" autocomplete="new-password">
                <span v-if="passwordForm.errors.password" class="mt-2 block text-sm font-semibold text-red-600">{{ passwordForm.errors.password }}</span>
              </label>

              <label class="block">
                <span class="mb-2 block text-sm font-bold text-slate-700">Confirmar</span>
                <input v-model="passwordForm.password_confirmation" class="input" type="password" autocomplete="new-password">
              </label>
            </div>

            <button type="submit" :disabled="passwordForm.processing" class="mt-6 inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-black text-slate-800 hover:bg-slate-50 disabled:opacity-50">
              Actualizar contrasena
              <span class="material-symbols-outlined text-lg">lock</span>
            </button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <Footer />
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  user: { type: Object, required: true },
});

const profileForm = useForm({
  name: props.user.name,
  email: props.user.email,
});

const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});
</script>

<style scoped>
.input {
  @apply w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-950 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500;
}
</style>
