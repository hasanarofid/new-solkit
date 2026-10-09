<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Plus, Edit3, Trash2, CheckCircle2, XCircle, Briefcase } from '@lucide/vue';

const props = defineProps({
  services: {
    type: Object,
    required: true
  }
});

const deleteService = (id, title) => {
  if (confirm(`Apakah Anda yakin ingin menghapus layanan "${title}"?`)) {
    router.delete(route('admin.services.destroy', id), {
      preserveScroll: true
    });
  }
};
</script>

<template>
  <Head title="Manajemen Layanan" />

  <AdminLayout>
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2.5">
            <Briefcase class="w-6 h-6 text-indigo-400" />
            Layanan Software House
          </h2>
          <p class="text-sm text-slate-400 mt-1">
            Kelola katalog layanan digital, deliverables, dan teknologi yang ditawarkan ke klien.
          </p>
        </div>
        <Link
          :href="route('admin.services.create')"
          class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all duration-200"
        >
          <Plus class="w-4 h-4" />
          Tambah Layanan Baru
        </Link>
      </div>

      <!-- Services Table -->
      <div class="bg-slate-950 border border-slate-800/80 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-900/80 text-xs uppercase font-semibold text-slate-400 border-b border-slate-800">
              <tr>
                <th class="px-6 py-4">Urutan</th>
                <th class="px-6 py-4">Nama Layanan</th>
                <th class="px-6 py-4">Tagline / Deskripsi</th>
                <th class="px-6 py-4">Tech Stack</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
              <tr v-for="service in services.data" :key="service.id" class="hover:bg-slate-900/40 transition-colors">
                <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ service.order }}</td>
                <td class="px-6 py-4">
                  <div class="font-bold text-white">{{ service.title }}</div>
                  <div class="text-xs text-slate-500 font-mono">{{ service.slug }}</div>
                </td>
                <td class="px-6 py-4 max-w-xs">
                  <div class="text-xs font-medium text-indigo-300 truncate">{{ service.tagline || '-' }}</div>
                  <div class="text-xs text-slate-400 truncate mt-0.5">{{ service.description }}</div>
                </td>
                <td class="px-6 py-4">
                  <div class="flex flex-wrap gap-1 max-w-xs">
                    <span 
                      v-for="(tech, idx) in (service.tech_stack || []).slice(0, 3)" 
                      :key="idx"
                      class="px-2 py-0.5 bg-slate-800/80 text-slate-300 rounded text-[11px] font-mono border border-slate-700/60"
                    >
                      {{ tech }}
                    </span>
                    <span v-if="(service.tech_stack || []).length > 3" class="text-slate-500 text-[10px] self-center">
                      +{{ service.tech_stack.length - 3 }}
                    </span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span 
                    :class="[
                      service.is_active ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-slate-800 text-slate-500 border-slate-700',
                      'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border'
                    ]"
                  >
                    <component :is="service.is_active ? CheckCircle2 : XCircle" class="w-3.5 h-3.5" />
                    {{ service.is_active ? 'Aktif' : 'Non-aktif' }}
                  </span>
                </td>
                <td class="px-6 py-4 text-right">
                  <div class="flex items-center justify-end gap-2">
                    <Link
                      :href="route('admin.services.edit', service.id)"
                      class="p-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-indigo-400 transition-colors"
                      title="Edit Layanan"
                    >
                      <Edit3 class="w-4 h-4" />
                    </Link>
                    <button
                      @click="deleteService(service.id, service.title)"
                      class="p-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-rose-400 transition-colors"
                      title="Hapus Layanan"
                    >
                      <Trash2 class="w-4 h-4" />
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="services.data.length === 0">
                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                  Belum ada data layanan software house. Klik tombol "Tambah Layanan Baru" di atas.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
