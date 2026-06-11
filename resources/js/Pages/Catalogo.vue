<script setup>
import { computed, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

const props = defineProps({
    auth: Object,
    autos: {
        type: Array,
        default: () => [],
    },
});

const filtroSeleccionado = ref('todos');
const ordenPrecio = ref('recientes');

const marcas = computed(() => {
    return [...new Set(props.autos.map((auto) => auto.marca).filter(Boolean))].sort();
});

const autosFiltrados = computed(() => {
    const autos = filtroSeleccionado.value === 'todos'
        ? props.autos
        : props.autos.filter((auto) => auto.marca === filtroSeleccionado.value);

    if (ordenPrecio.value === 'menor') {
        return [...autos].sort((a, b) => (a.precio || 0) - (b.precio || 0));
    }

    if (ordenPrecio.value === 'mayor') {
        return [...autos].sort((a, b) => (b.precio || 0) - (a.precio || 0));
    }

    return autos;
});

const limpiarFiltros = () => {
    filtroSeleccionado.value = 'todos';
    ordenPrecio.value = 'recientes';
};

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
    <Head title="Vehiculos" />
    <Navbar />

    <section class="py-24 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-slate-100 pb-10 mb-12 gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 mb-4 shadow-inner">
                        <span class="material-symbols-outlined text-sm text-yellow-600 mr-2">directions_car</span>
                        <span class="text-xs font-semibold uppercase tracking-wider">Stock disponible</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-slate-950 tracking-tight mb-4">
                        Vehiculos <span class="text-yellow-600">en venta</span>
                    </h1>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        Revisa autos usados disponibles en Importadora Cartes. Filtra por marca y consulta el modelo que te interese.
                    </p>
                </div>

                <Link href="/contacto" class="inline-flex items-center justify-center px-6 py-3 border border-slate-300 text-sm font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 transition-colors shadow-sm">
                    Consultar disponibilidad
                </Link>
            </div>

            <div class="mb-10 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-wrap gap-3">
                    <button
                        @click="filtroSeleccionado = 'todos'"
                        :class="filtroSeleccionado === 'todos' ? 'bg-yellow-500 text-slate-950 font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 font-medium'"
                        class="px-5 py-2.5 rounded-xl border border-transparent text-sm transition-all shadow-sm"
                    >
                        Todos
                    </button>
                    <button
                        v-for="marca in marcas"
                        :key="marca"
                        @click="filtroSeleccionado = marca"
                        :class="filtroSeleccionado === marca ? 'bg-slate-950 text-white font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 font-medium'"
                        class="px-5 py-2.5 rounded-xl border border-transparent text-sm transition-all shadow-sm uppercase"
                    >
                        {{ marca }}
                    </button>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <label for="orden-precio" class="text-xs font-black uppercase tracking-widest text-slate-400">Ordenar</label>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-yellow-600">sort</span>
                        <select
                            id="orden-precio"
                            v-model="ordenPrecio"
                            class="h-11 min-w-[220px] rounded-xl border border-slate-200 bg-white pl-11 pr-10 text-sm font-bold text-slate-700 shadow-sm outline-none transition focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100"
                        >
                            <option value="recientes">Mas recientes</option>
                            <option value="menor">Precio menor a mayor</option>
                            <option value="mayor">Precio mayor a menor</option>
                        </select>
                    </div>

                    <button
                        v-if="filtroSeleccionado !== 'todos' || ordenPrecio !== 'recientes'"
                        type="button"
                        @click="limpiarFiltros"
                        class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-50"
                    >
                        Limpiar
                    </button>
                </div>
            </div>

            <div v-if="autosFiltrados.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article
                    v-for="auto in autosFiltrados"
                    :key="auto.id"
                    class="group bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer focus:outline-none focus:ring-4 focus:ring-yellow-200"
                    tabindex="0"
                    @click="verDetalle(auto)"
                    @keydown.enter="verDetalle(auto)"
                >
                    <div class="relative bg-slate-900 aspect-[16/10] overflow-hidden">
                        <img
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-95"
                            :src="auto.imagen || '/img/home-auto.avif'"
                            :alt="auto.modelo"
                        >
                        <span class="absolute top-4 left-4 bg-slate-950/80 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider">
                            {{ auto.tag || auto.estado }}
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-black uppercase tracking-widest text-yellow-600">
                                    {{ auto.marca }}
                                </span>
                                <span class="text-xs font-medium text-slate-400 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">local_gas_station</span>
                                    {{ auto.combustible || 'Consultar' }}
                                </span>
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-950 mb-1 group-hover:text-yellow-600 transition-colors">
                                {{ auto.modelo }}
                            </h3>
                            <p class="text-sm text-slate-500 font-medium mb-4">
                                {{ auto.version || auto.descripcion_breve || `${auto.anio}` }}
                            </p>

                            <div class="border-t border-slate-100 pt-4 space-y-2">
                                <div class="flex items-center text-sm text-slate-600 gap-2">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">calendar_month</span>
                                    <span>Año: <strong class="text-slate-900 font-semibold">{{ auto.anio }}</strong></span>
                                </div>
                                <div class="flex items-center text-sm text-slate-600 gap-2">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">settings</span>
                                    <span>Motor: <strong class="text-slate-900 font-semibold">{{ auto.motor || 'Por confirmar' }}</strong></span>
                                </div>
                                <div class="flex items-center text-sm text-slate-600 gap-2">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">payments</span>
                                    <span>Precio: <strong class="text-slate-900 font-semibold">{{ precio(auto.precio) }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-50">
                            <Link
                                :href="`/autos/${auto.id}`"
                                @click.stop
                                class="w-full flex items-center justify-center py-3 bg-slate-50 hover:bg-yellow-500 rounded-xl text-slate-900 font-bold text-sm transition-all group-hover:shadow-inner"
                            >
                                Ver detalle
                                <span class="material-symbols-outlined ml-2 text-lg">arrow_forward</span>
                            </Link>
                        </div>
                    </div>
                </article>
            </div>

            <div v-else class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 p-10 text-center">
                <p class="text-sm font-bold uppercase tracking-widest text-slate-400">Sin resultados</p>
                <p class="mt-2 text-slate-600">No hay vehiculos publicados para este filtro.</p>
            </div>
        </div>
    </section>

    <Footer />
</template>
