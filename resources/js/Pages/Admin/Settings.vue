<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Save, Image as ImageIcon, Link as LinkIcon, Phone, FileText, Globe, Palette, Mail, MapPin } from '@lucide/vue';

const props = defineProps({
  settings: {
    type: Object,
    required: true
  }
});

const currentTab = ref('site'); // 'site', 'theme', 'links', 'logo'

const form = useForm({
  site_name: props.settings.site_name || '',
  site_tagline: props.settings.site_tagline || '',
  site_description: props.settings.site_description || '',
  primary_color: props.settings.primary_color || '#4f46e5',
  whatsapp_number: props.settings.whatsapp_number || '',
  contact_email: props.settings.contact_email || '',
  company_address: props.settings.company_address || '',
  site_logo: null
});

const logoPreview = ref(props.settings.site_logo_url || null);
const isDragging = ref(false);

const presetColors = [
  { name: 'Modern Indigo', hex: '#4f46e5' },
  { name: 'Electric Cyan', hex: '#06b6d4' },
  { name: 'Emerald Tech', hex: '#10b981' },
  { name: 'Royal Violet', hex: '#8b5cf6' },
  { name: 'Sunset Amber', hex: '#f59e0b' },
  { name: 'Cyber Rose', hex: '#f43f5e' },
];

const handleLogoChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.site_logo = file;
    logoPreview.value = URL.createObjectURL(file);
  }
};

const handleDrop = (e) => {
  isDragging.value = false;
  const file = e.dataTransfer.files[0];
  if (file && file.type.startsWith('image/')) {
    form.site_logo = file;
    logoPreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  form.post(route('admin.settings.update'), {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      form.site_logo = null;
    }
  });
};
</script>

