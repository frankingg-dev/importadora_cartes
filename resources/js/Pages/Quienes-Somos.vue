<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

defineProps({
    auth: Object,
});
</script>

<template>
    <Head title="Importadora Cartes" />
    <Navbar />

    <section class="py-24 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl mb-20">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 mb-6 shadow-inner">
                    <span class="material-symbols-outlined text-sm text-yellow-600 mr-2">storefront</span>
                    <span class="text-xs font-semibold uppercase tracking-wider">Venta de vehiculos</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-950 tracking-tight mb-4">
                    Somos <span class="text-yellow-600">Importadora Cartes</span>
                </h1>
                <p class="text-slate-600 text-lg leading-relaxed">
                    Una pagina pensada para mostrar vehiculos disponibles, recibir consultas y administrar el stock desde un panel simple.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24">
                <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100 hover:border-slate-200 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-500/10 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-yellow-600 text-2xl">flag</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-950 mb-4">Nuestra forma de trabajar</h2>
                    <p class="text-slate-600 leading-relaxed text-sm">
                        Mostramos el stock con datos concretos y respondemos consultas de forma directa para que el cliente pueda comparar y decidir con informacion clara.
                    </p>
                </div>

                <div class="bg-slate-950 text-white p-10 rounded-3xl shadow-xl relative overflow-hidden">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-yellow-500 text-2xl">visibility</span>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Objetivo</h2>
                    <p class="text-slate-300 leading-relaxed text-sm">
                        Que la compra de un vehiculo usado sea mas simple: ver opciones, consultar rapido, coordinar visita y cerrar con tranquilidad.
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-20">
                <div class="mb-12">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-yellow-600 mb-2">Pilares</h3>
                    <h4 class="text-3xl font-extrabold text-slate-950">Lo que cuidamos en cada venta</h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 rounded-2xl border border-slate-100 bg-white">
                        <span class="material-symbols-outlined text-yellow-600 mb-4 text-3xl">description</span>
                        <h5 class="text-lg font-bold text-slate-950 mb-2">Informacion ordenada</h5>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Cada publicacion muestra los datos principales para que el comprador tenga una primera mirada clara.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl border border-slate-100 bg-white">
                        <span class="material-symbols-outlined text-yellow-600 mb-4 text-3xl">verified</span>
                        <h5 class="text-lg font-bold text-slate-950 mb-2">Stock administrable</h5>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            El panel permite cargar, revisar y quitar vehiculos para mantener actualizado lo que ve el cliente.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl border border-slate-100 bg-white">
                        <span class="material-symbols-outlined text-yellow-600 mb-4 text-3xl">handshake</span>
                        <h5 class="text-lg font-bold text-slate-950 mb-2">Contacto directo</h5>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Las consultas llegan al panel para dar seguimiento y responder sin perder oportunidades.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-24 text-center bg-slate-50 rounded-3xl p-12 border border-slate-100">
                <h4 class="text-2xl font-bold text-slate-950 mb-3">Listo para ver opciones?</h4>
                <p class="text-slate-600 text-sm max-w-xl mx-auto mb-6">
                    Revisa el stock disponible o dejanos una consulta si buscas algo especifico.
                </p>
                <div class="flex justify-center gap-4">
                    <Link href="/catalogo" class="inline-flex items-center justify-center px-6 py-3 bg-yellow-500 hover:bg-yellow-400 text-slate-950 font-bold text-sm rounded-xl transition-all shadow-sm">
                        Ver vehiculos
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <Footer />
</template>
