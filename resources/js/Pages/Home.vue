<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

defineProps({
    auth: Object,
    destacados: {
        type: Array,
        default: () => [],
    },
});

const precio = (valor) => new Intl.NumberFormat('es-CL', {
    style: 'currency',
    currency: 'CLP',
    maximumFractionDigits: 0,
}).format(valor || 0);

const verDetalle = (auto) => {
    router.visit(`/autos/${auto.id}`);
};
</script>

<template>
    <Head title="Inicio" />
    <Navbar />

    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 bg-white pb-10 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 mb-6 shadow-inner">
                            <span class="material-symbols-outlined text-sm text-yellow-600 mr-2">verified</span>
                            <span class="text-xs font-semibold uppercase tracking-wider">Venta directa de vehiculos</span>
                        </div>

                        <h1 class="text-4xl tracking-tight font-extrabold text-slate-950 sm:text-5xl md:text-6xl leading-tight">
                            <span class="block">Importadora Cartes</span>
                            <span class="block text-yellow-600">autos listos para ver.</span>
                        </h1>

                        <p class="mt-3 text-base text-slate-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Encuentra vehiculos usados seleccionados, con informacion clara, precios visibles y contacto directo para coordinar una visita.
                        </p>

                        <div class="relative z-20 mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-4">
                            <Link href="/catalogo" class="relative z-20 w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-bold rounded-md text-slate-950 bg-yellow-500 hover:bg-yellow-400 md:py-4 md:text-lg md:px-10 transition-colors shadow-lg shadow-yellow-500/20">
                                Ver vehiculos
                                <span class="material-symbols-outlined ml-2">directions_car</span>
                            </Link>
                            <Link href="/contacto" class="relative z-30 mt-3 sm:mt-0 w-full flex items-center justify-center px-8 py-3 border border-slate-300 text-base font-bold rounded-md text-slate-800 bg-white hover:bg-slate-50 md:py-4 md:text-lg md:px-10 transition-colors shadow-xl shadow-slate-900/10">
                                Consultar ahora
                            </Link>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/img/home-auto.avif" alt="Vehiculo en venta">
            <div class="absolute inset-0 bg-gradient-to-t from-white lg:from-transparent lg:bg-gradient-to-l lg:to-white/50 opacity-30"></div>
        </div>
    </section>

    <section v-if="destacados.length" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-yellow-600 mb-3">Stock destacado</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Vehiculos disponibles</h3>
                </div>
                <Link href="/catalogo" class="hidden sm:inline-flex text-sm font-bold text-slate-700 hover:text-yellow-600">
                    Ver todos
                </Link>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <article
                    v-for="auto in destacados"
                    :key="auto.id"
                    class="group bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden cursor-pointer hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-yellow-200"
                    tabindex="0"
                    @click="verDetalle(auto)"
                    @keydown.enter="verDetalle(auto)"
                >
                    <img class="aspect-[16/10] w-full object-cover" :src="auto.imagen || '/img/home-auto.avif'" :alt="auto.modelo">
                    <div class="p-6">
                        <p class="text-xs font-black uppercase tracking-widest text-yellow-600">{{ auto.marca }}</p>
                        <h4 class="mt-2 text-xl font-extrabold text-slate-950 group-hover:text-yellow-600 transition-colors">{{ auto.modelo }}</h4>
                        <p class="mt-1 text-sm text-slate-500">{{ auto.version || auto.descripcion_breve }}</p>
                        <div class="mt-5 flex items-center justify-between gap-4">
                            <span class="font-black text-slate-950">{{ precio(auto.precio) }}</span>
                            <Link :href="`/autos/${auto.id}`" @click.stop class="text-sm font-bold text-slate-700 hover:text-yellow-600">
                                Ver detalle
                            </Link>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-16">
                <h2 class="text-xs font-bold uppercase tracking-widest text-yellow-600 mb-4">Compra simple</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-gray-900">Por que comprar en Importadora Cartes</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-7 bg-slate-50 p-10 rounded-3xl border border-gray-100 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-yellow-500 mb-6">fact_check</span>
                    <h4 class="text-3xl font-bold text-gray-900 mb-4">Datos claros desde el inicio</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Publicamos año, kilometraje, precio y detalles relevantes para que compares sin vueltas.
                    </p>
                </div>

                <div class="md:col-span-5 bg-gray-900 text-white p-10 rounded-3xl shadow-xl">
                    <span class="material-symbols-outlined text-4xl text-yellow-500 mb-6">handshake</span>
                    <h4 class="text-2xl font-bold mb-4">Atencion directa</h4>
                    <p class="text-gray-300 leading-relaxed">
                        Resolvemos dudas por WhatsApp o formulario y coordinamos visitas para revisar el vehiculo con calma.
                    </p>
                </div>

                <div class="md:col-span-4 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <span class="material-symbols-outlined text-yellow-600 bg-yellow-50 p-3 rounded-lg">payments</span>
                    <div>
                        <h5 class="text-lg font-bold text-gray-900">Precios visibles</h5>
                        <p class="text-sm text-gray-500">Valores publicados para comparar</p>
                    </div>
                </div>

                <div class="md:col-span-4 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-3 rounded-lg">directions_car</span>
                    <div>
                        <h5 class="text-lg font-bold text-gray-900">Stock real</h5>
                        <p class="text-sm text-gray-500">Vehiculos cargados desde el panel</p>
                    </div>
                </div>

                <div class="md:col-span-4 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <span class="material-symbols-outlined text-green-600 bg-green-50 p-3 rounded-lg">support_agent</span>
                    <div>
                        <h5 class="text-lg font-bold text-gray-900">Respuesta rapida</h5>
                        <p class="text-sm text-gray-500">Consulta por formulario o WhatsApp</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <Footer />
</template>
