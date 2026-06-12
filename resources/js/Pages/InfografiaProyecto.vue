<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

const pilares = [
    {
        icono: 'directions_car',
        titulo: 'Catalogo publico',
        texto: 'Muestra vehiculos publicados con precio, año, kilometraje, tag, imagen y acceso rapido al detalle.',
        color: 'bg-blue-50 text-blue-700 ring-blue-100',
    },
    {
        icono: 'fact_check',
        titulo: 'Ficha completa',
        texto: 'Cada auto puede incluir especificaciones, informacion destacada, detalles, seguridad y tecnologia.',
        color: 'bg-yellow-50 text-yellow-700 ring-yellow-100',
    },
    {
        icono: 'support_agent',
        titulo: 'Contacto y cotizaciones',
        texto: 'El formulario recibe nombre, correo, telefono chileno, vehiculo de interes y mensaje del cliente.',
        color: 'bg-emerald-50 text-emerald-700 ring-emerald-100',
    },
    {
        icono: 'forum',
        titulo: 'Tickets por vehiculo',
        texto: 'Usuarios registrados pueden iniciar conversaciones asociadas a un auto y seguir respuestas del equipo.',
        color: 'bg-violet-50 text-violet-700 ring-violet-100',
    },
];

const flujoCliente = [
    ['01', 'Explora', 'El cliente entra al inicio o catalogo y revisa el stock disponible.'],
    ['02', 'Compara', 'Abre la ficha del auto para revisar precio, equipamiento y datos clave.'],
    ['03', 'Consulta', 'Puede escribir por formulario, WhatsApp o chat con cuenta registrada.'],
    ['04', 'Coordina', 'El equipo responde disponibilidad, visita, pago, documentos y entrega.'],
];

const administracion = [
    'Panel con resumen de vehiculos, usuarios, ventas y cotizaciones pendientes.',
    'CRUD de autos con imagen, precio, estado, destacado, ficha tecnica y detalles.',
    'Gestion de cotizaciones recibidas desde contacto.',
    'Atencion de tickets con reclamo por administrador para evitar dobles respuestas.',
];

const datos = [
    { etiqueta: 'Autos', valor: 'stock inicial', detalle: 'Tucson, Swift, Corolla y Sportage desde seeder' },
    { etiqueta: 'Usuarios', valor: 'roles', detalle: 'cliente y admin mediante permisos' },
    { etiqueta: 'Cotizaciones', valor: '+56', detalle: 'validacion de contacto con telefono chileno' },
    { etiqueta: 'Tickets', valor: 'chat', detalle: 'mensajes vinculados a cliente, admin y vehiculo' },
];

const stack = [
    'Laravel',
    'Inertia',
    'Vue',
    'Tailwind',
    'Pest',
    'Vite',
    'Eloquent',
    'Spatie Roles',
];
</script>

