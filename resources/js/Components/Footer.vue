<template>
  <footer class="bg-white border-t border-slate-200">
    <div class="grid grid-cols-1 md:grid-cols-8 px-8 py-20 gap-12 w-full max-w-7xl mx-auto">
      <div class="md:col-span-4">
        <div class="text-2xl font-black text-slate-950 mb-6 tracking-tighter">IMPORTADORA CARTES</div>
        <p class="text-slate-600 text-sm leading-relaxed mb-6 max-w-xs">
          Venta de vehiculos seleccionados en Punta Arenas. Atencion directa, datos claros y apoyo para elegir tu proximo auto.
        </p>
      </div>

      <div class="md:col-span-2">
        <h4 class="text-slate-950 font-bold mb-6 text-sm uppercase tracking-wider">Empresa</h4>
        <ul class="space-y-4 text-sm">
          <li><a href="/contacto" class="text-slate-600 hover:text-blue-600 transition-colors flex items-center gap-2">Contacto</a></li>
          <li><a href="/quienes-somos" class="text-slate-600 hover:text-blue-600 transition-colors flex items-center gap-2">Nosotros</a></li>
          <li><a href="/como-importamos" class="text-slate-600 hover:text-blue-600 transition-colors flex items-center gap-2">Como comprar</a></li>
        </ul>
      </div>

      <div class="md:col-span-2">
        <h4 class="text-slate-950 font-bold mb-6 text-sm uppercase tracking-wider">Vehiculos</h4>
        <ul class="space-y-4 text-sm">
          <li><a href="/catalogo" class="text-slate-600 hover:text-blue-600 transition-colors">Autos usados</a></li>
          <li><a href="/catalogo" class="text-slate-600 hover:text-blue-600 transition-colors">Sedanes</a></li>
          <li><a href="/catalogo" class="text-slate-600 hover:text-blue-600 transition-colors">SUVs y hatchbacks</a></li>
        </ul>
      </div>
    </div>

    <div class="border-t border-slate-100 py-8 text-center text-slate-400 text-xs">
      &copy; {{ new Date().getFullYear() }} Importadora Cartes. Todos los derechos reservados.
    </div>
  </footer>
</template>
