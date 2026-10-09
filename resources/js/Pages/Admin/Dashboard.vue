<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Briefcase, FolderGit2, Users, Layers, MessageSquare, ArrowRight, ExternalLink, Plus } from '@lucide/vue';

const props = defineProps({
  stats: {
    type: Object,
    required: true
  },
  recent_portfolios: {
    type: Array,
    default: () => []
  },
  recent_leads: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <Head title="Admin Dashboard - Solkit Tech" />

  <AdminLayout>
    <div class="space-y-8">
      <!-- Title Page -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-3xl font-extrabold tracking-tight text-white">Dashboard Overview</h2>
          <p class="text-sm text-slate-400 mt-1">Solkit Tech CMS & Digital Agency Management System.</p>
        </div>
        <div class="flex items-center gap-3">
          <Link
            :href="route('admin.portfolios.create')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all duration-200"
          >
            <Plus class="w-4 h-4" />
            Tambah Portofolio
          </Link>
          <a
            href="/"
            target="_blank"
            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 transition-colors"
          >
            <ExternalLink class="w-4 h-4" />
            Lihat Website
          </a>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Portfolios -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 relative overflow-hidden shadow-xl shadow-slate-950/20 group">
          <div class="absolute -right-4 -bottom-4 opacity-5 text-indigo-400 group-hover:scale-110 transition-transform duration-300">
            <FolderGit2 class="w-32 h-32" />
          </div>
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Portofolio & Studi Kasus</span>
              <h3 class="text-3xl font-black text-white">{{ stats.portfolios_count || 0 }}</h3>
            </div>
            <div class="p-3 bg-indigo-500/10 text-indigo-400 rounded-xl border border-indigo-500/20">
              <FolderGit2 class="w-6 h-6" />
            </div>
          </div>
        </div>

        <!-- Services -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 relative overflow-hidden shadow-xl shadow-slate-950/20 group">
          <div class="absolute -right-4 -bottom-4 opacity-5 text-cyan-400 group-hover:scale-110 transition-transform duration-300">
            <Briefcase class="w-32 h-32" />
          </div>
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Layanan Digital</span>
              <h3 class="text-3xl font-black text-white">{{ stats.services_count || 0 }}</h3>
            </div>
            <div class="p-3 bg-cyan-500/10 text-cyan-400 rounded-xl border border-cyan-500/20">
              <Briefcase class="w-6 h-6" />
            </div>
          </div>
        </div>

        <!-- Consultation Leads -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 relative overflow-hidden shadow-xl shadow-slate-950/20 group">
          <div class="absolute -right-4 -bottom-4 opacity-5 text-emerald-400 group-hover:scale-110 transition-transform duration-300">
            <MessageSquare class="w-32 h-32" />
          </div>
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Inquiries / Leads Klien</span>
              <h3 class="text-3xl font-black text-white">{{ stats.leads_count || 0 }}</h3>
            </div>
            <div class="p-3 bg-emerald-500/10 text-emerald-400 rounded-xl border border-emerald-500/20">
              <MessageSquare class="w-6 h-6" />
            </div>
          </div>
        </div>

        <!-- CMS Pages -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 relative overflow-hidden shadow-xl shadow-slate-950/20 group">
          <div class="absolute -right-4 -bottom-4 opacity-5 text-amber-400 group-hover:scale-110 transition-transform duration-300">
            <Layers class="w-32 h-32" />
          </div>
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Halaman & Seksi CMS</span>
              <h3 class="text-3xl font-black text-white">{{ stats.pages_count || 0 }}</h3>
            </div>
            <div class="p-3 bg-amber-500/10 text-amber-400 rounded-xl border border-amber-500/20">
              <Layers class="w-6 h-6" />
            </div>
          </div>
        </div>
      </div>

      <!-- Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Portfolios -->
        <div class="bg-slate-950 border border-slate-800 rounded-2xl p-6 shadow-xl shadow-slate-950/20 space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
              <FolderGit2 class="w-5 h-5 text-indigo-400" />
              Studi Kasus Portofolio Terbaru
            </h3>
            <Link
              :href="route('admin.portfolios.index')"
              class="text-xs font-bold text-indigo-400 hover:text-indigo-300 flex items-center gap-1"
            >
              Lihat Semua
              <ArrowRight class="w-3.5 h-3.5" />
            </Link>
          </div>

          <div class="divide-y divide-slate-800/60">
            <div
              v-for="port in recent_portfolios"
              :key="port.id"
              class="py-3 flex items-center justify-between gap-4"
            >
              <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-white truncate">{{ port.title }}</p>
                <p class="text-xs text-indigo-400 font-medium">{{ port.client_name || 'Studio Client' }} · <span class="text-emerald-400">{{ port.impact_metric }}</span></p>
              </div>
              <Link
                :href="route('admin.portfolios.edit', port.id)"
                class="px-3 py-1 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-lg text-xs font-medium text-slate-300 shrink-0"
              >
                Edit
              </Link>
            </div>
            <div v-if="recent_portfolios.length === 0" class="py-6 text-center text-xs text-slate-500">
              Belum ada data portofolio.
            </div>
          </div>
        </div>

        <!-- Recent Inquiries / Leads -->
        <div class="bg-slate-950 border border-slate-800 rounded-2xl p-6 shadow-xl shadow-slate-950/20 space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
              <MessageSquare class="w-5 h-5 text-emerald-400" />
              Inquiry / Konsultasi Masuk
            </h3>
            <span class="text-xs font-semibold text-slate-500">Real-time Lead Capture</span>
          </div>

          <div class="divide-y divide-slate-800/60">
            <div
              v-for="lead in recent_leads"
              :key="lead.id"
              class="py-3 space-y-1"
            >
              <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-white">{{ lead.name }}</span>
                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                  {{ lead.service_interest || 'Konsultasi' }}
                </span>
              </div>
              <p class="text-xs text-slate-400 font-mono">{{ lead.email }} · {{ lead.phone || '-' }}</p>
              <p class="text-xs text-slate-300 line-clamp-2 italic bg-slate-900/60 p-2 rounded-lg mt-1 border border-slate-850">
                "{{ lead.message }}"
              </p>
            </div>
            <div v-if="recent_leads.length === 0" class="py-6 text-center text-xs text-slate-500">
              Belum ada pesan inquiry baru. Calon klien yang mengisi form konsultasi di landing page akan muncul di sini.
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
