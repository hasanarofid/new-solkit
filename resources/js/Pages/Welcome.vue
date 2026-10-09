<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { 
  ArrowUpRight, 
  CheckCircle2, 
  ChevronRight,
  ExternalLink,
  Code2,
  Cpu,
  Smartphone,
  Cloud,
  Palette,
  Layout,
  Send,
  X,
  Phone,
  Mail,
  MapPin,
  Sparkles
} from '@lucide/vue';

const props = defineProps({
  settings: {
    type: Object,
    required: true
  },
  navigation: {
    type: Array,
    default: () => []
  },
  page: {
    type: Object,
    default: null
  },
  services: {
    type: Array,
    default: () => []
  },
  portfolios: {
    type: Array,
    default: () => []
  },
  posts: {
    type: Array,
    default: () => []
  }
});

const pageData = usePage();
const user = pageData.props.auth?.user;

// Dynamic Theme Colors
const primaryColor = computed(() => props.settings.primary_color || '#4f46e5');

// Modal State
const isConsultModalOpen = ref(false);

// Helper to find specific section by key
const getSection = (key) => {
  if (!props.page || !props.page.sections) return null;
  return props.page.sections.find(s => s.key === key && s.is_active);
};

const heroSection = computed(() => getSection('hero')?.content || {
  badge: 'Kapasitas Q4: Terbuka untuk 2 Proyek Terpilih',
  headline: 'Rekayasa Perangkat Lunak Presisi untuk Produk Digital yang Siap Berkembang',
  subheadline: 'Kami membantu startup bertumbuh dan korporasi memodernisasi infrastruktur teknologinya melalui arsitektur web tangguh, aplikasi mobile performa tinggi, dan otomatisasi AI.',
  cta_primary: 'Konsultasikan Proyek Anda',
  cta_secondary: 'Eksplorasi Studi Kasus',
  stats: [
    { label: 'Proyek Siap Produksi', value: '45+' },
    { label: 'Rata-rata SLA Uptime', value: '99.98%' },
    { label: 'Transaksi Diproses/Hari', value: '1.2M+' },
    { label: 'Retensi Kemitraan Klien', value: '98%' }
  ]
});

const techSection = computed(() => getSection('tech_stack')?.content || {
  badge: 'TEKNOLOGI & ARSITEKTUR',
  title: 'Fondasi Teknis yang Teruji di Lingkungan Produksi',
  description: 'Kami menghindari tren sesaat dan berfokus pada ekosistem teknologi modern yang terbukti stabil, aman, dan mudah dirawat dalam jangka panjang.',
  stacks: [
    { name: 'Laravel 11', category: 'Backend & Core Engine', desc: 'Arsitektur modular, antrean aman, dan skalabilitas data tinggi' },
    { name: 'Vue 3 & Inertia.js', category: 'Frontend Ecosystem', desc: 'SPA tanpa kompleksitas REST terpisah dengan rendering instan' },
    { name: 'Flutter & Kotlin', category: 'Mobile Engineering', desc: 'Performa native 60fps dengan sinkronisasi offline-first' },
    { name: 'Python & LLM RAG', category: 'Artificial Intelligence', desc: 'Pipeline ekstraksi dokumen, pemrosesan otomatis, dan agen cerdas' },
    { name: 'PostgreSQL & Redis', category: 'Data & Storage Engine', desc: 'In-memory caching dan relational schema tangguh' },
    { name: 'Docker & Kubernetes', category: 'Infrastruktur Cloud', desc: 'Container terisolasi yang siap scale horizontal tanpa downtime' }
  ]
});

const workflowSection = computed(() => getSection('workflow')?.content || {
  badge: 'METODOLOGI EKSEKUSI',
  title: 'Alur Kerja Terstruktur Tanpa Friksi',
  description: 'Setiap iterasi proyek dijalankan dengan transparansi penuh, dokumentasi rapi, dan siklus sprint mingguan yang dapat dievaluasi.',
  steps: [
    {
      step: '01',
      title: 'Audit & Desain Arsitektur',
      description: 'Kami mengidentifikasi bottleneck bisnis, menyusun spesifikasi PRD rinci, dan memodelkan skema database sebelum menulis kode.'
    },
    {
      step: '02',
      title: 'Prototyping & Design System',
      description: 'Merancang antarmuka interaktif di Figma dengan token desain konsisten yang siap diimplementasikan langsung ke kode.'
    },
    {
      step: '03',
      title: 'Sprint Development & Testing',
      description: 'Pengembangan berbasis komponen dengan code review berkala, unit test, dan demo hasil progres setiap akhir pekan.'
    },
    {
      step: '04',
      title: 'Audit Keamanan & Go-Live',
      description: 'Stress testing performa beban, audit kerentanan OWASP, penyiapan CI/CD automated pipeline, dan pemantauan aktif pasca peluncuran.'
    }
  ]
});

