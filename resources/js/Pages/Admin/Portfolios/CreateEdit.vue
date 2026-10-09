<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ArrowLeft, Save, Plus, Trash2, Upload, FolderGit2 } from '@lucide/vue';

const props = defineProps({
  portfolio: {
    type: Object,
    default: null
  },
  isEdit: {
    type: Boolean,
    default: false
  }
});

const form = useForm({
  _method: props.isEdit ? 'PUT' : 'POST',
  title: props.portfolio?.title || '',
  slug: props.portfolio?.slug || '',
  client_name: props.portfolio?.client_name || '',
  industry: props.portfolio?.industry || '',
  problem: props.portfolio?.problem || '',
  solution: props.portfolio?.solution || '',
  impact_metric: props.portfolio?.impact_metric || '',
  tech_stack: props.portfolio?.tech_stack || [''],
  thumbnail: null,
  project_url: props.portfolio?.project_url || '',
  is_featured: props.portfolio?.is_featured ?? false,
  is_active: props.portfolio?.is_active ?? true,
  order: props.portfolio?.order ?? 0,
});

const thumbnailPreview = ref(props.portfolio?.thumbnail_url || null);

const handleThumbnailChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.thumbnail = file;
    thumbnailPreview.value = URL.createObjectURL(file);
  }
};

const addTech = () => {
  form.tech_stack.push('');
};

const removeTech = (index) => {
  form.tech_stack.splice(index, 1);
};

const submit = () => {
  form.tech_stack = form.tech_stack.filter(t => t && t.trim() !== '');

  if (props.isEdit) {
    form.post(route('admin.portfolios.update', props.portfolio.id), {
      forceFormData: true,
      preserveScroll: true
    });
  } else {
    form.post(route('admin.portfolios.store'), {
      forceFormData: true,
      preserveScroll: true
    });
  }
};
</script>

<template>
  <Head :title="isEdit ? 'Edit Portofolio' : 'Tambah Portofolio Baru'" />

  <AdminLayout>
    <div class="max-w-4xl space-y-6">
      <!-- Top Bar -->
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
          <Link
            :href="route('admin.portfolios.index')"
            class="p-2 bg-slate-800/80 hover:bg-slate-800 text-slate-400 hover:text-white rounded-xl transition-colors"
          >
            <ArrowLeft class="w-5 h-5" />
          </Link>
          <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-white">
              {{ isEdit ? 'Edit Studi Kasus' : 'Tambah Studi Kasus Portofolio' }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">Dokumentasikan solusi rekayasa software dan dampak bisnis untuk klien.</p>
          </div>
        </div>
      </div>

      <!-- Form Container -->
      <form @submit.prevent="submit" class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 sm:p-8 space-y-6 shadow-xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Title -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Judul Proyek *</label>
            <input
              v-model="form.title"
              type="text"
              placeholder="Contoh: ArthaPay: Enterprise Payment Gateway"
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
              placeholder="arthapay-enterprise-payment-gateway"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            />
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Client Name -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama Klien / Perusahaan</label>
            <input
              v-model="form.client_name"
              type="text"
              placeholder="Contoh: PT Artha Digital Mandiri"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            />
          </div>

          <!-- Industry -->
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Industri / Sektor Bisnis</label>
            <input
              v-model="form.industry"
              type="text"
              placeholder="Fintech, Logistics, Healthcare, E-Commerce"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            />
          </div>
        </div>

        <!-- Problem & Solution (Impact-Driven Case Study Format) -->
        <div class="space-y-6 pt-2">
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-rose-400 uppercase tracking-wider">1. Problem (Tantangan & Masalah Klien)</label>
            <textarea
              v-model="form.problem"
              rows="3"
              placeholder="Jelaskan kendala operasional, bottleneck teknologi, atau masalah lama yang dihadapi klien..."
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
            ></textarea>
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-semibold text-indigo-400 uppercase tracking-wider">2. Solution (Solusi Teknis Solkit Tech)</label>
            <textarea
              v-model="form.solution"
              rows="3"
              placeholder="Jelaskan arsitektur perangkat lunak, sistem, atau metodologi yang dibangun untuk menyelesaikan masalah..."
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
            ></textarea>
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-semibold text-emerald-400 uppercase tracking-wider">3. Business Impact / Metrik Hasil Nyata</label>
            <input
              v-model="form.impact_metric"
              type="text"
              placeholder="Contoh: +400% Kecepatan Transaksi & 99.99% Uptime, Hemat Biaya BBM 22%"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
            />
          </div>
        </div>

        <!-- Thumbnail Upload -->
        <div class="space-y-2 pt-2 border-t border-slate-850">
          <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Thumbnail / Mockup Proyek</label>
          <div class="flex items-center gap-6">
            <div class="w-28 h-20 rounded-xl bg-slate-900 border border-slate-800 overflow-hidden flex items-center justify-center shrink-0">
              <img v-if="thumbnailPreview" :src="thumbnailPreview" class="w-full h-full object-cover" />
              <FolderGit2 v-else class="w-8 h-8 text-slate-600" />
            </div>
            <div class="flex-1">
              <input
                type="file"
                accept="image/*"
                @change="handleThumbnailChange"
                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-white hover:file:bg-slate-700 cursor-pointer"
              />
              <p class="text-xxs text-slate-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
            </div>
          </div>
        </div>

        <!-- Tech Stack Tags -->
        <div class="space-y-3 pt-2">
          <div class="flex items-center justify-between">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Teknologi yang Digunakan</label>
            <button
              type="button"
              @click="addTech"
              class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-400 hover:text-indigo-300"
            >
              <Plus class="w-3.5 h-3.5" />
              Tambah Tag
            </button>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
            <div v-for="(tech, idx) in form.tech_stack" :key="idx" class="flex items-center gap-2">
              <input
                v-model="form.tech_stack[idx]"
                type="text"
                placeholder="Laravel, Vue 3, Flutter..."
                class="flex-1 bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
              />
              <button
                type="button"
                @click="removeTech(idx)"
                class="p-2 text-slate-500 hover:text-rose-400 hover:bg-slate-900 rounded-lg transition-colors"
              >
                <Trash2 class="w-4 h-4" />
              </button>
            </div>
          </div>
        </div>

        <!-- Project URL & Options -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-slate-850">
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">URL Proyek / Live Demo</label>
            <input
              v-model="form.project_url"
              type="url"
              placeholder="https://client-domain.com"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
            />
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Urutan Tampilan</label>
            <input
              v-model="form.order"
              type="number"
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
            />
          </div>
        </div>

        <!-- Toggles -->
        <div class="flex flex-wrap items-center gap-6 pt-2">
          <label class="flex items-center gap-3 cursor-pointer">
            <input
              v-model="form.is_featured"
              type="checkbox"
              class="w-5 h-5 rounded bg-slate-900 border-slate-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-950"
            />
            <span class="text-sm font-semibold text-amber-400">Tampilkan sebagai Featured di Halaman Utama</span>
          </label>

          <label class="flex items-center gap-3 cursor-pointer">
            <input
              v-model="form.is_active"
              type="checkbox"
              class="w-5 h-5 rounded bg-slate-900 border-slate-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-950"
            />
            <span class="text-sm font-semibold text-slate-200">Publikasikan Portofolio</span>
          </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
          <button
            type="submit"
            :disabled="form.processing"
            class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-indigo-600/30 transition-all duration-200 disabled:opacity-50"
          >
            <Save class="w-4 h-4" />
            {{ isEdit ? 'Simpan Perubahan' : 'Buat Portofolio' }}
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
