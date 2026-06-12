<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

defineProps({
    auth: Object,
});

const pasos = [
    {
        numero: '01',
        titulo: 'Revisa el stock',
        texto: 'En el catalogo puedes ver marca, modelo, año, precio y detalles principales de cada vehiculo publicado.',
        icono: 'search',
        fondo: 'bg-blue-50',
        borde: 'border-blue-100',
        numeroColor: 'text-blue-200',
        iconoCaja: 'bg-blue-600 text-white',
        linea: 'bg-blue-500',
    },
    {
        numero: '02',
        titulo: 'Consulta detalles',
        texto: 'Puedes contactarnos por chat mediante la web, por WhatsApp o por formulario. Asi resolvemos dudas sobre estado, documentos, precio o disponibilidad.',
        icono: 'forum',
        fondo: 'bg-emerald-50',
        borde: 'border-emerald-100',
        numeroColor: 'text-emerald-200',
        iconoCaja: 'bg-emerald-600 text-white',
        linea: 'bg-emerald-500',
    },
    {
        numero: '03',
        titulo: 'Coordina visita',
        texto: 'Agendamos un horario para que puedas revisar el auto con calma y confirmar si se ajusta a lo que buscas.',
        icono: 'event_available',
        fondo: 'bg-violet-50',
        borde: 'border-violet-100',
        numeroColor: 'text-violet-200',
        iconoCaja: 'bg-violet-600 text-white',
        linea: 'bg-violet-500',
    },
    {
        numero: '04',
        titulo: 'Cierre y entrega',
        texto: 'Si decides avanzar, revisamos condiciones, pago, documentos, descuentos y entrega para que la compra quede clara.',
        icono: 'fact_check',
        fondo: 'bg-amber-50',
        borde: 'border-amber-100',
        numeroColor: 'text-amber-200',
        iconoCaja: 'bg-yellow-500 text-slate-950',
        linea: 'bg-yellow-500',
    },
];

const preguntas = [
    {
        pregunta: 'Como puedo consultar por un vehiculo?',
        respuesta: 'Puedes iniciar un chat mediante la web desde la ficha del vehiculo si tienes cuenta, escribir por WhatsApp o usar el formulario de contacto.',
    },
    {
        pregunta: 'Reciben mi vehiculo como parte de pago?',
        respuesta: 'Si. Podemos revisar vehiculos de menor costo y, segun su estado mecanico, documentacion, kilometraje y mercado, asignar un valor para descontarlo del precio final.',
    },
    {
        pregunta: 'Tengo que crear cuenta para consultar?',
        respuesta: 'Para usar el chat mediante la web si necesitas una cuenta. Para una consulta rapida tambien puedes escribir por WhatsApp o formulario.',
    },
    {
        pregunta: 'Puedo agendar una visita antes de decidir?',
        respuesta: 'Si. Coordinamos un horario para que revises el auto con calma y puedas resolver dudas antes de avanzar.',
    },
];
</script>

