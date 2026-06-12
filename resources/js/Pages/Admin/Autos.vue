<template>
  <Head title="Autos" />

  <AdminLayout>
    <div class="space-y-8">
      <div v-if="$page.props.flash?.message" class="rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
        {{ $page.props.flash.message }}
      </div>

      <div v-if="$page.props.errors?.general" class="rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-sm font-bold text-red-700">
        {{ $page.props.errors.general }}
      </div>

      <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-100 bg-gradient-to-r from-white via-yellow-50/60 to-slate-50 p-7 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-[11px] font-black uppercase tracking-widest text-[#e2b808]">Administracion</p>
            <h3 class="text-2xl font-black tracking-tight text-slate-950">Vehiculos cargados</h3>
            <p class="mt-1 text-sm text-slate-500">Administra el catalogo, edita fichas o crea un nuevo vehiculo.</p>
          </div>

          <button
            type="button"
            @click="openCreate"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 py-4 text-sm font-black text-white shadow-lg shadow-slate-950/15 hover:bg-slate-800"
          >
            <span class="material-symbols-outlined text-lg">add</span>
            Crear vehiculo
          </button>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full border-collapse text-left">
            <thead>
              <tr class="bg-slate-50/50">
                <th class="px-7 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Vehiculo</th>
                <th class="px-7 py-4 text-center text-[11px] font-bold uppercase tracking-widest text-slate-400">Ficha</th>
                <th class="px-7 py-4 text-right text-[11px] font-bold uppercase tracking-widest text-slate-400">Precio</th>
                <th class="px-7 py-4 text-center text-[11px] font-bold uppercase tracking-widest text-slate-400">Estado</th>
                <th class="px-7 py-4 text-right text-[11px] font-bold uppercase tracking-widest text-slate-400">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="auto in autos.data" :key="auto.id" class="align-top transition-colors hover:bg-slate-50">
                <td class="px-7 py-5">
                  <div class="flex min-w-[260px] items-start gap-4">
                    <img class="h-14 w-20 rounded-xl bg-slate-100 object-cover" :src="auto.imagen || '/img/home-auto.avif'" :alt="auto.modelo">
                    <div>
                      <span class="block text-base font-black text-slate-950">{{ auto.marca }} {{ auto.modelo }}</span>
                      <span class="block text-xs text-slate-400">{{ auto.version || auto.descripcion_breve || 'Sin detalle' }}</span>
                      <span class="mt-2 inline-flex items-center gap-1 text-[11px] font-bold text-slate-500">
                        <span class="material-symbols-outlined text-sm">calendar_month</span>
                        {{ auto.anio }} - {{ numero(auto.kilometraje) }} km
                      </span>
                    </div>
                  </div>
                </td>
                <td class="px-7 py-5 text-center text-sm text-slate-600">
                  <div class="inline-flex flex-col gap-1">
                    <span :class="auto.publicado ? 'badge-on' : 'badge-off'">{{ auto.publicado ? 'Publicado' : 'Oculto' }}</span>
                    <span :class="auto.destacado ? 'badge-on' : 'badge-off'">{{ auto.destacado ? 'Destacado' : 'Normal' }}</span>
                  </div>
                </td>
                <td class="px-7 py-5 text-right text-base font-black text-slate-950">{{ precio(auto.precio) }}</td>
                <td class="px-7 py-5 text-center">
                  <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[10px] font-bold uppercase text-slate-600">
                    {{ auto.estado }}
                  </span>
                </td>
                <td class="px-7 py-5">
                  <div class="flex justify-end gap-2">
                    <Link :href="`/autos/${auto.id}`" class="icon-button text-slate-600 hover:text-slate-950" title="Ver publico">
                      <span class="material-symbols-outlined text-lg">visibility</span>
                    </Link>
                    <button type="button" @click="startEdit(auto)" class="icon-button text-blue-600 hover:text-blue-700" title="Editar">
                      <span class="material-symbols-outlined text-lg">edit</span>
                    </button>
                    <button type="button" @click="destroy(auto.id)" class="icon-button text-red-600 hover:text-red-700" title="Eliminar">
                      <span class="material-symbols-outlined text-lg">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="!autos.data.length">
                <td colspan="5" class="px-7 py-10 text-center text-sm text-slate-500">Aun no hay vehiculos cargados.</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-if="autos.links?.length > 3" class="flex flex-wrap gap-2 border-t border-slate-100 px-7 py-5">
          <Link
            v-for="link in autos.links"
            :key="link.label"
            :href="link.url || '#'"
            preserve-scroll
            :class="[
              'min-w-10 rounded-xl border px-3 py-2 text-center text-sm font-bold',
              link.active ? 'border-slate-950 bg-slate-950 text-white' : 'border-slate-200 text-slate-600 hover:bg-slate-50',
              !link.url ? 'pointer-events-none opacity-40' : ''
            ]"
            v-html="link.label"
          />
        </div>
      </div>

      <div v-if="showForm" class="fixed inset-0 z-50 flex justify-end bg-slate-950/55 backdrop-blur-sm">
        <button type="button" class="absolute inset-0 cursor-default" aria-label="Cerrar formulario" @click="closeForm"></button>

        <form @submit.prevent="submit" class="relative h-full w-full max-w-4xl overflow-y-auto bg-white shadow-2xl">
          <div class="sticky top-0 z-10 border-b border-slate-100 bg-white/95 px-6 py-5 backdrop-blur">
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-[11px] font-black uppercase tracking-widest text-[#e2b808]">
                  {{ editingId ? 'Editar ficha' : 'Nuevo registro' }}
                </p>
                <h3 class="text-2xl font-black text-slate-950">
                  {{ editingId ? `${form.marca} ${form.modelo}` : 'Crear vehiculo' }}
                </h3>
                <p class="mt-1 text-sm text-slate-500">Datos que se mostraran en catalogo y detalle publico.</p>
              </div>

              <button type="button" @click="closeForm" class="icon-button text-slate-500 hover:text-slate-950" title="Cerrar">
                <span class="material-symbols-outlined text-lg">close</span>
              </button>
            </div>
          </div>

          <div class="space-y-6 p-6">
            <section class="form-section">
              <h4 class="section-title">Identificacion</h4>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Marca" error-key="marca"><input v-model="form.marca" class="input" placeholder="Kia"></Field>
                <Field label="Modelo" error-key="modelo"><input v-model="form.modelo" class="input" placeholder="Sportage"></Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Version" error-key="version"><input v-model="form.version" class="input" placeholder="SUV"></Field>
                <Field label="Tag" error-key="tag">
                  <select v-model="form.tag" class="input">
                    <option value="">Sin tag</option>
                    <option v-for="tag in tagOptions" :key="tag" :value="tag">
                      {{ tag }}
                    </option>
                  </select>
                </Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Año" error-key="anio"><input v-model="form.anio" type="number" class="input"></Field>
                <Field label="Color" error-key="color">
                  <input v-model="form.color" list="colores-auto" class="input" placeholder="Negro">
                  <datalist id="colores-auto">
                    <option v-for="color in colorOptions" :key="color" :value="color" />
                  </datalist>
                </Field>
              </div>
            </section>

            <section class="form-section">
              <h4 class="section-title">Venta y estado</h4>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Precio" error-key="precio"><input v-model="form.precio" type="number" min="0" class="input"></Field>
                <Field label="Kilometraje" error-key="kilometraje"><input v-model="form.kilometraje" type="number" min="0" class="input"></Field>
              </div>
              <Field label="Estado" error-key="estado">
                <select v-model="form.estado" class="input">
                  <option value="disponible">Disponible</option>
                  <option value="transito">En transito</option>
                  <option value="reservado">Reservado</option>
                  <option value="vendido">Vendido</option>
                </select>
              </Field>
              <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <label class="toggle">
                  <input v-model="form.publicado" type="checkbox" class="checkbox">
                  <span>Publicado</span>
                </label>
                <label class="toggle">
                  <input v-model="form.destacado" type="checkbox" class="checkbox">
                  <span>Destacado</span>
                </label>
              </div>
            </section>

            <section class="form-section">
              <h4 class="section-title">Mecanica</h4>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Motor" error-key="motor"><input v-model="form.motor" class="input" placeholder="2.0L"></Field>
                <Field label="Transmision" error-key="transmision">
                  <select v-model="form.transmision" class="input">
                    <option value="">Seleccionar transmision</option>
                    <option v-for="transmision in transmisionOptions" :key="transmision" :value="transmision">
                      {{ transmision }}
                    </option>
                  </select>
                </Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Combustible" error-key="combustible">
                  <select v-model="form.combustible" class="input">
                    <option value="">Seleccionar combustible</option>
                    <option v-for="combustible in combustibleOptions" :key="combustible" :value="combustible">
                      {{ combustible }}
                    </option>
                  </select>
                </Field>
                <Field label="Traccion" error-key="traccion">
                  <select v-model="form.traccion" class="input">
                    <option value="">Seleccionar traccion</option>
                    <option v-for="traccion in traccionOptions" :key="traccion" :value="traccion">
                      {{ traccion }}
                    </option>
                  </select>
                </Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Puertas" error-key="puertas">
                  <select v-model="form.puertas" class="input">
                    <option value="">Seleccionar puertas</option>
                    <option v-for="puertas in puertasOptions" :key="puertas" :value="puertas">
                      {{ puertas }} puertas
                    </option>
                  </select>
                </Field>
                <Field label="Cilindros" error-key="cilindros">
                  <select v-model="form.cilindros" class="input">
                    <option value="">Seleccionar cilindros</option>
                    <option v-for="cilindros in cilindrosOptions" :key="cilindros" :value="cilindros">
                      {{ cilindros }} cilindros
                    </option>
                  </select>
                </Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Potencia" error-key="potencia"><input v-model="form.potencia" class="input" placeholder="150"></Field>
                <Field label="Torque" error-key="torque"><input v-model="form.torque" class="input" placeholder="192 Nm"></Field>
              </div>
            </section>

            <section class="form-section">
              <h4 class="section-title">Consumo y dimensiones</h4>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Capacidad tanque" error-key="capacidad_tanque"><input v-model="form.capacidad_tanque" class="input" placeholder="55 L"></Field>
                <Field label="Peso" error-key="peso"><input v-model="form.peso" class="input" placeholder="1500 kg"></Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Consumo ciudad" error-key="consumo_ciudad"><input v-model="form.consumo_ciudad" class="input" placeholder="10 km/l"></Field>
                <Field label="Consumo carretera" error-key="consumo_carretera"><input v-model="form.consumo_carretera" class="input" placeholder="14 km/l"></Field>
              </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Field label="Dimensiones" error-key="dimensiones"><input v-model="form.dimensiones" class="input" placeholder="4480 x 1855 x 1645 mm"></Field>
                <Field label="Capacidad de carga" error-key="capacidad_carga"><input v-model="form.capacidad_carga" class="input" placeholder="500 kg"></Field>
              </div>
            </section>

            <section class="form-section">
              <h4 class="section-title">Publicacion</h4>
              <Field label="Subir imagen" error-key="imagen_archivo">
                <div class="space-y-3">
                  <div class="flex flex-col gap-3 rounded-2xl border border-dashed border-slate-300 bg-white p-4 sm:flex-row sm:items-center">
                    <img class="h-20 w-28 rounded-xl bg-slate-100 object-cover" :src="form.imagen || '/img/home-auto.avif'" alt="Vista previa del vehiculo">
                    <div class="flex-1">
                      <p class="text-sm font-black text-slate-950">Imagen principal del vehiculo</p>
                      <p class="mt-1 text-xs font-semibold text-slate-500">
                        {{ form.imagen_archivo?.name || 'Puedes subir JPG, PNG, WEBP o AVIF hasta 4 MB.' }}
                      </p>
                    </div>
                    <label class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl bg-slate-950 px-4 py-3 text-xs font-black uppercase tracking-widest text-white hover:bg-slate-800">
                      <span class="material-symbols-outlined text-base">upload</span>
                      Subir
                      <input :key="imageInputKey" type="file" accept="image/jpeg,image/png,image/webp,image/avif" class="hidden" @change="selectImage">
                    </label>
                  </div>
                  <input v-model="form.imagen" class="input" placeholder="/img/home-auto.avif">
                  <p class="text-xs font-semibold text-slate-400">Tambien puedes pegar una ruta o URL si ya tienes la imagen publicada.</p>
                </div>
              </Field>
              <Field label="Descripcion breve" error-key="descripcion_breve"><input v-model="form.descripcion_breve" class="input" maxlength="180"></Field>
              <Field label="Descripcion completa" error-key="descripcion"><textarea v-model="form.descripcion" rows="4" class="input resize-none"></textarea></Field>
              <Field label="Detalles del vehiculo" error-key="detalles"><textarea v-model="form.detalles" rows="6" class="input resize-none" placeholder="Equipamiento, accesorios, mantenciones, condiciones especiales o cualquier detalle importante para el cliente."></textarea></Field>
              <Field label="Seguridad" error-key="seguridad"><textarea v-model="form.seguridad" rows="3" class="input resize-none"></textarea></Field>
              <Field label="Tecnologia" error-key="tecnologia"><textarea v-model="form.tecnologia" rows="3" class="input resize-none"></textarea></Field>
            </section>
          </div>

          <div class="sticky bottom-0 flex flex-col-reverse gap-3 border-t border-slate-100 bg-white/95 px-6 py-5 backdrop-blur sm:flex-row sm:justify-end">
            <button type="button" @click="closeForm" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-black text-slate-600 hover:bg-slate-50">
              Cancelar
            </button>
            <button type="submit" :disabled="form.processing" class="rounded-xl bg-[#e2b808] px-6 py-3 text-sm font-black text-slate-950 hover:bg-yellow-400 disabled:opacity-50">
              {{ form.processing ? 'Guardando...' : editingId ? 'Actualizar vehiculo' : 'Guardar vehiculo' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import Field from './Partials/Field.vue';

defineProps({
  autos: { type: Object, required: true },
  stats: { type: Object, required: true },
});

usePage().props.title = 'Autos';

const editingId = ref(null);
const showForm = ref(false);
const imageInputKey = ref(0);

const colorOptions = ['Blanco', 'Negro', 'Gris', 'Plata', 'Rojo', 'Azul', 'Verde', 'Cafe', 'Dorado', 'Beige'];
const tagOptions = ['Disponible', 'Nuevo ingreso', 'Oferta', 'Destacado', 'Economico', 'SUV', 'Sedan', 'Hatchback', 'Familiar', 'Bajo kilometraje', '4x4', 'En transito', 'Reservado', 'Vendido'];
const transmisionOptions = ['Automatica', 'Mecanica', 'Manual', 'Secuencial', 'CVT', 'Tiptronic'];
const combustibleOptions = ['Bencina', 'Diesel', 'Hibrido', 'Electrico', 'GLP'];
const traccionOptions = ['4x2', '4x4', 'AWD', 'FWD', 'RWD'];
const puertasOptions = [2, 3, 4, 5];
const cilindrosOptions = [3, 4, 5, 6, 8, 10, 12];

const emptyForm = () => ({
  marca: '',
  modelo: '',
  version: '',
  anio: new Date().getFullYear(),
  color: '',
  kilometraje: 0,
  precio: 0,
  motor: '',
  transmision: '',
  combustible: '',
  imagen: '/img/home-auto.avif',
  imagen_archivo: null,
  tag: '',
  estado: 'disponible',
  publicado: true,
  destacado: false,
  descripcion: '',
  detalles: '',
  descripcion_breve: '',
  puertas: '',
  cilindros: '',
  potencia: '',
  torque: '',
  traccion: '',
  capacidad_tanque: '',
  consumo_ciudad: '',
  consumo_carretera: '',
  dimensiones: '',
  peso: '',
  capacidad_carga: '',
  seguridad: '',
  tecnologia: '',
});

const form = useForm(emptyForm());

const assignForm = (values) => {
  Object.entries(emptyForm()).forEach(([key, fallback]) => {
    form[key] = values[key] ?? fallback;
  });
};

const openCreate = () => {
  editingId.value = null;
  form.clearErrors();
  assignForm(emptyForm());
  imageInputKey.value += 1;
  showForm.value = true;
};

const startEdit = (auto) => {
  editingId.value = auto.id;
  assignForm(auto);
  form.imagen_archivo = null;
  form.clearErrors();
  imageInputKey.value += 1;
  showForm.value = true;
};

const closeForm = () => {
  showForm.value = false;
  form.clearErrors();
};

const resetForm = () => {
  editingId.value = null;
  form.clearErrors();
  assignForm(emptyForm());
  imageInputKey.value += 1;
  showForm.value = false;
};

const submit = () => {
  const options = {
    preserveScroll: true,
    forceFormData: true,
    onSuccess: () => resetForm(),
  };

  if (editingId.value) {
    form.post(`/admin/autos/${editingId.value}`, options);
    return;
  }

  form.post('/admin/autos', options);
};

const selectImage = (event) => {
  form.imagen_archivo = event.target.files?.[0] || null;
};

const destroy = (id) => {
  if (confirm('Eliminar este vehiculo del catalogo?')) {
    router.delete(`/admin/autos/${id}`, {
      preserveScroll: true,
      onSuccess: () => {
        if (editingId.value === id) {
          resetForm();
        }
      },
    });
  }
};

const precio = (valor) => new Intl.NumberFormat('es-CL', {
  style: 'currency',
  currency: 'CLP',
  maximumFractionDigits: 0,
}).format(valor || 0);

const numero = (valor) => new Intl.NumberFormat('es-CL').format(valor || 0);
</script>

<style scoped>
.input {
  @apply w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-950 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500;
}

.section-title {
  @apply text-[11px] font-black uppercase tracking-widest text-slate-400;
}

.form-section {
  @apply space-y-4 rounded-2xl border border-slate-100 bg-slate-50/60 p-5;
}

.toggle {
  @apply flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700;
}

.checkbox {
  @apply rounded border-slate-300 text-yellow-500 focus:ring-yellow-500;
}

.icon-button {
  @apply inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white hover:bg-slate-50;
}

.badge-on {
  @apply rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-[10px] font-black uppercase text-emerald-700;
}

.badge-off {
  @apply rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[10px] font-black uppercase text-slate-500;
}
</style>