<template>
    <Head title="Infografia del proyecto" />
    <Navbar />

    <main class="bg-white">
        <section class="relative overflow-hidden bg-slate-950 px-6 py-20 text-white lg:px-8">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-yellow-400 to-emerald-500"></div>
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 lg:grid-cols-12 lg:items-end">
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-widest text-yellow-300">
                        <span class="material-symbols-outlined text-base">schema</span>
                        Vista general
                    </span>
                    <div class="mt-5 inline-flex max-w-full items-start gap-3 rounded-2xl border border-yellow-400/30 bg-yellow-400/10 px-4 py-3 text-sm font-bold leading-relaxed text-yellow-100">
                        <span class="material-symbols-outlined mt-0.5 text-lg text-yellow-300">edit_note</span>
                        <span>Borrador de Infografía: Primera versión del póster (estructura y datos clave).</span>
                    </div>
                    <h1 class="mt-8 max-w-4xl text-4xl font-black tracking-tight sm:text-6xl">
                        Infografia del proyecto Importadora Cartes
                    </h1>
                    <p class="mt-6 max-w-2xl text-base leading-relaxed text-slate-300 sm:text-lg">
                        Plataforma web para publicar vehiculos usados, recibir consultas, administrar stock y mantener conversaciones directas entre clientes y administradores.
                    </p>
                </div>

                <div class="lg:col-span-5">
                    <div class="grid grid-cols-2 gap-3">
                        <div
                            v-for="item in datos"
                            :key="item.etiqueta"
                            class="rounded-2xl border border-white/10 bg-white/5 p-5"
                        >
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">{{ item.etiqueta }}</p>
                            <p class="mt-2 text-2xl font-black text-yellow-300">{{ item.valor }}</p>
                            <p class="mt-2 text-xs leading-relaxed text-slate-300">{{ item.detalle }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 py-16 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-yellow-600">Modulos principales</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Como se organiza la experiencia</h2>
                    </div>
                    <Link href="/catalogo" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 py-3 text-sm font-black text-white hover:bg-slate-800">
                        Ver catalogo
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </Link>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
                    <article
                        v-for="pilar in pilares"
                        :key="pilar.titulo"
                        class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
                    >
                        <span :class="pilar.color" class="material-symbols-outlined inline-flex h-12 w-12 items-center justify-center rounded-xl text-2xl ring-1">
                            {{ pilar.icono }}
                        </span>
                        <h3 class="mt-5 text-lg font-black text-slate-950">{{ pilar.titulo }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ pilar.texto }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="bg-slate-50 px-6 py-16 lg:px-8">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <p class="text-xs font-black uppercase tracking-widest text-blue-700">Recorrido del cliente</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Desde mirar un auto hasta coordinar compra</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-600">
                        El sitio junta informacion clara, contacto directo y seguimiento para que el cliente no pierda contexto.
                    </p>
                </div>

                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div
                            v-for="[numero, titulo, texto] in flujoCliente"
                            :key="numero"
                            class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
                        >
                            <span class="absolute right-5 top-4 text-5xl font-black leading-none text-slate-100">{{ numero }}</span>
                            <div class="relative">
                                <h3 class="text-xl font-black text-slate-950">{{ titulo }}</h3>
                                <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ texto }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 py-16 lg:px-8">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <div class="rounded-3xl bg-slate-950 p-8 text-white">
                        <p class="text-xs font-black uppercase tracking-widest text-yellow-400">Panel administrativo</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight">Control del negocio</h2>
                        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div
                                v-for="item in administracion"
                                :key="item"
                                class="flex items-start gap-3 rounded-2xl bg-white/5 p-4"
                            >
                                <span class="material-symbols-outlined text-yellow-400">check_circle</span>
                                <p class="text-sm leading-relaxed text-slate-200">{{ item }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="h-full rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                        <p class="text-xs font-black uppercase tracking-widest text-emerald-700">Base tecnica</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Stack y piezas del sistema</h2>
                        <div class="mt-7 flex flex-wrap gap-3">
                            <span
                                v-for="item in stack"
                                :key="item"
                                class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-black text-slate-700"
                            >
                                {{ item }}
                            </span>
                        </div>
                        <div class="mt-8 rounded-2xl bg-emerald-50 p-5 text-sm leading-relaxed text-emerald-900">
                            Laravel ordena rutas, modelos, validaciones y panel; Inertia conecta las paginas Vue; Tailwind define el lenguaje visual; Eloquent mantiene autos, cotizaciones, tickets y usuarios.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 pb-20 lg:px-8">
            <div class="mx-auto max-w-7xl rounded-3xl border border-yellow-100 bg-yellow-50 p-8">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-center">
                    <div class="lg:col-span-8">
                        <p class="text-xs font-black uppercase tracking-widest text-yellow-700">Resumen final</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Un sitio comercial con gestion interna completa</h2>
                        <p class="mt-4 text-sm leading-relaxed text-slate-700">
                            El proyecto cubre vitrina publica, detalle de vehiculos, captacion de clientes, conversaciones, roles de usuario y administracion del inventario desde un mismo flujo.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row lg:col-span-4 lg:justify-end">
                        <Link href="/contacto" class="inline-flex items-center justify-center rounded-xl bg-yellow-500 px-6 py-3 text-sm font-black text-slate-950 hover:bg-yellow-400">
                            Contacto
                        </Link>
                        <Link href="/admin/panel" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-black text-slate-800 hover:bg-slate-50">
                            Panel admin
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <Footer />
</template>