const testimonialsSection = computed(() => getSection('testimonials')?.content || {
  badge: 'REKAM JEJAK',
  title: 'Dipercaya oleh Pemimpin Rekayasa Teknologi',
  items: [
    {
      name: 'Reza Pratama',
      role: 'Chief Technology Officer',
      company: 'PT Artha Digital Mandiri',
      comment: 'Solkit Tech memahami arsitektur core ledger perbankan kami dengan sangat matang. Sistem pemrosesan transaksi yang mereka bangun menangani beban gajian nasional tanpa kendala.'
    },
    {
      name: 'Diana Stephanie',
      role: 'Head of Product Operations',
      company: 'Kargo Nusantara Logistics',
      comment: 'Telemetri IoT dan aplikasi pengemudi Flutter yang dibangun tim Solkit langsung menurunkan biaya bahan bakar armada kami hingga 22% pada kuartal pertama implementasi.'
    }
  ]
});

// Icon Resolver
const getServiceIcon = (iconName) => {
  switch (iconName?.toLowerCase()) {
    case 'smartphone': return Smartphone;
    case 'cpu': return Cpu;
    case 'cloud': return Cloud;
    case 'figma':
    case 'palette': return Palette;
    case 'code': return Code2;
    default: return Layout;
  }
};

// Consultation Form
const consultForm = useForm({
  name: '',
  email: '',
  phone: '',
  company: '',
  service_interest: 'Custom Web & Enterprise SaaS',
  budget_range: 'Rp 50 - 150 Juta',
  message: ''
});

const isFormSuccess = ref(false);

const submitConsultation = () => {
  consultForm.post(route('consultation.store'), {
    preserveScroll: true,
    onSuccess: () => {
      isFormSuccess.value = true;
      consultForm.reset();
      setTimeout(() => {
        isFormSuccess.value = false;
        isConsultModalOpen.value = false;
      }, 3500);
    }
  });
};

// Direct WhatsApp link
const whatsappUrl = computed(() => {
  const number = props.settings.whatsapp_number || '6281234567890';
  const cleanNumber = number.replace(/[^0-9]/g, '');
  const text = encodeURIComponent(`Halo Tim Solkit Tech, saya ingin mendiskusikan kebutuhan pengembangan produk perangkat lunak untuk perusahaan saya.`);
  return `https://wa.me/${cleanNumber}?text=${text}`;
});

// Featured flagship portfolio vs standard portfolios
const featuredPortfolio = computed(() => {
  return props.portfolios.find(p => p.is_featured) || props.portfolios[0];
});

const remainingPortfolios = computed(() => {
  if (!featuredPortfolio.value) return props.portfolios;
  return props.portfolios.filter(p => p.id !== featuredPortfolio.value.id);
});
</script>

