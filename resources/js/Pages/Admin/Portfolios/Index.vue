<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Plus, Edit3, Trash2, FolderGit2, Star, ExternalLink } from '@lucide/vue';

const props = defineProps({
  portfolios: {
    type: Object,
    required: true
  }
});

const deletePortfolio = (id, title) => {
  if (confirm(`Apakah Anda yakin ingin menghapus portofolio "${title}"?`)) {
    router.delete(route('admin.portfolios.destroy', id), {
      preserveScroll: true
    });
  }
};
</script>

<template>
  <Head title="Manajemen Portofolio" />

  <AdminLayout>
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2.5">
            <FolderGit2 class="w-6 h-6 text-indigo-400" />
            Portofolio & Studi Kasus Klien
          </h2>
          <p class="text-sm text-slate-400 mt-1">
            Kelola studi kasus proyek perangkat lunak berbasis dampak (Problem -> Solution -> Impact).
          </p>
        </div>
        <Link
          :href="route('admin.portfolios.create')"
          class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all duration-200"
        >
          <Plus class="w-4 h-4" />
          Tambah Portofolio Baru
        </Link>
      </div>

      <!-- Portfolio Table -->
      <div class="bg-slate-950 border border-slate-800/80 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-900/80 text-xs uppercase font-semibold text-slate-400 border-b border-slate-800">
              <tr>
                <th class="px-6 py-4">Thumbnail</th>
                <th class="px-6 py-4">Judul & Klien</th>
                <th class="px-6 py-4">Metrik Dampak (Impact)</th>
                <th class="px-6 py-4">Tech Stack</th>
                <th class="px-6 py-4">Featured</th>
                <th class="px-6 py-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
              <tr v-for="item in portfolios.data" :key="item.id" class="hover:bg-slate-900/40 transition-colors">
                <td class="px-6 py-4">
                  <div class="w-16 h-12 rounded-lg bg-slate-900 border border-slate-800 overflow-hidden flex items-center justify-center">
                    <img 
                      v-if="item.thumbnail_url" 
                      :src="item.thumbnail_url" 
                      :alt="item.title"
                      class="w-full h-full object-cover"
                    />
                    <FolderGit2 v-else class="w-5 h-5 text-slate-600" />
                  </div>
                </td>
                <td class="px-6 py-4 max-w-xs">
                  <div class="font-bold text-white truncate">{{ item.title }}</div>
                  <div class="text-xs text-indigo-400 font-medium">{{ item.client_name || 'Internal Studio' }} · <span class="text-slate-500">{{ item.industry || 'Tech' }}</span></div>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center px-2.5 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-full text-xs font-semibold">
                    {{ item.impact_metric || 'Successful Launch' }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex flex-wrap gap-1 max-w-xs">
                    <span 
                      v-for="(tech, idx) in (item.tech_stack || []).slice(0, 3)" 
                      :key="idx"
                      class="px-2 py-0.5 bg-slate-800/80 text-slate-300 rounded text-[11px] font-mono border border-slate-700/60"
                    >
                      {{ tech }}
                    </span>
                    <span v-if="(item.tech_stack || []).length > 3" class="text-slate-500 text-[10px] self-center">
                      +{{ item.tech_stack.length - 3 }}
                    </span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span v-if="item.is_featured" class="inline-flex items-center gap-1 text-amber-400 text-xs font-bold">
                    <Star class="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                    Featured
                  </span>
                  <span v-else class="text-xs text-slate-500">-</span>
                </td>
                <td class="px-6 py-4 text-right">
                  <div class="flex items-center justify-end gap-2">
                    <a
                      v-if="item.project_url"
                      :href="item.project_url"
                      target="_blank"
                      class="p-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-slate-200 transition-colors"
                      title="Lihat Link Proyek"
                    >
                      <ExternalLink class="w-4 h-4" />
                    </a>
                    <Link
                      :href="route('admin.portfolios.edit', item.id)"
                      class="p-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-indigo-400 transition-colors"
                      title="Edit Portofolio"
                    >
                      <Edit3 class="w-4 h-4" />
                    </Link>
                    <button
                      @click="deletePortfolio(item.id, item.title)"
                      class="p-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-rose-400 transition-colors"
                      title="Hapus Portofolio"
                    >
                      <Trash2 class="w-4 h-4" />
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="portfolios.data.length === 0">
                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                  Belum ada portofolio software house. Klik tombol "Tambah Portofolio Baru" di atas.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
