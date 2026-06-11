<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

const props = defineProps({
    auth: Object,
    auto: {
        type: Object,
        required: true,
    },
});

const precio = (valor) => new Intl.NumberFormat('es-CL', {
    style: 'currency',
    currency: 'CLP',
    maximumFractionDigits: 0,
}).format(valor || 0);

const numero = (valor) => new Intl.NumberFormat('es-CL').format(valor || 0);

const titulo = computed(() => `${props.auto.marca || ''} ${props.auto.modelo || ''}`.trim());

const descripcion = computed(() => (
    props.auto.descripcion
    || props.auto.descripcion_breve
    || 'Vehiculo disponible para revisar y consultar directamente con Importadora Cartes.'
));

const especificaciones = computed(() => [
    { icono: 'calendar_month', etiqueta: 'Año', valor: props.auto.anio },
    { icono: 'speed', etiqueta: 'Kilometraje', valor: props.auto.kilometraje ? `${numero(props.auto.kilometraje)} km` : null },
    { icono: 'settings', etiqueta: 'Motor', valor: props.auto.motor },
    { icono: 'auto_transmission', etiqueta: 'Transmision', valor: props.auto.transmision },
    { icono: 'local_gas_station', etiqueta: 'Combustible', valor: props.auto.combustible },
    { icono: 'palette', etiqueta: 'Color', valor: props.auto.color },
    { icono: 'door_front', etiqueta: 'Puertas', valor: props.auto.puertas },
    { icono: 'bolt', etiqueta: 'Potencia', valor: props.auto.potencia ? `${props.auto.potencia} HP` : null },
    { icono: 'sync_alt', etiqueta: 'Traccion', valor: props.auto.traccion },
].filter((item) => item.valor));

const detallesTecnicos = computed(() => [
    { etiqueta: 'Cilindros', valor: props.auto.cilindros },
    { etiqueta: 'Torque', valor: props.auto.torque },
    { etiqueta: 'Capacidad tanque', valor: props.auto.capacidad_tanque },
    { etiqueta: 'Consumo ciudad', valor: props.auto.consumo_ciudad },
    { etiqueta: 'Consumo carretera', valor: props.auto.consumo_carretera },
    { etiqueta: 'Dimensiones', valor: props.auto.dimensiones },
    { etiqueta: 'Peso', valor: props.auto.peso },
    { etiqueta: 'Capacidad de carga', valor: props.auto.capacidad_carga },
].filter((item) => item.valor));

const destacados = computed(() => [
    props.auto.seguridad,
    props.auto.tecnologia,
    props.auto.detalle1,
    props.auto.detalle2,
].filter(Boolean));

const detallesVehiculo = computed(() => {
    if (!props.auto.detalles) {
        return [];
    }

    return props.auto.detalles
        .split(/\r?\n/)
        .map((detalle) => detalle.trim())
        .filter(Boolean);
});
</script>