<template>
  <Head title="Web Settings & Theming" />

  <AdminLayout>
    <div class="space-y-8 max-w-4xl">
      <!-- Title -->
      <div>
        <h2 class="text-3xl font-extrabold tracking-tight text-white flex items-center gap-3">
          <Globe class="w-8 h-8 text-indigo-400" />
          Web Settings & Theming
        </h2>
        <p class="text-sm text-slate-400 mt-1">
          Kelola profil identitas korporat, logo, warna tema utama (CSS Variables), dan saluran kontak WhatsApp.
        </p>
      </div>

      <!-- Navigation Tabs (SaaS Style) -->
      <div class="flex border-b border-slate-800 overflow-x-auto">
        <button 
          type="button"
          @click="currentTab = 'site'"
          :class="[
            currentTab === 'site' 
              ? 'border-indigo-500 text-indigo-400 bg-slate-900/40' 
              : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700',
            'px-6 py-3 border-b-2 font-semibold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer whitespace-nowrap'
          ]"
        >
          <span class="flex items-center gap-2">
            <Globe class="w-4 h-4" />
            Profil Situs
          </span>
        </button>

        <button 
          type="button"
          @click="currentTab = 'theme'"
          :class="[
            currentTab === 'theme' 
              ? 'border-indigo-500 text-indigo-400 bg-slate-900/40' 
              : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700',
            'px-6 py-3 border-b-2 font-semibold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer whitespace-nowrap'
          ]"
        >
          <span class="flex items-center gap-2">
            <Palette class="w-4 h-4" />
            Warna & Tema (CSS Vars)
          </span>
        </button>

        <button 
          type="button"
          @click="currentTab = 'links'"
          :class="[
            currentTab === 'links' 
              ? 'border-indigo-500 text-indigo-400 bg-slate-900/40' 
              : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700',
            'px-6 py-3 border-b-2 font-semibold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer whitespace-nowrap'
          ]"
        >
          <span class="flex items-center gap-2">
            <Phone class="w-4 h-4" />
            Kontak & Alamat
          </span>
        </button>

        <button 
          type="button"
          @click="currentTab = 'logo'"
          :class="[
            currentTab === 'logo' 
              ? 'border-indigo-500 text-indigo-400 bg-slate-900/40' 
              : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700',
            'px-6 py-3 border-b-2 font-semibold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer whitespace-nowrap'
          ]"
        >
          <span class="flex items-center gap-2">
            <ImageIcon class="w-4 h-4" />
            Logo Website
          </span>
        </button>
      </div>

      <!-- Settings Card -->
      <form @submit.prevent="submit" class="bg-slate-950 border border-slate-800 rounded-2xl overflow-hidden shadow-xl shadow-slate-950/20">
        <div class="p-6 md:p-8">
          
          <!-- Tab 1: Profil Situs -->
          <div v-if="currentTab === 'site'" class="space-y-6">
            <!-- Site Name -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
              <label for="site_name" class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Brand / Website</label>
              <div class="md:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                  <FileText class="w-4 h-4" />
                </span>
                <input 
                  id="site_name"
                  v-model="form.site_name"
                  type="text" 
                  class="w-full bg-slate-900 border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                  placeholder="Contoh: Solkit Tech"
                  required
                />
              </div>
            </div>

            <!-- Site Tagline -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
              <label for="site_tagline" class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tagline Perusahaan</label>
              <div class="md:col-span-2">
                <input 
                  id="site_tagline"
                  v-model="form.site_tagline"
                  type="text" 
                  class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                  placeholder="Enterprise Digital Engineering & Modern Software House"
                />
              </div>
            </div>

            <!-- Site Description -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
              <div>
                <label for="site_description" class="text-xs font-bold text-slate-400 uppercase tracking-wider">Deskripsi Perusahaan</label>
                <p class="text-xxs text-slate-500 mt-1">Digunakan untuk SEO Meta Description dan profil ringkas software house.</p>
              </div>
              <div class="md:col-span-2">
                <textarea 
                  id="site_description"
                  v-model="form.site_description"
                  rows="4"
                  class="w-full bg-slate-900 border border-slate-800 rounded-xl p-4 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                  placeholder="Solkit Tech adalah mitra rekayasa perangkat lunak..."
                ></textarea>
              </div>
            </div>
          </div>

          <!-- Tab 2: Warna & Tema (CSS Variables) -->
          <div v-if="currentTab === 'theme'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
              <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Primary Color Website</label>
                <p class="text-xxs text-slate-500 mt-1">Mengubah warna aksen tombol, glow effects, badge, dan gradients landing page secara instan via CSS variable <code class="text-indigo-400">--primary-color</code>.</p>
              </div>
              <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-4">
                  <input
                    type="color"
                    v-model="form.primary_color"
                    class="w-14 h-14 rounded-xl border border-slate-800 cursor-pointer bg-slate-900 p-1"
                  />
                  <div>
                    <input
                      type="text"
                      v-model="form.primary_color"
                      class="bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-sm font-mono text-white focus:outline-none focus:border-indigo-500 w-36"
                    />
                    <p class="text-xxs text-slate-500 mt-1">Hex Code (misal: #4f46e5)</p>
                  </div>
                </div>

                <!-- Presets -->
                <div>
                  <span class="text-xs font-semibold text-slate-400 block mb-2">Preset Palet Pilihan:</span>
                  <div class="flex flex-wrap gap-2">
                    <button
                      v-for="color in presetColors"
                      :key="color.hex"
                      type="button"
                      @click="form.primary_color = color.hex"
                      class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 hover:border-slate-700 text-xs text-slate-300 transition-all cursor-pointer"
                    >
                      <span class="w-3.5 h-3.5 rounded-full" :style="{ backgroundColor: color.hex }"></span>
                      {{ color.name }}
                    </button>
                  </div>
                </div>

                <!-- Live Preview Badge -->
                <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between">
                  <span class="text-xs text-slate-400">Live Preview Aksen Tombol:</span>
                  <button
                    type="button"
                    :style="{ backgroundColor: form.primary_color }"
                    class="px-4 py-2 text-xs font-bold text-white rounded-xl shadow-lg transition-transform hover:scale-105"
                  >
                    Contoh Tombol CTA
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Tab 3: Kontak & Alamat -->
          <div v-if="currentTab === 'links'" class="space-y-6">
            <!-- WhatsApp -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
              <div>
                <label for="whatsapp_number" class="text-xs font-bold text-slate-400 uppercase tracking-wider">WhatsApp Konsultasi</label>
                <p class="text-xxs text-slate-500 mt-1">Gunakan kode negara tanpa tanda plus (+), contoh: 6281234567890</p>
              </div>
              <div class="md:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                  <Phone class="w-4 h-4" />
                </span>
                <input 
                  id="whatsapp_number"
                  v-model="form.whatsapp_number"
                  type="text" 
                  class="w-full bg-slate-900 border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                  placeholder="6281234567890"
                />
              </div>
            </div>

            <!-- Email -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
              <label for="contact_email" class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email Kontak Resmi</label>
              <div class="md:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                  <Mail class="w-4 h-4" />
                </span>
                <input 
                  id="contact_email"
                  v-model="form.contact_email"
                  type="email" 
                  class="w-full bg-slate-900 border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                  placeholder="hello@solkit.tech"
                />
              </div>
            </div>

            <!-- Address -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
              <label for="company_address" class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alamat Kantor Studio</label>
              <div class="md:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                  <MapPin class="w-4 h-4" />
                </span>
                <input 
                  id="company_address"
                  v-model="form.company_address"
                  type="text" 
                  class="w-full bg-slate-900 border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                  placeholder="SCBD Jakarta Selatan, Indonesia"
                />
              </div>
            </div>
          </div>

          <!-- Tab 4: Logo Website -->
          <div v-if="currentTab === 'logo'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
              <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Logo Brand</label>
                <p class="text-xxs text-slate-500 mt-1">Format PNG transparan atau SVG sangat disarankan. Maksimal 2MB.</p>
              </div>
              <div class="md:col-span-2 space-y-4">
                <div 
                  @dragover.prevent="isDragging = true"
                  @dragleave.prevent="isDragging = false"
                  @drop.prevent="handleDrop"
                  :class="[
                    isDragging ? 'border-indigo-500 bg-indigo-500/10' : 'border-slate-800 bg-slate-900/50',
                    'border-2 border-dashed rounded-2xl p-6 text-center cursor-pointer transition-colors relative'
                  ]"
                >
                  <input 
                    type="file" 
                    accept="image/*"
                    @change="handleLogoChange"
                    class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                  />
                  <div class="space-y-2">
                    <div class="mx-auto w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400">
                      <ImageIcon class="w-6 h-6" />
                    </div>
                    <p class="text-xs font-semibold text-slate-300">Klik atau geser file gambar logo ke sini</p>
                    <p class="text-xxs text-slate-500">PNG, SVG, WEBP hingga 2MB</p>
                  </div>
                </div>

                <!-- Preview -->
                <div v-if="logoPreview" class="p-4 bg-slate-900 rounded-xl border border-slate-800 flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <img :src="logoPreview" alt="Logo Preview" class="h-10 object-contain rounded" />
                    <span class="text-xs text-slate-400">Preview Logo Aktif</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Footer Card / Submit Button -->
        <div class="px-6 py-4 bg-slate-900/80 border-t border-slate-800/80 flex items-center justify-end">
          <button 
            type="submit" 
            :disabled="form.processing"
            class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-indigo-600/30 transition-all duration-200 disabled:opacity-50 cursor-pointer"
          >
            <Save class="w-4 h-4" />
            Simpan Konfigurasi
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
