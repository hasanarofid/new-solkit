<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { 
  ArrowUpRight, 
  CheckCircle2, 
  MessageSquare, 
  Layers, 
  ChevronRight,
  Sparkles,
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
  Check
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

// Dynamic CSS Variables for Primary Color
const primaryColor = computed(() => props.settings.primary_color || '#4f46e5');

// Modal State
const isConsultModalOpen = ref(false);
const activeServiceFilter = ref('all');

// Helper to find specific section by key
const getSection = (key) => {
  if (!props.page || !props.page.sections) return null;
  return props.page.sections.find(s => s.key === key && s.is_active);
};

const heroSection = computed(() => getSection('hero')?.content || {
  badge: '🚀 Terbuka untuk Kolaborasi Proyek Baru',
  headline: 'Kami Merekayasa Produk Digital Berkinerja Tinggi & Siap Skala',
  subheadline: 'Dari ide rintisan hingga arsitektur korporat bernilai tinggi. Solkit Tech menghadirkan rekayasa software presisi dengan Laravel, Vue 3, Mobile Apps, dan Enterprise AI.',
  cta_primary: 'Konsultasi Gratis',
  cta_secondary: 'Eksplorasi Studi Kasus',
  stats: [
    { label: 'Proyek Terselesaikan', value: '45+' },
    { label: 'SLA Uptime Sistem', value: '99.98%' },
    { label: 'Pengguna Aktif Terlayani', value: '1.2M+' },
    { label: 'Tingkat Retensi Klien', value: '98%' }
  ]
});

const techSection = computed(() => getSection('tech_stack')?.content || {
  badge: 'TECH EXCELLENCE',
  title: 'Ekosistem Teknologi Terkini yang Kami Gunakan',
  description: 'Kami memilih stack modern yang teruji dalam stabilitas, skalabilitas, dan kecepatan deployment.',
  stacks: [
    { name: 'Laravel 11', category: 'Backend & API', desc: 'Arsitektur backend tangguh & aman' },
    { name: 'Vue 3 & Inertia', category: 'Frontend Architecture', desc: 'Antarmuka reaktif berkecepatan tinggi' },
    { name: 'Flutter & React Native', category: 'Mobile Ecosystem', desc: 'Fluid 60fps native experience' },
    { name: 'Python & Gemini AI', category: 'Artificial Intelligence', desc: 'RAG & agentic automation' },
    { name: 'PostgreSQL & Redis', category: 'Data & Caching', desc: 'In-memory ultra fast throughput' },
    { name: 'Docker & Kubernetes', category: 'Cloud & DevOps', desc: 'Containerization siap skala horizontal' },
    { name: 'Amazon Web Services', category: 'Cloud Infrastructure', desc: 'Serverless & high availability cluster' },
    { name: 'Tailwind CSS', category: 'Design System', desc: 'Atomic utility UI/UX Pro Max' }
  ]
});

const workflowSection = computed(() => getSection('workflow')?.content || {
  badge: 'METODOLOGI KAMI',
  title: 'Bagaimana Kami Mewujudkan Visi Digital Anda',
  description: 'Proses terstruktur berbasis Agile Sprint yang transparan, terukur, dan bebas dari kejutan tak terduga.',
  steps: [
    { step: '01', title: 'Discovery & Architecture', description: 'Memetakan model bisnis Anda, mitigasi risiko, PRD detail, dan skema database optimal.' },
    { step: '02', title: 'UI/UX Pro Max & Prototype', description: 'Perancangan wireframe interaktif di Figma lengkap dengan Design System yang berfokus konversi.' },
    { step: '03', title: 'Agile Sprint Development', description: 'Penulisan clean code dengan automated testing, weekly sprint demo, dan code review ketat.' },
    { step: '04', title: 'QA, Security & Launch', description: 'Load testing beban tinggi, penetration test OWASP, CI/CD pipeline, dan asistensi go-live 24/7.' }
  ]
});

const testimonialsSection = computed(() => getSection('testimonials')?.content || {
  badge: 'KEPERCAYAAN KLIEN',
  title: 'Apa Kata Para Pemimpin Bisnis Tentang Solkit Tech',
  items: [
    {
      name: 'Reza Pratama',
      role: 'Chief Technology Officer',
      company: 'Artha Digital Mandiri',
      comment: 'Solkit Tech bukan hanya vendor, mereka adalah partner teknis sejati. Tim mereka berhasil membangun sistem core payment kami dengan nol downtime.'
    },
    {
      name: 'Diana Stephanie',
      role: 'VP of Product',
      company: 'Kargo Nusantara Logistics',
      comment: 'Aplikasi mobile Flutter dan dashboard web yang dibangun Solkit memangkas biaya operasional BBM kami sebesar 22% dalam 3 bulan pertama.'
    }
  ]
});

// Icon Resolver Helper
const getServiceIcon = (iconName) => {
  switch (iconName?.toLowerCase()) {
    case 'smartphone': return Smartphone;
    case 'cpu': return Cpu;
    case 'cloud': return Cloud;
    case 'palette':
    case 'figma': return Palette;
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
  service_interest: 'Custom Web & SaaS',
  budget_range: '< Rp 50 Juta',
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

// WhatsApp Direct Link Generator
const whatsappUrl = computed(() => {
  const number = props.settings.whatsapp_number || '6281234567890';
  const cleanNumber = number.replace(/[^0-9]/g, '');
  const text = encodeURIComponent(`Halo Tim Solkit Tech, saya tertarik untuk mendiskusikan kebutuhan pengembangan software digital bersama tim Anda.`);
  return `https://wa.me/${cleanNumber}?text=${text}`;
});
</script>

<template>
  <Head :title="page?.title || 'Solkit Tech | Modern Software House & Digital Studio'" />

  <div 
    class="min-h-screen bg-slate-950 text-slate-100 font-sans selection:bg-indigo-500 selection:text-white relative overflow-hidden"
    :style="{ '--primary-color': primaryColor }"
  >
    <!-- Background Ambient Glow Blobs -->
    <div 
      class="absolute top-[-10%] left-[-10%] w-[650px] h-[650px] rounded-full blur-[140px] pointer-events-none opacity-20"
      :style="{ backgroundColor: primaryColor }"
    ></div>
    <div 
      class="absolute top-[35%] right-[-10%] w-[600px] h-[600px] rounded-full blur-[140px] pointer-events-none opacity-15"
      :style="{ backgroundColor: primaryColor }"
    ></div>
    <div 
      class="absolute bottom-[-5%] left-[20%] w-[550px] h-[550px] rounded-full blur-[140px] pointer-events-none opacity-15"
      :style="{ backgroundColor: primaryColor }"
    ></div>

    <!-- Sticky Glassmorphic Navbar -->
    <header class="sticky top-0 z-50 bg-slate-950/75 backdrop-blur-md border-b border-slate-900 transition-all duration-300">
      <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <!-- Logo -->
        <Link href="/" class="flex items-center gap-3 group">
          <div v-if="settings.site_logo_url" class="h-10 w-auto flex items-center">
            <img :src="settings.site_logo_url" :alt="settings.site_name" class="h-8 object-contain" />
          </div>
          <div 
            v-else 
            class="p-2.5 rounded-xl shadow-lg transition-transform group-hover:scale-105"
            :style="{ backgroundColor: primaryColor }"
          >
            <Layers class="w-5 h-5 text-white" />
          </div>
          <div>
            <span class="font-extrabold text-xl tracking-tight text-white block">
              {{ settings.site_name || 'Solkit Tech' }}
            </span>
            <span class="text-[10px] uppercase font-bold tracking-widest text-slate-500 block">
              Digital Studio
            </span>
          </div>
        </Link>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center gap-8">
          <a href="#services" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Layanan</a>
          <a href="#case-studies" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Portofolio</a>
          <a href="#tech-stack" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Teknologi</a>
          <a href="#workflow" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Metodologi</a>
          <a href="#testimonials" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Klien</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-4">
          <button
            @click="isConsultModalOpen = true"
            :style="{ backgroundColor: primaryColor }"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white rounded-xl shadow-lg shadow-indigo-600/20 hover:brightness-110 transition-all duration-200 cursor-pointer"
          >
            <Sparkles class="w-4 h-4" />
            Konsultasi Proyek
          </button>

          <Link 
            v-if="user" 
            :href="route('admin.dashboard')" 
            class="hidden sm:inline-flex items-center justify-center px-4 py-2 bg-slate-900 hover:bg-slate-800 border border-slate-800 text-xs font-semibold text-slate-300 rounded-xl transition-colors"
          >
            Dashboard
            <ArrowUpRight class="w-3.5 h-3.5 ml-1" />
          </Link>
        </div>
      </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative pt-20 pb-24 md:pt-28 md:pb-32 px-6">
      <div class="max-w-5xl mx-auto text-center space-y-8">
        <!-- Live Status Pill -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900/90 border border-slate-800 shadow-xl backdrop-blur-md">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
          <span class="text-xs font-semibold text-slate-300 tracking-wide">
            {{ heroSection.badge }}
          </span>
        </div>

        <!-- Headline -->
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight text-white leading-[1.1] max-w-4xl mx-auto">
          {{ heroSection.headline }}
        </h1>

        <!-- Subheadline -->
        <p class="text-base sm:text-xl text-slate-400 font-normal max-w-3xl mx-auto leading-relaxed">
          {{ heroSection.subheadline }}
        </p>

        <!-- CTAs -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
          <button 
            @click="isConsultModalOpen = true"
            :style="{ backgroundColor: primaryColor }"
            class="w-full sm:w-auto px-8 py-4 rounded-xl text-sm font-bold text-white shadow-xl hover:brightness-110 transition-all flex items-center justify-center gap-2 group cursor-pointer"
          >
            {{ heroSection.cta_primary }}
            <ChevronRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
          </button>

          <a 
            href="#case-studies"
            class="w-full sm:w-auto px-8 py-4 rounded-xl text-sm font-bold text-slate-200 bg-slate-900/80 hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition-all flex items-center justify-center gap-2"
          >
            {{ heroSection.cta_secondary }}
            <ArrowUpRight class="w-4 h-4 text-slate-400" />
          </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 pt-12 max-w-4xl mx-auto">
          <div 
            v-for="(st, idx) in heroSection.stats" 
            :key="idx"
            class="p-5 rounded-2xl bg-slate-900/50 border border-slate-800/80 backdrop-blur-md text-left"
          >
            <div class="text-2xl sm:text-3xl font-black text-white" :style="{ color: primaryColor }">{{ st.value }}</div>
            <div class="text-xs font-medium text-slate-400 mt-1">{{ st.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- TECH STACK SHOWCASE -->
    <section id="tech-stack" class="py-20 border-y border-slate-900/80 bg-slate-950/60 relative">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-14">
          <span class="text-xs font-bold uppercase tracking-widest text-indigo-400" :style="{ color: primaryColor }">
            {{ techSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            {{ techSection.title }}
          </h2>
          <p class="text-sm text-slate-400">
            {{ techSection.description }}
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div 
            v-for="(stack, idx) in techSection.stacks" 
            :key="idx"
            class="p-5 rounded-2xl bg-slate-900/40 hover:bg-slate-900/80 border border-slate-800/80 hover:border-slate-700 transition-all duration-300 group"
          >
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs font-mono font-semibold px-2 py-0.5 rounded bg-slate-800 text-slate-400">
                {{ stack.category }}
              </span>
              <Code2 class="w-4 h-4 text-slate-600 group-hover:text-indigo-400 transition-colors" />
            </div>
            <h3 class="text-lg font-bold text-white group-hover:text-indigo-300 transition-colors">
              {{ stack.name }}
            </h3>
            <p class="text-xs text-slate-400 mt-1">
              {{ stack.desc }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES CATALOG -->
    <section id="services" class="py-24 px-6 relative">
      <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
          <span class="text-xs font-bold uppercase tracking-widest text-indigo-400" :style="{ color: primaryColor }">
            SOLUSI & LAYANAN DIGITAL
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            Rekayasa Perangkat Lunak Skala Enterprise
          </h2>
          <p class="text-base text-slate-400">
            Kami menghadirkan kapabilitas end-to-end mulai dari arsitektur backend, aplikasi mobile fluid, hingga integrasi Artificial Intelligence.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div 
            v-for="service in services" 
            :key="service.id"
            class="rounded-3xl bg-slate-900/40 border border-slate-800/80 hover:border-slate-700/80 p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-950/20 group relative overflow-hidden"
          >
            <div class="space-y-6">
              <!-- Service Icon -->
              <div 
                class="w-14 h-14 rounded-2xl flex items-center justify-center transition-transform group-hover:scale-105"
                :style="{ backgroundColor: `${primaryColor}20`, color: primaryColor }"
              >
                <component :is="getServiceIcon(service.icon)" class="w-7 h-7" />
              </div>

              <div>
                <span class="text-xs font-semibold text-indigo-400 tracking-wider uppercase block mb-1">
                  {{ service.tagline || 'Layanan Inti' }}
                </span>
                <h3 class="text-2xl font-bold text-white group-hover:text-indigo-300 transition-colors">
                  {{ service.title }}
                </h3>
              </div>

              <p class="text-sm text-slate-400 leading-relaxed">
                {{ service.description }}
              </p>

              <!-- Deliverables Checklist -->
              <div class="space-y-2.5 pt-2 border-t border-slate-800/60">
                <div 
                  v-for="(feat, idx) in (service.features || [])" 
                  :key="idx"
                  class="flex items-start gap-2.5 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <!-- Tech Badges & CTA -->
            <div class="pt-6 mt-6 border-t border-slate-800/60 space-y-4">
              <div class="flex flex-wrap gap-1.5">
                <span 
                  v-for="(tech, idx) in (service.tech_stack || [])" 
                  :key="idx"
                  class="px-2.5 py-1 rounded-lg bg-slate-800/70 text-slate-300 text-[11px] font-mono border border-slate-700/50"
                >
                  {{ tech }}
                </span>
              </div>

              <button
                @click="consultForm.service_interest = service.title; isConsultModalOpen = true"
                class="w-full py-2.5 rounded-xl bg-slate-800/60 hover:bg-slate-800 text-xs font-bold text-white border border-slate-700/60 flex items-center justify-center gap-2 transition-colors cursor-pointer"
              >
                Diskusikan Layanan Ini
                <ChevronRight class="w-3.5 h-3.5" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CASE STUDIES / PORTFOLIO -->
    <section id="case-studies" class="py-24 px-6 bg-slate-950/80 border-t border-slate-900/80 relative">
      <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
          <div class="space-y-3 max-w-2xl">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400" :style="{ color: primaryColor }">
              STUDI KASUS BERBASIS DAMPAK (IMPACT-DRIVEN)
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
              Portofolio Hasil Nyata
            </h2>
            <p class="text-base text-slate-400">
              Setiap baris kode yang kami bangun berorientasi pada penyelesaian kendala bisnis nyata dan pencapaian metrik ROI positif bagi klien.
            </p>
          </div>
        </div>

        <!-- Portfolios Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <div 
            v-for="item in portfolios" 
            :key="item.id"
            class="rounded-3xl bg-slate-900/40 border border-slate-800/80 overflow-hidden hover:border-slate-700/80 transition-all duration-300 flex flex-col justify-between group"
          >
            <!-- Thumbnail Image -->
            <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-slate-900">
              <img 
                v-if="item.thumbnail_url" 
                :src="item.thumbnail_url" 
                :alt="item.title"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
              />
              <div v-else class="w-full h-full flex items-center justify-center bg-slate-900 text-slate-700">
                <Code2 class="w-16 h-16" />
              </div>
              
              <!-- Gradient Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

              <!-- Impact Banner Floating -->
              <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-950/90 border border-emerald-500/30 text-emerald-400 text-xs font-bold shadow-lg backdrop-blur-md">
                  <Sparkles class="w-3.5 h-3.5" />
                  {{ item.impact_metric || 'Successful Deployment' }}
                </span>
                <span class="text-xs font-mono px-2.5 py-1 rounded-lg bg-slate-950/80 text-slate-300 border border-slate-800 backdrop-blur-md">
                  {{ item.industry }}
                </span>
              </div>
            </div>

            <!-- Content Area -->
            <div class="p-6 sm:p-8 space-y-5 flex-1 flex flex-col justify-between">
              <div class="space-y-4">
                <div>
                  <span class="text-xs font-bold text-slate-400">Klien: {{ item.client_name }}</span>
                  <h3 class="text-2xl font-bold text-white mt-1 group-hover:text-indigo-300 transition-colors">
                    {{ item.title }}
                  </h3>
                </div>

                <!-- Problem & Solution Box -->
                <div class="space-y-3 bg-slate-950/60 p-4 rounded-2xl border border-slate-850">
                  <div v-if="item.problem" class="text-xs space-y-1">
                    <span class="font-bold text-rose-400 uppercase tracking-wider text-[10px]">Tantangan Klien:</span>
                    <p class="text-slate-300 leading-relaxed">{{ item.problem }}</p>
                  </div>
                  <div v-if="item.solution" class="text-xs space-y-1 pt-2 border-t border-slate-800/60">
                    <span class="font-bold text-indigo-400 uppercase tracking-wider text-[10px]">Solusi Solkit Tech:</span>
                    <p class="text-slate-300 leading-relaxed">{{ item.solution }}</p>
                  </div>
                </div>
              </div>

              <!-- Tech Stack & Live URL -->
              <div class="pt-4 border-t border-slate-800/60 flex items-center justify-between gap-4">
                <div class="flex flex-wrap gap-1.5">
                  <span 
                    v-for="(tech, idx) in (item.tech_stack || [])" 
                    :key="idx"
                    class="px-2.5 py-1 rounded bg-slate-800 text-slate-300 text-[11px] font-mono border border-slate-700/60"
                  >
                    {{ tech }}
                  </span>
                </div>

                <a 
                  v-if="item.project_url" 
                  :href="item.project_url" 
                  target="_blank"
                  class="p-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition-colors shrink-0"
                  title="Kunjungi Proyek"
                >
                  <ExternalLink class="w-4 h-4" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- AGILE WORKFLOW / HOW WE WORK -->
    <section id="workflow" class="py-24 px-6 border-t border-slate-900/80 relative">
      <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
          <span class="text-xs font-bold uppercase tracking-widest text-indigo-400" :style="{ color: primaryColor }">
            {{ workflowSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            {{ workflowSection.title }}
          </h2>
          <p class="text-sm text-slate-400">
            {{ workflowSection.description }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div 
            v-for="(step, idx) in workflowSection.steps" 
            :key="idx"
            class="p-6 rounded-3xl bg-slate-900/40 border border-slate-800/80 relative group hover:border-slate-700 transition-colors"
          >
            <span class="text-4xl font-black text-slate-800 group-hover:text-indigo-400/40 transition-colors">
              {{ step.step }}
            </span>
            <h3 class="text-lg font-bold text-white mt-4">
              {{ step.title }}
            </h3>
            <p class="text-xs text-slate-400 mt-2 leading-relaxed">
              {{ step.description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CLIENT TESTIMONIALS -->
    <section id="testimonials" class="py-24 px-6 bg-slate-950/90 border-t border-slate-900/80 relative">
      <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
          <span class="text-xs font-bold uppercase tracking-widest text-indigo-400" :style="{ color: primaryColor }">
            {{ testimonialsSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
            {{ testimonialsSection.title }}
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div 
            v-for="(item, idx) in testimonialsSection.items" 
            :key="idx"
            class="p-8 rounded-3xl bg-slate-900/40 border border-slate-800/80 flex flex-col justify-between space-y-6"
          >
            <p class="text-sm text-slate-300 italic leading-relaxed">
              "{{ item.comment }}"
            </p>
            <div class="flex items-center gap-3 pt-4 border-t border-slate-800/60">
              <div 
                class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white text-sm"
                :style="{ backgroundColor: primaryColor }"
              >
                {{ item.name.charAt(0) }}
              </div>
              <div>
                <h4 class="text-sm font-bold text-white">{{ item.name }}</h4>
                <p class="text-xs text-slate-400">{{ item.role }} · <span class="text-indigo-400">{{ item.company }}</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CALL TO ACTION & DIRECT CONTACT -->
    <section class="py-24 px-6 relative overflow-hidden">
      <div 
        class="max-w-5xl mx-auto rounded-3xl p-8 sm:p-14 text-center border border-slate-800 shadow-2xl relative overflow-hidden"
        :style="{ background: `linear-gradient(135deg, rgba(15,23,42,0.95), rgba(30,27,75,0.7))` }"
      >
        <div class="max-w-3xl mx-auto space-y-6 relative z-10">
          <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
            Siap Mentransformasikan Bisnis Anda Menjadi Pemimpin Digital?
          </h2>
          <p class="text-base text-slate-300">
            Diskusikan tantangan teknis Anda langsung dengan tim Tech Lead kami. Dapatkan analisis arsitektur, pemilihan tech stack, dan estimasi timeline gratis.
          </p>

          <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            <button
              @click="isConsultModalOpen = true"
              :style="{ backgroundColor: primaryColor }"
              class="w-full sm:w-auto px-8 py-4 rounded-xl text-sm font-bold text-white shadow-xl hover:brightness-110 transition-all flex items-center justify-center gap-2 cursor-pointer"
            >
              <Sparkles class="w-4 h-4" />
              Mulai Konsultasi Online
            </button>

            <a
              :href="whatsappUrl"
              target="_blank"
              class="w-full sm:w-auto px-8 py-4 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-500 transition-colors flex items-center justify-center gap-2 shadow-xl shadow-emerald-600/20"
            >
              <Phone class="w-4 h-4" />
              WhatsApp Tech Lead Langsung
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-14 border-t border-slate-900 bg-slate-950 text-slate-400 text-xs">
      <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
        <!-- Brand -->
        <div class="space-y-4 md:col-span-2">
          <div class="flex items-center gap-3">
            <div 
              class="p-2 rounded-xl text-white"
              :style="{ backgroundColor: primaryColor }"
            >
              <Layers class="w-5 h-5" />
            </div>
            <span class="font-extrabold text-xl text-white">{{ settings.site_name || 'Solkit Tech' }}</span>
          </div>
          <p class="text-xs text-slate-400 max-w-md leading-relaxed">
            {{ settings.site_description || 'Enterprise Digital Engineering & Modern Software House.' }}
          </p>
          <p class="text-xxs text-slate-500">
            © {{ new Date().getFullYear() }} {{ settings.site_name || 'Solkit Tech' }}. All rights reserved. Built with Laravel 11 & Vue 3.
          </p>
        </div>

        <!-- Contact Info -->
        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Hubungi Kami</h4>
          <p class="flex items-center gap-2 text-slate-400">
            <Mail class="w-4 h-4 text-indigo-400" />
            {{ settings.contact_email || 'hello@solkit.tech' }}
          </p>
          <p class="flex items-center gap-2 text-slate-400">
            <Phone class="w-4 h-4 text-emerald-400" />
            +{{ settings.whatsapp_number || '6281234567890' }}
          </p>
          <p class="flex items-start gap-2 text-slate-400">
            <MapPin class="w-4 h-4 text-rose-400 shrink-0 mt-0.5" />
            <span>{{ settings.company_address || 'SCBD Jakarta Selatan, Indonesia' }}</span>
          </p>
        </div>

        <!-- Quick Links -->
        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Akses Cepat</h4>
          <ul class="space-y-2">
            <li><a href="#services" class="hover:text-white transition-colors">Layanan Software</a></li>
            <li><a href="#case-studies" class="hover:text-white transition-colors">Studi Kasus Klien</a></li>
            <li><a href="#tech-stack" class="hover:text-white transition-colors">Teknologi Modern</a></li>
            <li><Link :href="route('login')" class="hover:text-white transition-colors">Staff Portal (Login)</Link></li>
          </ul>
        </div>
      </div>
    </footer>

    <!-- CONSULTATION / LEAD MODAL -->
    <div 
      v-if="isConsultModalOpen" 
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md animate-fadeIn"
    >
      <div class="relative w-full max-w-xl bg-slate-950 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl">
        <button 
          @click="isConsultModalOpen = false"
          class="absolute top-6 right-6 p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 transition-colors"
        >
          <X class="w-5 h-5" />
        </button>

        <div class="space-y-2 mb-6">
          <span class="text-xs font-bold uppercase tracking-widest text-indigo-400" :style="{ color: primaryColor }">
            KONSULTASI GRATIS 1-ON-1
          </span>
          <h3 class="text-2xl font-bold text-white">
            Diskusikan Kebutuhan Software Anda
          </h3>
          <p class="text-xs text-slate-400">
            Isi formulir ringkas di bawah. Tim analis teknis Solkit Tech akan merespons dalam 1x24 jam kerja.
          </p>
        </div>

        <!-- Success Message -->
        <div v-if="isFormSuccess" class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
          <CheckCircle2 class="w-6 h-6 shrink-0" />
          <div class="text-xs">
            <p class="font-bold">Terima kasih atas kepercayaan Anda!</p>
            <p>Pesan Anda telah berhasil kami terima. Kami akan segera menghubungi Anda.</p>
          </div>
        </div>

        <!-- Form -->
        <form v-else @submit.prevent="submitConsultation" class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-semibold text-slate-300">Nama Lengkap *</label>
              <input
                v-model="consultForm.name"
                type="text"
                placeholder="Nama Anda"
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
                required
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-semibold text-slate-300">Email Bisnis *</label>
              <input
                v-model="consultForm.email"
                type="email"
                placeholder="nama@perusahaan.com"
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
                required
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-semibold text-slate-300">Nomor WhatsApp *</label>
              <input
                v-model="consultForm.phone"
                type="text"
                placeholder="0812xxxxxxx"
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-semibold text-slate-300">Nama Perusahaan / Startup</label>
              <input
                v-model="consultForm.company"
                type="text"
                placeholder="PT Inovasi Digital"
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-semibold text-slate-300">Layanan yang Dibutuhkan</label>
              <select
                v-model="consultForm.service_interest"
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-indigo-500"
              >
                <option value="Custom Web & SaaS">Custom Web & SaaS</option>
                <option value="Mobile App (iOS/Android)">Mobile App (iOS/Android)</option>
                <option value="AI Integration & Automation">AI Integration & Automation</option>
                <option value="Cloud DevOps & Scaling">Cloud DevOps & Scaling</option>
                <option value="UI/UX Product Design">UI/UX Product Design</option>
              </select>
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-semibold text-slate-300">Estimasi Budget Proyek</label>
              <select
                v-model="consultForm.budget_range"
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-indigo-500"
              >
                <option value="< Rp 50 Juta">&lt; Rp 50 Juta</option>
                <option value="Rp 50 - 150 Juta">Rp 50 - 150 Juta</option>
                <option value="Rp 150 - 300 Juta">Rp 150 - 300 Juta</option>
                <option value="> Rp 300 Juta">&gt; Rp 300 Juta</option>
              </select>
            </div>
          </div>

          <div class="space-y-1">
            <label class="block text-xs font-semibold text-slate-300">Ceritakan Tantangan atau Rencana Proyek *</label>
            <textarea
              v-model="consultForm.message"
              rows="3"
              placeholder="Contoh: Kami ingin membangun marketplace B2B dengan fitur multi-vendor, integrasi payment gateway, dan aplikasi kurir..."
              class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
              required
            ></textarea>
          </div>

          <div class="pt-2 flex items-center justify-between gap-4">
            <a 
              :href="whatsappUrl" 
              target="_blank"
              class="text-xs text-emerald-400 hover:text-emerald-300 flex items-center gap-1 font-semibold"
            >
              <Phone class="w-3.5 h-3.5" />
              Chat WhatsApp Langsung
            </a>

            <button
              type="submit"
              :disabled="consultForm.processing"
              :style="{ backgroundColor: primaryColor }"
              class="px-6 py-3 rounded-xl text-xs font-bold text-white shadow-xl hover:brightness-110 transition-all flex items-center gap-2 cursor-pointer disabled:opacity-50"
            >
              <Send class="w-3.5 h-3.5" />
              Kirim Konsultasi
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