<template>
  <Head :title="page?.title || 'Solkit Tech | Modern Software House & Digital Studio'" />

  <!-- Root Container with Organic Deep Atmosphere (Anti-Flat Dark) -->
  <div 
    class="min-h-screen bg-[#070b14] text-slate-100 font-sans selection:bg-indigo-500 selection:text-white relative overflow-hidden"
    :style="{ '--primary-color': primaryColor }"
  >
    <!-- Organic Layered Ambient Glows (Asymmetric Position) -->
    <div 
      class="absolute -top-32 -left-32 w-[680px] h-[680px] rounded-full blur-[160px] pointer-events-none opacity-[0.14]"
      :style="{ backgroundColor: primaryColor }"
    ></div>
    <div 
      class="absolute top-[35%] -right-48 w-[600px] h-[600px] rounded-full blur-[170px] pointer-events-none opacity-[0.10]"
      :style="{ backgroundColor: primaryColor }"
    ></div>
    <div 
      class="absolute bottom-[5%] left-[10%] w-[500px] h-[500px] rounded-full blur-[160px] pointer-events-none opacity-[0.08]"
      :style="{ backgroundColor: primaryColor }"
    ></div>

    <!-- Subtle Tech Mesh Dot Texture (Vercel/Linear Style Depth) -->
    <div class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:32px_32px] opacity-[0.18] pointer-events-none"></div>

    <!-- Sticky Minimalist Glass Navbar -->
    <header class="sticky top-0 z-50 bg-[#070b14]/80 backdrop-blur-xl border-b border-white/[0.06] transition-all">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 h-20 flex items-center justify-between">
        <!-- Brand -->
        <Link href="/" class="flex items-center gap-3.5 group">
          <div v-if="settings.site_logo_url" class="h-9 w-auto flex items-center">
            <img :src="settings.site_logo_url" :alt="settings.site_name" class="h-8 object-contain" />
          </div>
          <div 
            v-else 
            class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-base shadow-lg shadow-indigo-950/40 border border-white/10"
            :style="{ backgroundColor: primaryColor }"
          >
            S
          </div>
          <div>
            <span class="font-extrabold text-lg tracking-tight text-white block group-hover:text-slate-200 transition-colors">
              {{ settings.site_name || 'Solkit Tech' }}
            </span>
            <span class="text-[10px] tracking-widest text-slate-400 font-mono block">
              SOFTWARE ENGINEERING
            </span>
          </div>
        </Link>

        <!-- Navigation Menu -->
        <nav class="hidden md:flex items-center gap-9 text-sm font-medium text-slate-400">
          <a href="#services" class="hover:text-white transition-colors duration-200">Layanan</a>
          <a href="#case-studies" class="hover:text-white transition-colors duration-200">Studi Kasus</a>
          <a href="#tech-stack" class="hover:text-white transition-colors duration-200">Teknologi</a>
          <a href="#workflow" class="hover:text-white transition-colors duration-200">Metodologi</a>
          <a href="#testimonials" class="hover:text-white transition-colors duration-200">Klien</a>
        </nav>

        <!-- CTA Action -->
        <div class="flex items-center gap-4">
          <button
            @click="isConsultModalOpen = true"
            class="relative inline-flex items-center gap-2 px-5 py-2.5 text-xs font-semibold text-white rounded-xl border border-white/10 bg-white/[0.04] hover:bg-white/[0.08] hover:border-white/20 backdrop-blur-md transition-all duration-300 shadow-sm cursor-pointer group"
          >
            <span class="w-1.5 h-1.5 rounded-full" :style="{ backgroundColor: primaryColor }"></span>
            Konsultasi Proyek
            <ChevronRight class="w-3.5 h-3.5 text-slate-400 group-hover:translate-x-0.5 transition-transform" />
          </button>

          <Link 
            v-if="user" 
            :href="route('admin.dashboard')" 
            class="hidden sm:inline-flex text-xs font-medium text-slate-400 hover:text-white px-3 py-2 rounded-lg transition-colors"
          >
            Dashboard
          </Link>
        </div>
      </div>
    </header>

    <!-- HERO SECTION (Human-Crafted Typography & Breathing Space) -->
    <section class="relative pt-24 pb-28 md:pt-36 md:pb-40 px-6 sm:px-8">
      <div class="max-w-5xl mx-auto text-center space-y-8">
        <!-- Status Indicator Pill -->
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/[0.03] border border-white/10 backdrop-blur-md">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
          <span class="text-xs font-medium text-slate-300 tracking-wide font-mono">
            {{ heroSection.badge }}
          </span>
        </div>

        <!-- Main Headline (Tight Kerning, Bold & Impactful) -->
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-white leading-[1.08] max-w-4xl mx-auto">
          {{ heroSection.headline }}
        </h1>

        <!-- Subheadline (Generous Line Height & Breathable) -->
        <p class="text-base sm:text-xl text-slate-400 font-normal max-w-2xl mx-auto leading-relaxed">
          {{ heroSection.subheadline }}
        </p>

        <!-- Dynamic Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
          <button 
            @click="isConsultModalOpen = true"
            :style="{ backgroundColor: primaryColor }"
            class="w-full sm:w-auto px-8 py-4 rounded-xl text-sm font-semibold text-white shadow-xl shadow-indigo-950/40 hover:brightness-110 transition-all duration-300 flex items-center justify-center gap-2.5 group cursor-pointer"
          >
            {{ heroSection.cta_primary }}
            <ChevronRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
          </button>

          <a 
            href="#case-studies"
            class="w-full sm:w-auto px-8 py-4 rounded-xl text-sm font-semibold text-slate-300 bg-white/[0.03] hover:bg-white/[0.07] border border-white/10 hover:border-white/20 transition-all duration-300 flex items-center justify-center gap-2"
          >
            {{ heroSection.cta_secondary }}
            <ArrowUpRight class="w-4 h-4 text-slate-400" />
          </a>
        </div>

        <!-- Stats Bar (Integrated Clean Architecture without Gimmicks) -->
        <div class="pt-16 max-w-4xl mx-auto">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-6 sm:p-8 rounded-2xl bg-white/[0.02] border border-white/[0.06] backdrop-blur-xl">
            <div 
              v-for="(st, idx) in heroSection.stats" 
              :key="idx"
              class="text-left space-y-1"
            >
              <div class="text-2xl sm:text-3xl font-black tracking-tight text-white font-mono">
                {{ st.value }}
              </div>
              <div class="text-xs text-slate-400 font-medium">
                {{ st.label }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES (Bento Grid Layout - Not Symmetric Box Clones) -->
    <section id="services" class="py-28 md:py-36 px-6 sm:px-8 border-t border-white/[0.06] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <!-- Section Header -->
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-semibold tracking-widest text-slate-400 uppercase">
            KAPABILITAS TEKNIS
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            Layanan Rekayasa Sistem Tanpa Kompromi
          </h2>
          <p class="text-base text-slate-400 leading-relaxed">
            Setiap solusi dirancang berdasarkan analisis beban riil, standar keamanan industri, dan arsitektur kode yang bersih.
          </p>
        </div>

        <!-- Asymmetric Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Card 1: Featured Flagship Service (Span 2 Columns) -->
          <div 
            v-if="services[0]"
            class="md:col-span-2 rounded-3xl p-8 sm:p-10 bg-white/[0.02] hover:bg-white/[0.035] border border-white/[0.08] hover:border-white/20 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden"
          >
            <div class="space-y-6">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono px-3 py-1 rounded-full bg-white/[0.04] text-slate-300 border border-white/[0.08]">
                  {{ services[0].tagline || 'Layanan Utama' }}
                </span>
                <component :is="getServiceIcon(services[0].icon)" class="w-6 h-6 text-slate-400 group-hover:text-white transition-colors" />
              </div>

              <div class="space-y-3 max-w-xl">
                <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                  {{ services[0].title }}
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                  {{ services[0].description }}
                </p>
              </div>

              <!-- Deliverables Checklist -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (services[0].features || [])" 
                  :key="idx"
                  class="flex items-start gap-2.5 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <!-- Footer Tech Tags & Action -->
            <div class="pt-8 mt-6 border-t border-white/[0.06] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div class="flex flex-wrap gap-1.5">
                <span 
                  v-for="(tech, idx) in (services[0].tech_stack || [])" 
                  :key="idx"
                  class="px-2.5 py-1 rounded-md bg-white/[0.03] text-slate-300 text-xs font-mono border border-white/[0.06]"
                >
                  {{ tech }}
                </span>
              </div>

              <button
                @click="consultForm.service_interest = services[0].title; isConsultModalOpen = true"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-300 hover:text-white transition-colors cursor-pointer"
              >
                Konsultasikan Solusi Ini
                <ChevronRight class="w-4 h-4" />
              </button>
            </div>
          </div>

          <!-- Card 2: AI Automation Service (Span 1 Column, Vertical Accent) -->
          <div 
            v-if="services[1]"
            class="rounded-3xl p-8 sm:p-10 bg-white/[0.02] hover:bg-white/[0.035] border border-white/[0.08] hover:border-white/20 transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-6">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono px-3 py-1 rounded-full bg-white/[0.04] text-slate-300 border border-white/[0.08]">
                  {{ services[1].tagline || 'Intelligent System' }}
                </span>
                <component :is="getServiceIcon(services[1].icon)" class="w-6 h-6 text-slate-400 group-hover:text-white transition-colors" />
              </div>

              <div class="space-y-2">
                <h3 class="text-2xl font-bold text-white tracking-tight">
                  {{ services[1].title }}
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                  {{ services[1].description }}
                </p>
              </div>

              <div class="space-y-2.5 pt-4 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (services[1].features || []).slice(0, 3)" 
                  :key="idx"
                  class="flex items-start gap-2.5 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <div class="pt-6 mt-6 border-t border-white/[0.06] flex items-center justify-between">
              <div class="flex flex-wrap gap-1">
                <span 
                  v-for="(tech, idx) in (services[1].tech_stack || []).slice(0, 2)" 
                  :key="idx"
                  class="px-2 py-0.5 rounded bg-white/[0.03] text-slate-300 text-xs font-mono border border-white/[0.06]"
                >
                  {{ tech }}
                </span>
              </div>
              <button
                @click="consultForm.service_interest = services[1].title; isConsultModalOpen = true"
                class="text-xs font-semibold text-slate-300 hover:text-white cursor-pointer"
              >
                Pilih
              </button>
            </div>
          </div>

          <!-- Cards 3, 4, 5: Grid Bawah -->
          <div 
            v-for="service in services.slice(2)" 
            :key="service.id"
            class="rounded-3xl p-8 bg-white/[0.02] hover:bg-white/[0.035] border border-white/[0.08] hover:border-white/20 transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400">
                  {{ service.tagline || 'Spesialisasi' }}
                </span>
                <component :is="getServiceIcon(service.icon)" class="w-5 h-5 text-slate-400 group-hover:text-white transition-colors" />
              </div>

              <h3 class="text-xl font-bold text-white tracking-tight">
                {{ service.title }}
              </h3>

              <p class="text-xs text-slate-400 leading-relaxed">
                {{ service.description }}
              </p>

              <div class="space-y-2 pt-3 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (service.features || []).slice(0, 2)" 
                  :key="idx"
                  class="flex items-start gap-2 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-3.5 h-3.5 text-emerald-400 shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <div class="pt-6 mt-6 border-t border-white/[0.06] flex items-center justify-between">
              <div class="flex flex-wrap gap-1">
                <span 
                  v-for="(tech, idx) in (service.tech_stack || []).slice(0, 2)" 
                  :key="idx"
                  class="px-2 py-0.5 rounded bg-white/[0.03] text-slate-300 text-[11px] font-mono border border-white/[0.06]"
                >
                  {{ tech }}
                </span>
              </div>
              <button
                @click="consultForm.service_interest = service.title; isConsultModalOpen = true"
                class="text-xs font-semibold text-slate-300 hover:text-white cursor-pointer"
              >
                Diskusi
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CASE STUDIES (Impact-Driven & Asymmetric Portfolio) -->
    <section id="case-studies" class="py-28 md:py-36 px-6 sm:px-8 border-t border-white/[0.06] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <!-- Section Header -->
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-semibold tracking-widest text-slate-400 uppercase">
            STUDI KASUS PRODUKSI
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            Hasil Rekayasa Berbasis Dampak Bisnis
          </h2>
          <p class="text-base text-slate-400 leading-relaxed">
            Bukan sekadar galeri tampilan antarmuka. Kami memaparkan tantangan nyata, solusi rekayasa, dan metrik bisnis yang berhasil dicapai.
          </p>
        </div>

        <!-- Flagship Case Study Card (Large Asymmetric Layout) -->
        <div 
          v-if="featuredPortfolio"
          class="rounded-3xl bg-white/[0.02] border border-white/[0.08] hover:border-white/20 overflow-hidden transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 group"
        >
          <!-- Mockup Visual Image (Col 7) -->
          <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-auto overflow-hidden bg-slate-900">
            <img 
              v-if="featuredPortfolio.thumbnail_url" 
              :src="featuredPortfolio.thumbnail_url" 
              :alt="featuredPortfolio.title"
              class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-700 opacity-90"
            />
            <div v-else class="w-full h-full flex items-center justify-center bg-slate-900 text-slate-700">
              <Code2 class="w-20 h-20" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-transparent via-[#070b14]/30 to-[#070b14]"></div>

            <!-- Floating Metric Badge -->
            <div class="absolute top-6 left-6">
              <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#070b14]/85 border border-emerald-500/30 text-emerald-400 text-xs font-semibold backdrop-blur-md shadow-lg">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                {{ featuredPortfolio.impact_metric }}
              </span>
            </div>
          </div>

          <!-- Editorial Case Study Content (Col 5) -->
          <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
              <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                <span>{{ featuredPortfolio.client_name }}</span>
                <span>{{ featuredPortfolio.industry }}</span>
              </div>

              <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight leading-snug">
                {{ featuredPortfolio.title }}
              </h3>

              <!-- Problem & Solution Block -->
              <div class="space-y-4 pt-2">
                <div class="space-y-1">
                  <span class="text-[11px] font-mono font-semibold uppercase tracking-wider text-rose-400">
                    Kendala Awal
                  </span>
                  <p class="text-xs text-slate-300 leading-relaxed">
                    {{ featuredPortfolio.problem }}
                  </p>
                </div>
                <div class="space-y-1 pt-2 border-t border-white/[0.06]">
                  <span class="text-[11px] font-mono font-semibold uppercase tracking-wider text-indigo-400">
                    Solusi Rekayasa
                  </span>
                  <p class="text-xs text-slate-300 leading-relaxed">
                    {{ featuredPortfolio.solution }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Bottom Stack & Link -->
            <div class="pt-6 border-t border-white/[0.06] flex items-center justify-between">
              <div class="flex flex-wrap gap-1.5">
                <span 
                  v-for="(tech, idx) in (featuredPortfolio.tech_stack || []).slice(0, 4)" 
                  :key="idx"
                  class="px-2.5 py-1 rounded bg-white/[0.03] text-slate-300 text-xs font-mono border border-white/[0.06]"
                >
                  {{ tech }}
                </span>
              </div>

              <a 
                v-if="featuredPortfolio.project_url" 
                :href="featuredPortfolio.project_url" 
                target="_blank"
                class="p-2.5 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-slate-300 hover:text-white transition-colors"
                title="Tinjau Studi Kasus"
              >
                <ExternalLink class="w-4 h-4" />
              </a>
            </div>
          </div>
        </div>

        <!-- Remaining Case Studies (2-Column Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div 
            v-for="item in remainingPortfolios" 
            :key="item.id"
            class="rounded-3xl bg-white/[0.02] border border-white/[0.08] hover:border-white/20 overflow-hidden transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="relative h-60 w-full overflow-hidden bg-slate-900">
              <img 
                v-if="item.thumbnail_url" 
                :src="item.thumbnail_url" 
                :alt="item.title"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-85"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#070b14] via-transparent to-transparent"></div>
              
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#070b14]/85 border border-emerald-500/30 text-emerald-400 text-xs font-semibold backdrop-blur-md">
                  {{ item.impact_metric }}
                </span>
              </div>
            </div>

            <div class="p-8 space-y-5 flex-1 flex flex-col justify-between">
              <div class="space-y-3">
                <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                  <span>{{ item.client_name }}</span>
                  <span>{{ item.industry }}</span>
                </div>
                <h3 class="text-xl font-bold text-white tracking-tight">
                  {{ item.title }}
                </h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                  {{ item.solution }}
                </p>
              </div>

              <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between">
                <div class="flex flex-wrap gap-1.5">
                  <span 
                    v-for="(tech, idx) in (item.tech_stack || []).slice(0, 3)" 
                    :key="idx"
                    class="px-2 py-0.5 rounded bg-white/[0.03] text-slate-300 text-[11px] font-mono border border-white/[0.06]"
                  >
                    {{ tech }}
                  </span>
                </div>
                <a 
                  v-if="item.project_url" 
                  :href="item.project_url" 
                  target="_blank"
                  class="text-slate-400 hover:text-white p-2 transition-colors"
                >
                  <ExternalLink class="w-4 h-4" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TECH STACK (Curated Clean Grid - Not Cluttered) -->
    <section id="tech-stack" class="py-28 md:py-36 px-6 sm:px-8 border-t border-white/[0.06] bg-white/[0.01] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-semibold tracking-widest text-slate-400 uppercase">
            {{ techSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            {{ techSection.title }}
          </h2>
          <p class="text-base text-slate-400 leading-relaxed">
            {{ techSection.description }}
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="(stack, idx) in techSection.stacks" 
            :key="idx"
            class="p-6 rounded-2xl bg-white/[0.02] hover:bg-white/[0.04] border border-white/[0.06] hover:border-white/15 transition-all duration-300 space-y-3"
          >
            <span class="text-[11px] font-mono font-semibold text-slate-400 block">
              {{ stack.category }}
            </span>
            <h3 class="text-lg font-bold text-white tracking-tight">
              {{ stack.name }}
            </h3>
            <p class="text-xs text-slate-400 leading-relaxed">
              {{ stack.desc }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- WORKFLOW METODOLOGI (Step Architecture) -->
    <section id="workflow" class="py-28 md:py-36 px-6 sm:px-8 border-t border-white/[0.06] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-semibold tracking-widest text-slate-400 uppercase">
            {{ workflowSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            {{ workflowSection.title }}
          </h2>
          <p class="text-base text-slate-400 leading-relaxed">
            {{ workflowSection.description }}
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div 
            v-for="(step, idx) in workflowSection.steps" 
            :key="idx"
            class="p-8 rounded-3xl bg-white/[0.02] border border-white/[0.06] hover:border-white/15 transition-all duration-300 flex flex-col justify-between space-y-6"
          >
            <div class="text-3xl font-black font-mono text-slate-500">
              {{ step.step }}
            </div>
            <div class="space-y-2">
              <h3 class="text-lg font-bold text-white tracking-tight">
                {{ step.title }}
              </h3>
              <p class="text-xs text-slate-400 leading-relaxed">
                {{ step.description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS (Executive Reviews) -->
    <section id="testimonials" class="py-28 md:py-36 px-6 sm:px-8 border-t border-white/[0.06] bg-white/[0.01] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-semibold tracking-widest text-slate-400 uppercase">
            {{ testimonialsSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            {{ testimonialsSection.title }}
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div 
            v-for="(item, idx) in testimonialsSection.items" 
            :key="idx"
            class="p-8 sm:p-10 rounded-3xl bg-white/[0.02] border border-white/[0.06] flex flex-col justify-between space-y-6"
          >
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed italic">
              "{{ item.comment }}"
            </p>
            <div class="pt-6 border-t border-white/[0.06] flex items-center gap-4">
              <div 
                class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white text-sm"
                :style="{ backgroundColor: primaryColor }"
              >
                {{ item.name.charAt(0) }}
              </div>
              <div>
                <h4 class="text-sm font-bold text-white">{{ item.name }}</h4>
                <p class="text-xs text-slate-400">{{ item.role }} · <span class="text-slate-300">{{ item.company }}</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DIRECT ENGAGEMENT SECTION (Sophisticated Executive CTA) -->
    <section class="py-28 md:py-36 px-6 sm:px-8 border-t border-white/[0.06] relative">
      <div class="max-w-4xl mx-auto p-10 sm:p-14 rounded-3xl bg-white/[0.02] border border-white/10 backdrop-blur-xl text-center space-y-8 relative overflow-hidden">
        <div 
          class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full blur-[120px] pointer-events-none opacity-20"
          :style="{ backgroundColor: primaryColor }"
        ></div>

        <div class="space-y-4 relative z-10 max-w-2xl mx-auto">
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Mulai Diskusi Rekayasa Software Anda Hari Ini
          </h2>
          <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
            Dapatkan peninjauan arsitektur, pemilihan tech stack yang tepat, dan estimasi biaya tanpa komitmen awal.
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
          <button
            @click="isConsultModalOpen = true"
            :style="{ backgroundColor: primaryColor }"
            class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-semibold text-white shadow-lg hover:brightness-110 transition-all cursor-pointer"
          >
            Jadwalkan Konsultasi Teknis
          </button>

          <a
            :href="whatsappUrl"
            target="_blank"
            class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-semibold text-slate-300 bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 transition-colors flex items-center justify-center gap-2"
          >
            <Phone class="w-4 h-4 text-emerald-400" />
            WhatsApp Tech Lead
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-16 border-t border-white/[0.06] bg-[#050810] text-slate-400 text-xs">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="space-y-4 md:col-span-2">
          <div class="flex items-center gap-3">
            <div 
              class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-white text-xs"
              :style="{ backgroundColor: primaryColor }"
            >
              S
            </div>
            <span class="font-bold text-base text-white">{{ settings.site_name || 'Solkit Tech' }}</span>
          </div>
          <p class="text-xs text-slate-400 max-w-sm leading-relaxed">
            {{ settings.site_description || 'Studio rekayasa perangkat lunak untuk aplikasi web kustom, sistem mobile, dan otomatisasi AI berskala enterprise.' }}
          </p>
          <p class="text-xxs text-slate-500 font-mono">
            © {{ new Date().getFullYear() }} {{ settings.site_name || 'Solkit Tech' }}. Seluruh hak cipta dilindungi.
          </p>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-semibold uppercase tracking-wider text-white">Hubungi Kami</h4>
          <p class="text-slate-400">{{ settings.contact_email || 'hello@solkit.tech' }}</p>
          <p class="text-slate-400">+{{ settings.whatsapp_number || '6281234567890' }}</p>
          <p class="text-slate-500 text-xxs leading-relaxed">{{ settings.company_address || 'SCBD Jakarta Selatan, Indonesia' }}</p>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-semibold uppercase tracking-wider text-white">Navigasi</h4>
          <ul class="space-y-2">
            <li><a href="#services" class="hover:text-white transition-colors">Layanan</a></li>
            <li><a href="#case-studies" class="hover:text-white transition-colors">Studi Kasus</a></li>
            <li><a href="#tech-stack" class="hover:text-white transition-colors">Teknologi</a></li>
            <li><Link :href="route('login')" class="hover:text-white transition-colors">Portal Staf</Link></li>
          </ul>
        </div>
      </div>
    </footer>

    <!-- CONSULTATION MODAL -->
    <div 
      v-if="isConsultModalOpen" 
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
    >
      <div class="relative w-full max-w-xl bg-[#090e1a] border border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl">
        <button 
          @click="isConsultModalOpen = false"
          class="absolute top-6 right-6 p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/[0.04] transition-colors"
        >
          <X class="w-5 h-5" />
        </button>

        <div class="space-y-2 mb-6">
          <span class="text-xs font-mono uppercase tracking-widest text-slate-400">
            KONSULTASI SPESIFIKASI PROYEK
          </span>
          <h3 class="text-2xl font-bold text-white tracking-tight">
            Diskusikan Arsitektur Software Anda
          </h3>
          <p class="text-xs text-slate-400 leading-relaxed">
            Formulir ini akan langsung ditinjau oleh analis teknis Solkit Tech dalam 1x24 jam kerja.
          </p>
        </div>

        <div v-if="isFormSuccess" class="p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
          <CheckCircle2 class="w-6 h-6 shrink-0" />
          <div class="text-xs space-y-0.5">
            <p class="font-bold">Permintaan Berhasil Terkirim</p>
            <p>Terima kasih. Rekayasa teknis kami akan menghubungi Anda melalui kontak yang dicantumkan.</p>
          </div>
        </div>

        <form v-else @submit.prevent="submitConsultation" class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Nama Lengkap *</label>
              <input
                v-model="consultForm.name"
                type="text"
                placeholder="Nama Anda"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-white/30"
                required
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Email Kerja *</label>
              <input
                v-model="consultForm.email"
                type="email"
                placeholder="nama@perusahaan.com"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-white/30"
                required
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">WhatsApp Aktif *</label>
              <input
                v-model="consultForm.phone"
                type="text"
                placeholder="0812xxxxxxx"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-white/30"
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Perusahaan / Organisasi</label>
              <input
                v-model="consultForm.company"
                type="text"
                placeholder="PT Solusi Digital"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-white/30"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Fokus Kebutuhan</label>
              <select
                v-model="consultForm.service_interest"
                class="w-full bg-slate-900 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-white/30"
              >
                <option value="Custom Web & Enterprise SaaS">Custom Web & Enterprise SaaS</option>
                <option value="Mobile App (iOS/Android)">Mobile App (iOS/Android)</option>
                <option value="AI Integration & Automation">AI Integration & Automation</option>
                <option value="Cloud Infrastructure & DevOps">Cloud Infrastructure & DevOps</option>
                <option value="UI/UX Product Design">UI/UX Product Design</option>
              </select>
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Estimasi Anggaran</label>
              <select
                v-model="consultForm.budget_range"
                class="w-full bg-slate-900 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-white/30"
              >
                <option value="< Rp 50 Juta">&lt; Rp 50 Juta</option>
                <option value="Rp 50 - 150 Juta">Rp 50 - 150 Juta</option>
                <option value="Rp 150 - 300 Juta">Rp 150 - 300 Juta</option>
                <option value="> Rp 300 Juta">&gt; Rp 300 Juta</option>
              </select>
            </div>
          </div>

          <div class="space-y-1">
            <label class="block text-xs font-medium text-slate-300">Deskripsi Tantangan / Kebutuhan *</label>
            <textarea
              v-model="consultForm.message"
              rows="3"
              placeholder="Jelaskan secara ringkas sistem yang ingin dibangun atau kendala arsitektur saat ini..."
              class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-white/30"
              required
            ></textarea>
          </div>

          <div class="pt-2 flex items-center justify-between gap-4">
            <a 
              :href="whatsappUrl" 
              target="_blank"
              class="text-xs text-emerald-400 hover:text-emerald-300 flex items-center gap-1 font-medium"
            >
              <Phone class="w-3.5 h-3.5" />
              WhatsApp Langsung
            </a>

            <button
              type="submit"
              :disabled="consultForm.processing"
              :style="{ backgroundColor: primaryColor }"
              class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white shadow-md hover:brightness-110 transition-all cursor-pointer disabled:opacity-50"
            >
              Kirim Spesifikasi
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
