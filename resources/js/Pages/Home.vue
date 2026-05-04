<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';

// Props típicos de Stepia/Breeze
defineProps({
    auth: Object,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Inicio" />
    <Navbar />
    <div>
        <pre>{{ $page.props.auth.user }}</pre>
    </div>
    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
        <div class="relative z-10 bg-white pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">

            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
            <div class="sm:text-center lg:text-left">

                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 mb-6 shadow-inner">
                <span class="material-symbols-outlined text-sm text-yellow-600 mr-2">verified</span>
                <span class="text-xs font-semibold uppercase tracking-wider">Importación Asegurada</span>
                </div>

                <h1 class="text-4xl tracking-tight font-extrabold text-slate-950 sm:text-5xl md:text-6xl leading-tight">
                <span class="block">El lujo coreano,</span>
                <span class="block text-yellow-600">sin intermediarios.</span>
                </h1>

                <p class="mt-3 text-base text-slate-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                Accede directamente al mercado doméstico de Seúl. Especialistas en la adquisición y logística de modelos exclusivos de Hyundai y Kia para Chile. Transparencia total en cada kilómetro.
                </p>

                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-4">
                <div class="rounded-md shadow">
                    <Link href="/catalogo" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-bold rounded-md text-slate-950 bg-yellow-500 hover:bg-yellow-400 md:py-4 md:text-lg md:px-10 transition-colors">
                    Explorar Catálogo
                    <span class="material-symbols-outlined ml-2">directions_car</span>
                    </Link>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-3">
                    <Link href="/contacto" class="w-full flex items-center justify-center px-8 py-3 border border-slate-300 text-base font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50 md:py-4 md:text-lg md:px-10 transition-colors">
                    Solicitar Cotización
                    </Link>
                </div>
                </div>

            </div>
            </main>
        </div>
        </div>

        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/img/home-auto.avif" alt="Interior luxury car South Korea">

        <div class="absolute inset-0 bg-gradient-to-t from-white lg:from-transparent lg:bg-gradient-to-l lg:to-white/50 opacity-30"></div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="mb-16">
            <h2 class="text-xs font-bold uppercase tracking-widest text-yellow-600 mb-4">Unmatched Value</h2>
            <h3 class="text-4xl md:text-5xl font-extrabold text-gray-900">Why Import from Korea?</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            <div class="md:col-span-7 bg-white p-10 rounded-3xl border border-gray-100 shadow-sm">
            <span class="material-symbols-outlined text-4xl text-yellow-500 mb-6">verified_user</span>
            <h4 class="text-3xl font-bold text-gray-900 mb-4">Meticulous Maintenance</h4>
            <p class="text-gray-600 leading-relaxed">
                Korean domestic market vehicles are subjected to the world's most rigorous periodic inspections.
                We source only "Grade A" certified units with complete service records.
            </p>
            </div>

            <div class="md:col-span-5 bg-gray-900 text-white p-10 rounded-3xl shadow-xl">
            <span class="material-symbols-outlined text-4xl text-yellow-500 mb-6">electric_car</span>
            <h4 class="text-2xl font-bold mb-4">Cutting-Edge Tech</h4>
            <p class="text-gray-300 leading-relaxed">
                Access the latest EV and Hybrid technology years before they hit the global market.
                Get exclusive trims and features available only to the domestic Korean market.
            </p>
            </div>

            <div class="md:col-span-4 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <span class="material-symbols-outlined text-yellow-600 bg-yellow-50 p-3 rounded-lg">currency_exchange</span>
            <div>
                <h5 class="text-lg font-bold text-gray-900">30% Savings</h5>
                <p class="text-sm text-gray-500">Avg. reduction vs local MSRP</p>
            </div>
            </div>

            <div class="md:col-span-4 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-3 rounded-lg">local_shipping</span>
            <div>
                <h5 class="text-lg font-bold text-gray-900">45 Days</h5>
                <p class="text-sm text-gray-500">Average delivery time</p>
            </div>
            </div>

            <div class="md:col-span-4 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <span class="material-symbols-outlined text-green-600 bg-green-50 p-3 rounded-lg">public</span>
            <div>
                <h5 class="text-lg font-bold text-gray-900">Global Reach</h5>
                <p class="text-sm text-gray-500">Registered in 24 countries</p>
            </div>
            </div>
        </div>
        </div>
        </section>

        <!-- <section id="marcas" class="py-24 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-gray-900">Nuestra Especialidad</h2>
                <div class="h-1 w-20 bg-[#e2b808] mx-auto mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition-all">
                    <h3 class="text-4xl font-black text-[#003473] mb-2">HYUNDAI</h3>
                    <p class="text-gray-500 mb-8">Modelos Tucson, Santa Fe e Ioniq. Calidad coreana superior.</p>
                    <Link href="/catalogo/hyundai" class="inline-flex items-center font-bold text-[#e2b808] group-hover:gap-3 transition-all">
                        Explorar Hyundai <span class="material-symbols-outlined ml-2">arrow_forward</span>
                    </Link>
                </div>

                <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition-all">
                    <h3 class="text-4xl font-black text-[#bb162b] italic mb-2">KIA</h3>
                    <p class="text-gray-500 mb-8">Sportage, Sorento y EV6. El futuro de la conducción.</p>
                    <Link href="/catalogo/kia" class="inline-flex items-center font-bold text-[#e2b808] group-hover:gap-3 transition-all">
                        Explorar Kia <span class="material-symbols-outlined ml-2">arrow_forward</span>
                    </Link>
                </div>
            </div>
        </section> -->
        <Footer />
</template>

<style>
/* Estilos globales para Stepia */
html { scroll-behavior: smooth; }
body { font-family: 'Inter', sans-serif; }
h1, h2, h3 { font-family: 'Manrope', sans-serif; }
</style>
