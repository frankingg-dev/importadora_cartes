<template>
  <footer class="bg-white border-t border-slate-200">
    <div class="grid grid-cols-1 md:grid-cols-8 px-8 py-20 gap-12 w-full max-w-7xl mx-auto">

      <div class="md:col-span-4">
        <div class="text-2xl font-black text-slate-950 mb-6 tracking-tighter">IMPORTADORA CARTES<span class="text-blue-600"></span></div>
        <p class="text-slate-600 text-sm leading-relaxed mb-6 max-w-xs">
          Tu socio estratégico para la importación directa desde Corea. Calidad certificada y logística transparente.
        </p>
        <div class="flex gap-4">
           </div>
      </div>

      <div class="md:col-span-2">
        <h4 class="text-slate-950 font-bold mb-6 text-sm uppercase tracking-wider">Empresa</h4>
        <ul class="space-y-4 text-sm">
          <li><a href="#" class="text-slate-600 hover:text-blue-600 transition-colors flex items-center gap-2">Contacto</a></li>
          <li><a href="#" class="text-slate-600 hover:text-blue-600 transition-colors flex items-center gap-2">Privacidad</a></li>
          <li><a href="#" class="text-slate-600 hover:text-blue-600 transition-colors flex items-center gap-2">Términos</a></li>
        </ul>
      </div>

      <div class="md:col-span-2">
        <h4 class="text-slate-950 font-bold mb-6 text-sm uppercase tracking-wider">Catálogo</h4>
        <ul class="space-y-4 text-sm">
          <li><a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">EVs & Híbridos</a></li>
          <li><a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">Sedanes de Lujo</a></li>
          <li><a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">SUVs Familiares</a></li>
        </ul>
      </div>
    </div>

    <div class="border-t border-slate-100 py-8 text-center text-slate-400 text-xs">
      © {{ new Date().getFullYear() }} Importadora Cartes. Todos los derechos reservados.
    </div>
  </footer>
</template>
