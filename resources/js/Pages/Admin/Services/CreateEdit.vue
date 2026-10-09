<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ArrowLeft, Save, Plus, Trash2 } from '@lucide/vue';

const props = defineProps({
  service: {
    type: Object,
    default: null
  },
  isEdit: {
    type: Boolean,
    default: false
  }
});

const form = useForm({
  title: props.service?.title || '',
  slug: props.service?.slug || '',
  tagline: props.service?.tagline || '',
  description: props.service?.description || '',
  icon: props.service?.icon || 'Layout',
  features: props.service?.features || [''],
  tech_stack: props.service?.tech_stack || [''],
  order: props.service?.order ?? 0,
  is_active: props.service?.is_active ?? true,
});

const addFeature = () => {
  form.features.push('');
};

const removeFeature = (index) => {
  form.features.splice(index, 1);
};

const addTechStack = () => {
  form.tech_stack.push('');
};

const removeTechStack = (index) => {
  form.tech_stack.splice(index, 1);
};

const submit = () => {
  // Filter empty elements
  form.features = form.features.filter(f => f && f.trim() !== '');
  form.tech_stack = form.tech_stack.filter(t => t && t.trim() !== '');

  if (props.isEdit) {
    form.put(route('admin.services.update', props.service.id));
  } else {
    form.post(route('admin.services.store'));
  }
};
</script>

<template>
  <Head :title="isEdit ? 'Edit Layanan' : 'Tambah Layanan Baru'" />

  <AdminLayout>
    <div class="max-w-4xl space-y-6">
      <!-- Top Bar -->
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
          <Link
            :href="route('admin.services.index')"
            class="p-2 bg-slate-800/80 hover:bg-slate-800 text-slate-400 hover:text-white rounded-xl transition-colors"
          >
            <ArrowLeft class="w-5 h-5" />
          </Link>
          <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-white">
              {{ isEdit ? 'Edit Layanan' : 'Tambah Layanan Baru' }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">Konfigurasikan spesifikasi dan penawaran layanan software house.</p>
          </div>
        </div>
      </div>

      <!-- Form Container -->
      <form @submit.prevent="submit" class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Title -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama Layanan *</label>
            <input
              v-model="form.title"
              type="text"
              placeholder="Contoh: Custom Web & SaaS Development"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
              required
            />
            <span v-if="form.errors.title" class="text-xs text-rose-400">{{ form.errors.title }}</span>
          </div>

          <!-- Slug -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Slug URL (Opsional)</label>
            <input
              v-model="form.slug"
              type="text"
              placeholder="custom-web-saas-development"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            />
            <span v-if="form.errors.slug" class="text-xs text-rose-400">{{ form.errors.slug }}</span>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Tagline -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Tagline Ringkas</label>
            <input
              v-model="form.tagline"
              type="text"
              placeholder="Contoh: High-Performance & Scalable Web"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            />
          </div>

          <!-- Icon Key -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama Icon Lucide</label>
            <input
              v-model="form.icon"
              type="text"
              placeholder="Layout, Smartphone, Cpu, Cloud, Figma"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            />
          </div>
        </div>

        <!-- Description -->
        <div class="space-y-2">
          <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Deskripsi Lengkap *</label>
          <textarea
            v-model="form.description"
            rows="4"
            placeholder="Jelaskan cakupan solusi, manfaat bisnis, dan keunggulan teknis dari layanan ini..."
            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            required
          ></textarea>
          <span v-if="form.errors.description" class="text-xs text-rose-400">{{ form.errors.description }}</span>
        </div>

        <!-- Key Features Deliverables (Dynamic list) -->
        <div class="space-y-3 pt-2">
          <div class="flex items-center justify-between">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Fitur Deliverables Utama</label>
            <button
              type="button"
              @click="addFeature"
              class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-400 hover:text-indigo-300"
            >
              <Plus class="w-3.5 h-3.5" />
              Tambah Fitur
            </button>
          </div>

          <div v-for="(feat, idx) in form.features" :key="idx" class="flex items-center gap-2">
            <input
              v-model="form.features[idx]"
              type="text"
              placeholder="Contoh: Arsitektur Multi-Tenant & Scalable Microservices"
              class="flex-1 bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
            />
            <button
              type="button"
              @click="removeFeature(idx)"
              class="p-2 text-slate-500 hover:text-rose-400 hover:bg-slate-900 rounded-lg transition-colors"
            >
              <Trash2 class="w-4 h-4" />
            </button>
          </div>
        </div>

        <!-- Tech Stack Tags (Dynamic list) -->
        <div class="space-y-3 pt-2">
          <div class="flex items-center justify-between">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Teknologi Terkait (Tech Stack)</label>
            <button
              type="button"
              @click="addTechStack"
              class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-400 hover:text-indigo-300"
            >
              <Plus class="w-3.5 h-3.5" />
              Tambah Teknologi
            </button>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div v-for="(tech, idx) in form.tech_stack" :key="idx" class="flex items-center gap-2">
              <input
                v-model="form.tech_stack[idx]"
                type="text"
                placeholder="Laravel, Vue, AWS, Docker..."
                class="flex-1 bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
              />
              <button
                type="button"
                @click="removeTechStack(idx)"
                class="p-2 text-slate-500 hover:text-rose-400 hover:bg-slate-900 rounded-lg transition-colors"
              >
                <Trash2 class="w-4 h-4" />
              </button>
            </div>
          </div>
        </div>

        <!-- Order & Status -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-slate-850">
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Urutan Tampilan</label>
            <input
              v-model="form.order"
              type="number"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
            />
          </div>

          <div class="flex items-center sm:pt-6">
            <label class="flex items-center gap-3 cursor-pointer">
              <input
                v-model="form.is_active"
                type="checkbox"
                class="w-5 h-5 rounded bg-slate-900 border-slate-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-950"
              />
              <span class="text-sm font-semibold text-slate-200">Aktifkan Layanan di Halaman Utama</span>
            </label>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
          <button
            type="submit"
            :disabled="form.processing"
            class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-indigo-600/30 transition-all duration-200 disabled:opacity-50"
          >
            <Save class="w-4 h-4" />
            {{ isEdit ? 'Simpan Perubahan' : 'Buat Layanan' }}
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
