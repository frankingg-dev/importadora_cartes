<script setup>
import { onMounted, ref } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

defineProps({
    auth: Object,
    autos: {
        type: Array,
        default: () => [],
    },
});

const page = usePage();
const vehiculoInteres = ref('');

const form = useForm({
    auto_id: '',
    nombre: '',
    email: '',
    telefono: '+56 ',
    modelo_interes: '',
    mensaje: '',
});

onMounted(() => {
    const auto = new URLSearchParams(window.location.search).get('auto');
    if (auto) {
        vehiculoInteres.value = auto;
    }
});

const submit = () => {
    form.auto_id = vehiculoInteres.value === 'otros' ? '' : vehiculoInteres.value;
    form.modelo_interes = vehiculoInteres.value === 'otros' ? 'Otros' : '';

    form.post('/contacto', {
        onSuccess: () => {
            form.reset();
            vehiculoInteres.value = '';
        },
    });
};
</script>

<template>
    <Head title="Contacto" />
    <Navbar />

    <section class="py-24 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl mb-16">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 mb-6 shadow-inner">
                    <span class="material-symbols-outlined text-sm text-yellow-600 mr-2">support_agent</span>
                    <span class="text-xs font-semibold uppercase tracking-wider">Atencion directa</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-950 tracking-tight mb-4">
                    Consulta por tu proximo <span class="text-yellow-600">auto</span>
                </h1>
                <p class="text-slate-600 text-lg leading-relaxed">
                    Dejanos tus datos y te contactamos para confirmar disponibilidad, coordinar visita o resolver dudas.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                <div class="lg:col-span-5 space-y-8">
                    <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                        <h3 class="text-xl font-bold text-slate-950 mb-6">Importadora Cartes</h3>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <span class="material-symbols-outlined text-yellow-600 bg-yellow-100/60 p-3 rounded-xl">location_on</span>
                                <div>
                                    <h4 class="font-bold text-slate-950">Oficina</h4>
                                    <p class="text-slate-600 text-sm mt-0.5">Independencia #0135, Punta Arenas</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="material-symbols-outlined text-yellow-600 bg-yellow-100/60 p-3 rounded-xl">mail</span>
                                <div>
                                    <h4 class="font-bold text-slate-950">Correo</h4>
                                    <p class="text-slate-600 text-sm mt-0.5">ventas@importacartes.cl</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="material-symbols-outlined text-yellow-600 bg-yellow-100/60 p-3 rounded-xl">schedule</span>
                                <div>
                                    <h4 class="font-bold text-slate-950">Horario</h4>
                                    <p class="text-slate-600 text-sm mt-0.5">Lunes a Viernes: 09:00 - 18:30 hrs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 bg-slate-50 p-8 sm:p-10 rounded-3xl border border-slate-100 shadow-inner">
                    <div v-if="page.props.flash?.message" class="mb-6 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                        {{ page.props.flash.message }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="nombre" class="block text-sm font-semibold text-slate-700 mb-2">Nombre completo</label>
                                <input id="nombre" v-model="form.nombre" type="text" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 text-slate-950" placeholder="Ej: Carlos Silva">
                                <p v-if="form.errors.nombre" class="mt-2 text-sm text-red-600">{{ form.errors.nombre }}</p>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Correo</label>
                                <input id="email" v-model="form.email" type="email" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 text-slate-950" placeholder="carlos@example.com">
                                <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="telefono" class="block text-sm font-semibold text-slate-700 mb-2">Telefono</label>
                                <input id="telefono" v-model="form.telefono" type="tel" required pattern="^\+56\s?[0-9\s]{8,13}$" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 text-slate-950" placeholder="+56 9 1234 5678" title="Debe comenzar con +56. Ej: +56 9 1234 5678">
                                <p v-if="form.errors.telefono" class="mt-2 text-sm text-red-600">{{ form.errors.telefono }}</p>
                            </div>
                            <div>
                                <label for="auto" class="block text-sm font-semibold text-slate-700 mb-2">Vehiculo de interes</label>
                                <select id="auto" v-model="vehiculoInteres" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 text-slate-950">
                                    <option value="">Selecciona un vehiculo</option>
                                    <option v-for="auto in autos" :key="auto.id" :value="auto.id">
                                        {{ auto.marca }} {{ auto.modelo }} {{ auto.version ? `- ${auto.version}` : '' }}
                                    </option>
                                    <option value="otros">Otros</option>
                                </select>
                                <p v-if="form.errors.auto_id || form.errors.modelo_interes" class="mt-2 text-sm text-red-600">{{ form.errors.auto_id || form.errors.modelo_interes }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="mensaje" class="block text-sm font-semibold text-slate-700 mb-2">Mensaje</label>
                            <textarea id="mensaje" v-model="form.mensaje" rows="5" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 text-slate-950 resize-none" placeholder="Cuentanos si quieres coordinar visita, revisar precio o saber mas detalles..."></textarea>
                        </div>

                        <button type="submit" :disabled="form.processing" class="w-full flex items-center justify-center px-8 py-4 text-base font-bold rounded-xl text-slate-950 bg-yellow-500 hover:bg-yellow-400 disabled:opacity-50 transition-all shadow-md">
                            <span v-if="form.processing">Enviando consulta...</span>
                            <span v-else class="flex items-center">
                                Enviar consulta
                                <span class="material-symbols-outlined ml-2 text-xl">send</span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <Footer />
</template>