<template>
    <Head :title="titulo" />
    <Navbar />

    <main class="bg-white">
        <section class="relative bg-slate-950 text-white">
            <div class="absolute inset-0">
                <img
                    class="h-full w-full object-cover opacity-70"
                    :src="auto.imagen || '/img/home-auto.avif'"
                    :alt="titulo"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-slate-950/10"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 min-h-[560px] flex items-end pb-12 pt-28">
                <div class="max-w-4xl">
                    <Link href="/catalogo" class="inline-flex items-center gap-2 text-sm font-bold text-slate-200 hover:text-yellow-400 transition-colors mb-8">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                        Volver al catalogo
                    </Link>

                    <div class="flex flex-wrap items-center gap-3 mb-5">
                        <span class="bg-yellow-500 text-slate-950 text-xs font-black px-4 py-2 rounded-xl uppercase tracking-widest">
                            {{ auto.tag || auto.estado || 'Disponible' }}
                        </span>
                        <span v-if="auto.version" class="bg-white/10 backdrop-blur-md text-white text-xs font-bold px-4 py-2 rounded-xl uppercase tracking-widest">
                            {{ auto.version }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight">
                        <span class="uppercase">{{ auto.marca }}</span>
                        <span class="block text-yellow-400">{{ auto.modelo }}</span>
                    </h1>

                    <p class="mt-5 max-w-2xl text-lg md:text-xl text-slate-200 leading-relaxed">
                        {{ descripcion }}
                    </p>
                </div>
            </div>
        </section>

        <section class="py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-14">
                <div class="lg:col-span-2 space-y-12">
                    <div>
                        <div class="flex items-center gap-3 mb-8">
                            <span class="material-symbols-outlined text-yellow-600 bg-yellow-50 p-3 rounded-xl">fact_check</span>
                            <div>
                                <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Ficha del vehiculo</p>
                                <h2 class="text-3xl font-extrabold text-slate-950">Especificaciones principales</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                            <div
                                v-for="item in especificaciones"
                                :key="item.etiqueta"
                                class="rounded-2xl border border-slate-100 bg-slate-50 p-5"
                            >
                                <div class="flex items-center gap-2 text-slate-400 mb-3">
                                    <span class="material-symbols-outlined text-lg">{{ item.icono }}</span>
                                    <span class="text-xs font-bold uppercase tracking-widest">{{ item.etiqueta }}</span>
                                </div>
                                <p class="text-lg font-extrabold text-slate-950">{{ item.valor }}</p>
                            </div>
                        </div>
                    </div>

                    <div v-if="detallesTecnicos.length" class="rounded-3xl border border-slate-100 bg-white p-6 md:p-8 shadow-sm">
                        <h3 class="text-2xl font-extrabold text-slate-950 mb-6">Detalles tecnicos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                            <div
                                v-for="item in detallesTecnicos"
                                :key="item.etiqueta"
                                class="flex items-center justify-between gap-4 py-4 border-b border-slate-100"
                            >
                                <span class="text-sm font-semibold text-slate-500">{{ item.etiqueta }}</span>
                                <span class="text-sm font-bold text-slate-950 text-right">{{ item.valor }}</span>
                            </div>
                        </div>
                    </div>

                    <div v-if="detallesVehiculo.length" class="rounded-3xl border border-yellow-100 bg-gradient-to-br from-yellow-50 via-white to-slate-50 p-6 md:p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined rounded-xl bg-yellow-500 p-3 text-slate-950">format_list_bulleted</span>
                            <div>
                                <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Detalles del vehiculo</p>
                                <h3 class="text-2xl font-extrabold text-slate-950">Lo que incluye esta unidad</h3>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <div
                                v-for="detalle in detallesVehiculo"
                                :key="detalle"
                                class="flex items-start gap-3 rounded-2xl border border-white bg-white/80 p-4 text-sm font-semibold leading-relaxed text-slate-700 shadow-sm shadow-slate-200/50"
                            >
                                <span class="material-symbols-outlined mt-0.5 text-lg text-yellow-600">check</span>
                                <span>{{ detalle }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-slate-950 text-white p-6 md:p-8">
                        <h3 class="text-2xl font-extrabold mb-5">Informacion destacada</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                v-for="item in destacados"
                                :key="item"
                                class="flex items-start gap-3 rounded-2xl bg-white/5 p-4"
                            >
                                <span class="material-symbols-outlined text-yellow-400">check_circle</span>
                                <p class="text-sm leading-relaxed text-slate-200">{{ item }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-1">
                    <div class="sticky top-28 rounded-3xl border border-slate-100 bg-white p-6 md:p-8 shadow-xl shadow-slate-200/70">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Precio publicado</p>
                        <p class="text-4xl font-extrabold text-slate-950">{{ precio(auto.precio) }}</p>
                        <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                            Consulta disponibilidad, formas de pago y agenda una visita para revisar este vehiculo.
                        </p>

                        <div class="mt-8 space-y-3">
                            <Link
                                :href="`/autos/${auto.id}/consulta`"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-500 px-6 py-4 text-sm font-black text-slate-950 hover:bg-yellow-400 transition-colors"
                            >
                                Iniciar chat
                                <span class="material-symbols-outlined text-lg">arrow_forward</span>
                            </Link>
                            <a
                                href="https://wa.me/56954083118"
                                target="_blank"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-4 text-sm font-bold text-slate-800 hover:bg-slate-50 transition-colors"
                            >
                                WhatsApp
                                <span class="material-symbols-outlined text-lg">chat</span>
                            </a>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100 space-y-3 text-sm">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-slate-500">Estado</span>
                                <span class="font-bold text-slate-950 capitalize">{{ auto.estado || 'disponible' }}</span>
                            </div>
                            <div v-if="auto.resumen" class="rounded-2xl bg-slate-50 p-4 text-slate-600 leading-relaxed">
                                {{ auto.resumen }}
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>

    <Footer />
</template>