<template>
    <Head title="Como comprar" />
    <Navbar />

    <section class="py-24 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl mb-20">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 mb-6 shadow-inner">
                    <span class="material-symbols-outlined text-sm text-yellow-600 mr-2">shopping_cart</span>
                    <span class="text-xs font-semibold uppercase tracking-wider">Proceso de compra</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-950 tracking-tight mb-4">
                    Comprar un vehiculo en <span class="text-yellow-600">Importadora Cartes</span>
                </h1>
                <p class="text-slate-600 text-lg leading-relaxed">
                    Hacemos simple el proceso: ves el stock, consultas por chat mediante la web o WhatsApp, coordinas una visita y avanzamos con la compra cuando el auto te convence.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    v-for="paso in pasos"
                    :key="paso.numero"
                    :class="[paso.fondo, paso.borde]"
                    class="group relative overflow-hidden p-8 rounded-3xl border flex flex-col justify-between h-full transition-all hover:-translate-y-1 hover:shadow-xl"
                >
                    <div :class="paso.linea" class="absolute left-0 top-0 h-1.5 w-full"></div>
                    <div class="absolute -right-8 -top-8 z-0 h-28 w-28 rounded-full bg-white/70"></div>
                    <div class="relative z-10">
                        <div class="flex items-start justify-between gap-4 mb-8">
                            <div :class="paso.numeroColor" class="relative z-20 text-6xl font-black leading-none">{{ paso.numero }}</div>
                            <span :class="paso.iconoCaja" style="z-index: 100;" class="material-symbols-outlined relative z-20 flex h-12 w-12 items-center justify-center rounded-2xl shadow-lg transition-transform group-hover:scale-110">
                                {{ paso.icono }}
                            </span>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-950 mb-3">{{ paso.titulo }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ paso.texto }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 rounded-3xl border border-yellow-100 bg-yellow-50 p-8">
                    <div class="flex flex-col md:flex-row gap-6 md:items-start">
                        <span class="material-symbols-outlined flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-500 text-slate-950">sync_alt</span>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-yellow-700">Vehiculo en parte de pago</p>
                            <h2 class="mt-2 text-2xl font-extrabold text-slate-950">Tambien recibimos vehiculos de menor costo</h2>
                            <p class="mt-3 text-sm leading-relaxed text-slate-700">
                                Si tienes un vehiculo que quieres entregar, podemos evaluarlo. Dependiendo de su estado mecanico, documentos, kilometraje, detalles esteticos y valor de mercado, asignamos un monto para descontarlo del vehiculo que quieres comprar.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Canales de contacto</p>
                    <div class="mt-5 space-y-3">
                        <Link href="/tickets" class="flex items-center justify-between rounded-2xl bg-slate-950 px-4 py-3 text-sm font-black text-white hover:bg-slate-800">
                            Chat mediante la web
                            <span class="material-symbols-outlined text-lg">forum</span>
                        </Link>
                        <a href="https://wa.me/56954083118" target="_blank" class="flex items-center justify-between rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-black text-emerald-700 hover:bg-emerald-100">
                            WhatsApp
                            <span class="material-symbols-outlined text-lg">chat</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-20 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-slate-950 text-white rounded-3xl overflow-hidden p-8 sm:p-12 shadow-xl">
                <div class="lg:col-span-7">
                    <span class="text-xs font-bold uppercase tracking-widest text-yellow-500 mb-3 block">Compra con informacion clara</span>
                    <h2 class="text-3xl font-extrabold tracking-tight mb-4">Que revisamos contigo antes de comprar</h2>
                    <p class="text-slate-300 text-sm leading-relaxed mb-6">
                        Queremos que tomes una decision tranquila. Por eso te entregamos los datos principales del vehiculo y respondemos las dudas antes de cerrar.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-200">
                            <span class="material-symbols-outlined text-yellow-500 text-base">check_circle</span>
                            <span>Año, version y kilometraje</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-200">
                            <span class="material-symbols-outlined text-yellow-500 text-base">check_circle</span>
                            <span>Precio y forma de pago</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-200">
                            <span class="material-symbols-outlined text-yellow-500 text-base">check_circle</span>
                            <span>Disponibilidad para visita</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-200">
                            <span class="material-symbols-outlined text-yellow-500 text-base">check_circle</span>
                            <span>Documentos para transferencia</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-200">
                            <span class="material-symbols-outlined text-yellow-500 text-base">check_circle</span>
                            <span>Evaluacion de vehiculo en parte de pago</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-200">
                            <span class="material-symbols-outlined text-yellow-500 text-base">check_circle</span>
                            <span>Atencion por chat web o WhatsApp</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 bg-slate-900 p-8 rounded-2xl border border-slate-800 flex flex-col justify-between h-full">
                    <div>
                        <h4 class="font-bold text-lg mb-2">Quieres ver un auto?</h4>
                        <p class="text-sm text-slate-400 leading-relaxed mb-6">
                            Envia una consulta y dinos que vehiculo te interesa. Te respondemos con disponibilidad y horario.
                        </p>
                    </div>
                    <Link href="/contacto" class="w-full flex items-center justify-center py-3 bg-yellow-500 hover:bg-yellow-400 text-slate-950 font-bold text-sm rounded-xl transition-all shadow-md">
                        Consultar vehiculo
                        <span class="material-symbols-outlined ml-2 text-lg">arrow_forward</span>
                    </Link>
                </div>
            </div>

            <div class="mt-20 grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-4">
                    <span class="text-xs font-black uppercase tracking-widest text-yellow-600">Ayuda para clientes</span>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-950">Preguntas frecuentes</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-600">
                        Si tienes dudas antes de escribirnos, estas respuestas te ayudan a entender el proceso y elegir el mejor canal de contacto.
                    </p>
                </div>

                <div class="lg:col-span-8 space-y-4">
                    <details
                        v-for="item in preguntas"
                        :key="item.pregunta"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm open:border-yellow-200 open:bg-yellow-50/40"
                    >
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-base font-black text-slate-950">
                            {{ item.pregunta }}
                            <span class="material-symbols-outlined text-slate-400 transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <p class="mt-4 text-sm leading-relaxed text-slate-600">
                            {{ item.respuesta }}
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <Footer />
</template>
