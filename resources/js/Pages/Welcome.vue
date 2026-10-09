<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { 
  ArrowUpRight, 
  ArrowRight,
  BookOpen,
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
  Terminal,
  Activity,
  ShieldCheck,
  Server,
  Zap
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

// Primary Color: Electric Blue SOLKIT (#0052FF)
const primaryColor = computed(() => props.settings.primary_color || '#0052FF');

// Modal State
const isConsultModalOpen = ref(false);

// Helper for dynamic section content
const getSection = (key) => {
  if (!props.page || !props.page.sections) return null;
  return props.page.sections.find(s => s.key === key && s.is_active);
};

const heroSection = computed(() => getSection('hero')?.content || {
  badge: 'Terbuka untuk Kolaborasi Proyek Q4',
  headline: 'Membangun Ekosistem Perangkat Lunak Masa Depan',
  subheadline: 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak terpilih untuk bisnis bertumbuh dan korporasi. Kami merancang custom web platform, aplikasi mobile fluid, dan otomatisasi AI berkinerja tinggi.',
  cta_primary: 'Mulai Konsultasi Teknis',
  cta_secondary: 'Eksplorasi Studi Kasus',
  stats: [
    { label: 'Proyek Skala Enterprise', value: '45+' },
    { label: 'Rata-rata SLA Uptime', value: '99.98%' },
    { label: 'Throughput Transaksi/Hari', value: '1.2M+' },
    { label: 'Retensi Kemitraan Klien', value: '98%' }
  ]
});

const techSection = computed(() => getSection('tech_stack')?.content || {
  badge: 'ARSITEKTUR & TEKNOLOGI',
  title: 'Ekosistem Modern Berdaya Tahan Tinggi',
  description: 'Kami menggunakan stack teknologi yang teruji di lingkungan produksi berskala besar, menjamin stabilitas, kecepatan, dan pemeliharaan mudah.',
  stacks: [
    { name: 'Laravel 11', category: 'Backend Engine', desc: 'Arsitektur modular, antrean aman, dan skalabilitas data tinggi' },
    { name: 'Vue 3 & Inertia.js', category: 'Frontend Architecture', desc: 'Pengalaman SPA instan tanpa kerumitan REST API terpisah' },
    { name: 'Flutter & Kotlin', category: 'Mobile Engineering', desc: 'Aplikasi lintas platform 60fps dengan sinkronisasi offline-first' },
    { name: 'Python & LLM RAG', category: 'Artificial Intelligence', desc: 'Pemrosesan dokumen otomatis, analitik prediktif, dan AI agents' },
    { name: 'PostgreSQL & Redis', category: 'Data & Cache Tier', desc: 'In-memory throughput super cepat dan konsistensi relasional' },
    { name: 'Docker & Kubernetes', category: 'Cloud Infrastructure', desc: 'Container terisolasi yang siap scale horizontal tanpa downtime' }
  ]
});

const workflowSection = computed(() => getSection('workflow')?.content || {
  badge: 'METODOLOGI KAMI',
  title: 'Alur Kerja Rekayasa Berstandar Agensi Global',
  description: 'Proses Agile terukur tanpa friksi dengan dokumentasi arsitektur rapi dan sprint mingguan yang transparan.',
  steps: [
    {
      step: '01',
      title: 'Discovery & System Design',
      description: 'Audit model bisnis, mitigasi celah keamanan, penyusunan PRD mendalam, dan perancangan skema database optimal.'
    },
    {
      step: '02',
      title: 'UI/UX Pro Max & Prototyping',
      description: 'Pembuatan design system interaktif di Figma yang berfokus pada kemudahan pakai dan konversi bisnis.'
    },
    {
      step: '03',
      title: 'Agile Sprint Engineering',
      description: 'Penulisan clean code dengan automated testing, weekly sprint demo, dan code review ketat sebelum merge.'
    },
    {
      step: '04',
      title: 'Security Audit & Zero-Downtime Launch',
      description: 'Load stress test, OWASP penetration testing, setup CI/CD pipeline, serta asistensi go-live 24/7.'
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
      comment: 'SOLKIT memahami arsitektur sistem core payment kami dengan sangat matang. Engine transaksi yang mereka rancang sukses menangani lonjakan transaksi nasional tanpa kendala.'
    },
    {
      name: 'Diana Stephanie',
      role: 'Head of Product Operations',
      company: 'Kargo Nusantara Logistics',
      comment: 'Telemetri IoT dan aplikasi pengemudi Flutter yang dibangun tim SOLKIT memangkas biaya bahan bakar armada kami hingga 22% dalam 3 bulan pertama pengoperasian.'
    }
  ]
});

// JSON-LD Structured Data Schema.org (Google & Search Engines)
const structuredDataJson = computed(() => {
  return JSON.stringify({
    '@context': 'https://schema.org',
    '@graph': [
      {
        '@type': 'ProfessionalService',
        '@id': 'https://solkit.tech/#organization',
        'name': 'SOLKIT (Solusi Kode Kita)',
        'alternateName': ['SOLKIT', 'Solusi Kode Kita', 'Solkit Tech', 'Software House Surabaya'],
        'url': 'https://solkit.tech',
        'logo': 'https://solkit.tech/images/solkit-dark.svg',
        'image': 'https://solkit.tech/images/solkit-dark.png',
        'description': props.settings.site_description || 'Software house modern berbasis di Surabaya, Jawa Timur yang melayani seluruh Indonesia untuk rekayasa web apps enterprise, mobile apps, sistem ERP/POS, dan integrasi AI.',
        'telephone': props.settings.whatsapp_number ? `+${props.settings.whatsapp_number}` : '+6281234567890',
        'email': props.settings.contact_email || 'partner@solkit.tech',
        'priceRange': '$$',
        'address': {
          '@type': 'PostalAddress',
          'streetAddress': props.settings.company_address || 'Surabaya, Jawa Timur, Indonesia',
          'addressLocality': 'Surabaya',
          'addressRegion': 'Jawa Timur',
          'postalCode': '60111',
          'addressCountry': 'ID'
        },
        'geo': {
          '@type': 'GeoCoordinates',
          'latitude': -7.2575,
          'longitude': 112.7521
        },
        'areaServed': [
          { '@type': 'City', 'name': 'Surabaya' },
          { '@type': 'AdministrativeArea', 'name': 'Jawa Timur' },
          { '@type': 'AdministrativeArea', 'name': 'Gerbangkertosusila' },
          { '@type': 'Country', 'name': 'Indonesia' },
          { '@type': 'Country', 'name': 'Malaysia' },
          { '@type': 'Country', 'name': 'Singapore' }
        ],
        'sameAs': [
          'https://github.com/hasanarofid',
          'https://hasanarofid.site'
        ]
      }
    ]
  });
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

// Form Handler
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
  const text = encodeURIComponent(`Halo Tim SOLKIT (Solusi Kode Kita), saya ingin mendiskusikan kebutuhan pengembangan software untuk proyek kami.`);
  return `https://wa.me/${cleanNumber}?text=${text}`;
});

const featuredPortfolio = computed(() => {
  return props.portfolios.find(p => p.is_featured) || props.portfolios[0];
});

const remainingPortfolios = computed(() => {
  if (!featuredPortfolio.value) return props.portfolios;
  return props.portfolios.filter(p => p.id !== featuredPortfolio.value.id);
});
</script>

<template>
  <Head :title="page?.title || settings.meta_title || 'SOLKIT (Solusi Kode Kita) | Software House Surabaya & Jawa Timur'">
    <meta name="description" :content="page?.meta_description || settings.meta_description || 'SOLKIT (Solusi Kode Kita) adalah software house modern berbasis di Surabaya, Jawa Timur yang merekayasa arsitektur web enterprise, mobile apps iOS & Android, dan integrasi Enterprise AI.'" />
    <meta name="keywords" :content="settings.meta_keywords || 'software house surabaya, jasa pembuatan website surabaya, jasa aplikasi mobile surabaya, web developer surabaya, software house jawa timur, jasa pembuatan website jawa timur, software house indonesia, solkit, solusi kode kita'" />
    <meta name="author" content="SOLKIT (Solusi Kode Kita)" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

    <!-- GEO Meta Tags (Local & Regional Surabaya / Jawa Timur SEO) -->
    <meta name="geo.region" :content="settings.geo_region || 'ID-JI'" />
    <meta name="geo.placename" :content="settings.geo_placename || 'Surabaya, Jawa Timur, Indonesia'" />
    <meta name="geo.position" :content="settings.geo_position || '-7.2575;112.7521'" />
    <meta name="ICBM" :content="settings.geo_icbm || '-7.2575, 112.7521'" />
    <meta name="geo.country" content="ID" />

    <!-- OpenGraph Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="SOLKIT - Solusi Kode Kita" />
    <meta property="og:title" :content="page?.title || settings.meta_title || 'SOLKIT | Software House Indonesia'" />
    <meta property="og:description" :content="page?.meta_description || settings.meta_description" />
    <meta property="og:url" content="https://solkit.tech" />
    <meta property="og:image" :content="settings.og_image || '/images/solkit-dark.png'" />

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="page?.title || settings.meta_title || 'SOLKIT | Software House Indonesia'" />
    <meta name="twitter:description" :content="page?.meta_description || settings.meta_description" />
    <meta name="twitter:image" :content="settings.og_image || '/images/solkit-dark.png'" />

    <!-- Google Site Verification -->
    <meta v-if="settings.google_site_verification" name="google-site-verification" :content="settings.google_site_verification" />

    <!-- Canonical Link -->
    <link rel="canonical" href="https://solkit.tech" />

    <!-- JSON-LD Structured Data Schema.org -->
    <component :is="'script'" type="application/ld+json" v-html="structuredDataJson" />
  </Head>

  <!-- Root Container with Deep Obsidian Palette (#090A0E) & Electric Blue Glow -->
  <div 
    class="min-h-screen bg-[#090A0E] text-slate-100 font-sans selection:bg-[#0052FF] selection:text-white relative overflow-hidden"
    :style="{ '--solkit-blue': primaryColor }"
  >
    <!-- Organic Asymmetric Ambient Glows (Electric Blue #0052FF) -->
    <div 
      class="absolute -top-36 -left-36 w-[700px] h-[700px] rounded-full blur-[180px] pointer-events-none opacity-25"
      :style="{ backgroundColor: primaryColor }"
    ></div>
    <div 
      class="absolute top-[40%] -right-48 w-[650px] h-[650px] rounded-full blur-[190px] pointer-events-none opacity-15"
      :style="{ backgroundColor: primaryColor }"
    ></div>
    <div 
      class="absolute bottom-[-10%] left-[25%] w-[600px] h-[600px] rounded-full blur-[180px] pointer-events-none opacity-15"
      :style="{ backgroundColor: primaryColor }"
    ></div>

    <!-- Engineering Dot-Grid Precision Texture -->
    <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:28px_28px] opacity-25 pointer-events-none"></div>

    <!-- STICKY GLASSMORPHIC NAVBAR DENGAN LOGO SOLKIT PRESISI -->
    <header class="sticky top-0 z-50 bg-[#090A0E]/80 backdrop-blur-xl border-b border-white/[0.08] transition-all">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 h-20 flex items-center justify-between">
        
        <!-- Logo Resmi SOLKIT (Solusi Kode Kita) -->
        <Link href="/" class="flex items-center gap-3.5 group cursor-pointer py-1">
          <img 
            :src="settings.site_logo_url || '/images/solkit-dark.svg'" 
            alt="SOLKIT - Solusi Kode Kita" 
            class="h-11 w-auto max-w-[200px] object-contain transition-transform duration-300 group-hover:scale-105"
            @error="$event.target.src = '/images/solkit-dark.svg'"
          />
        </Link>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center gap-9 text-xs font-semibold uppercase tracking-wider text-slate-400">
          <a href="#services" class="hover:text-white transition-colors">Layanan</a>
          <a href="#case-studies" class="hover:text-white transition-colors">Studi Kasus</a>
          <a href="#tech-stack" class="hover:text-white transition-colors">Teknologi</a>
          <a href="#workflow" class="hover:text-white transition-colors">Metodologi</a>
          <a href="#testimonials" class="hover:text-white transition-colors">Klien</a>
          <Link :href="route('blog.index')" class="text-sky-400 hover:text-white transition-colors font-bold">Blog</Link>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-4">
          <button
            @click="isConsultModalOpen = true"
            :style="{ backgroundColor: primaryColor }"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white rounded-xl shadow-[0_0_20px_rgba(0,82,255,0.4)] hover:brightness-110 transition-all duration-300 cursor-pointer"
          >
            Konsultasi Proyek
            <ChevronRight class="w-3.5 h-3.5" />
          </button>

          <Link 
            v-if="user" 
            :href="route('admin.dashboard')" 
            class="hidden sm:inline-flex text-xs font-semibold text-slate-300 hover:text-white px-3.5 py-2 rounded-xl bg-white/[0.04] border border-white/10 transition-colors"
          >
            Admin Panel
          </Link>
        </div>
      </div>
    </header>

    <!-- HERO SECTION (Split-Screen & Asymmetric Typography - Bukan Rata Tengah Kaku) -->
    <section class="relative pt-16 pb-24 md:pt-24 md:pb-32 px-6 sm:px-8 border-b border-white/[0.06]">
      <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        
        <!-- Left Column: Asymmetric Bold Typography & Direct Action -->
        <div class="lg:col-span-7 space-y-7 text-left">
          <!-- Live Capacity Pill -->
          <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/[0.03] border border-white/10 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-xs font-mono font-medium text-slate-300">
              {{ heroSection.badge }}
            </span>
          </div>

          <!-- Bold Tight Main Headline -->
          <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white leading-[1.05]">
            Membangun Ekosistem Perangkat Lunak <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Masa Depan.</span>
          </h1>

          <!-- Breathable Subheadline -->
          <p class="text-base sm:text-lg text-slate-400 font-normal leading-relaxed max-w-xl">
            {{ heroSection.subheadline }}
          </p>

          <!-- Dual CTA Buttons -->
          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
            <button 
              @click="isConsultModalOpen = true"
              :style="{ backgroundColor: primaryColor }"
              class="px-8 py-4 rounded-xl text-sm font-bold text-white shadow-[0_0_30px_rgba(0,82,255,0.45)] hover:brightness-110 transition-all duration-300 flex items-center justify-center gap-2 group cursor-pointer"
            >
              {{ heroSection.cta_primary }}
              <ChevronRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
            </button>

            <a 
              href="#case-studies"
              class="px-8 py-4 rounded-xl text-sm font-bold text-slate-300 bg-white/[0.03] hover:bg-white/[0.07] border border-white/10 hover:border-blue-500/40 transition-all duration-300 flex items-center justify-center gap-2"
            >
              {{ heroSection.cta_secondary }}
              <ArrowUpRight class="w-4 h-4 text-slate-400" />
            </a>
          </div>

          <!-- Integrated Trust Metrics Strip -->
          <div class="pt-8 border-t border-white/[0.08] grid grid-cols-2 sm:grid-cols-4 gap-6">
            <div v-for="(st, idx) in heroSection.stats" :key="idx" class="space-y-1">
              <div class="text-2xl sm:text-3xl font-black font-mono text-white" :style="{ color: idx === 0 ? '#60A5FA' : 'white' }">
                {{ st.value }}
              </div>
              <div class="text-xs text-slate-400 font-medium leading-snug">
                {{ st.label }}
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Interactive Live Architecture Console (Vercel/Linear Engineering Style) -->
        <div class="lg:col-span-5 relative">
          <!-- Ambient Console Backlight -->
          <div class="absolute -inset-1 rounded-3xl bg-gradient-to-tr from-blue-600/30 to-indigo-600/10 blur-xl opacity-60"></div>

          <!-- Console Terminal Window -->
          <div class="relative rounded-3xl bg-[#0D0F17] border border-white/[0.12] shadow-2xl p-6 sm:p-7 space-y-6 overflow-hidden">
            <!-- Terminal Header Bar -->
            <div class="flex items-center justify-between pb-4 border-b border-white/[0.08]">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                <span class="ml-2 text-xs font-mono text-slate-400">solkit-cluster-v4 // production</span>
              </div>
              <div class="flex items-center gap-1.5 px-2.5 py-1 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-mono">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                ONLINE
              </div>
            </div>

            <!-- Terminal Metrics Block -->
            <div class="space-y-4 font-mono text-xs">
              <div class="p-3.5 rounded-xl bg-white/[0.02] border border-white/[0.06] space-y-2">
                <div class="flex items-center justify-between text-slate-400 text-[11px]">
                  <span>CORE ARCHITECTURE</span>
                  <span class="text-emerald-400">HEALTHY (99.98%)</span>
                </div>
                <div class="flex items-center gap-2 text-white font-semibold">
                  <Server class="w-4 h-4 text-blue-400" />
                  <span>Laravel 11 + Vue 3 Inertia + Microservices</span>
                </div>
              </div>

              <!-- Real-time telemetry items -->
              <div class="grid grid-cols-2 gap-3">
                <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.06] space-y-1">
                  <span class="text-[10px] text-slate-400">EDGE LATENCY</span>
                  <div class="text-sm font-bold text-white flex items-center gap-1">
                    <Zap class="w-3.5 h-3.5 text-blue-400" />
                    <span>8.4 ms</span>
                  </div>
                </div>
                <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.06] space-y-1">
                  <span class="text-[10px] text-slate-400">SECURITY AUDIT</span>
                  <div class="text-sm font-bold text-white flex items-center gap-1">
                    <ShieldCheck class="w-3.5 h-3.5 text-emerald-400" />
                    <span>OWASP Grade A+</span>
                  </div>
                </div>
              </div>

              <!-- Live Stream Code Log -->
              <div class="p-3.5 rounded-xl bg-black/40 border border-white/[0.06] text-slate-400 text-[11px] space-y-1 font-mono">
                <p class="text-slate-500">// Deploying enterprise pipeline</p>
                <p><span class="text-emerald-400">✓</span> Container orchestration: Docker & K8s</p>
                <p><span class="text-emerald-400">✓</span> High-throughput Redis cluster sync</p>
                <p><span class="text-blue-400">&gt;</span> Ready for client project onboarding...</p>
              </div>
            </div>

            <!-- Bottom Brand Stamp -->
            <div class="pt-2 flex items-center justify-between text-xs text-slate-400 border-t border-white/[0.06]">
              <span class="font-mono text-[11px]">SOLKIT ENGINEERING STUDIO</span>
              <span class="text-sky-400 font-mono text-[11px]">Solusi Kode Kita</span>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- SERVICES (BENTO GRID ASYMMETRIC LAYOUT - ANTI KOTAK-KOTAK BIASA) -->
    <section id="services" class="py-28 md:py-36 px-6 sm:px-8 border-b border-white/[0.06] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        
        <!-- Section Header -->
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
            KAPABILITAS & LAYANAN REKAYASA
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
            Solusi Perangkat Lunak Skala Enterprise
          </h2>
          <p class="text-base text-slate-400 leading-relaxed">
            Dari arsitektur SaaS berskala multi-juta pengguna hingga aplikasi mobile fluid, kami membangun sistem yang dirancang untuk stabilitas jangka panjang.
          </p>
        </div>

        <!-- Asymmetric Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
          
          <!-- Bento Item 1: Flagship Web & SaaS (Span 8 Cols) -->
          <div 
            v-if="services[0]"
            class="md:col-span-8 rounded-3xl p-8 sm:p-10 bg-white/[0.02] hover:bg-white/[0.04] border border-white/[0.08] hover:border-blue-500/50 hover:shadow-[0_0_35px_rgba(0,82,255,0.15)] transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-6">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono px-3 py-1 rounded-full bg-blue-500/10 text-sky-400 border border-blue-500/20">
                  {{ services[0].tagline || 'Layanan Utama' }}
                </span>
                <component :is="getServiceIcon(services[0].icon)" class="w-6 h-6 text-slate-400 group-hover:text-blue-400 transition-colors" />
              </div>

              <div class="space-y-3 max-w-2xl">
                <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                  {{ services[0].title }}
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                  {{ services[0].description }}
                </p>
              </div>

              <!-- Deliverables Grid -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (services[0].features || [])" 
                  :key="idx"
                  class="flex items-start gap-2.5 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-4 h-4 text-blue-400 shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <!-- Tech Badges & Action -->
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
                class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-400 hover:text-white transition-colors cursor-pointer"
              >
                Konsultasikan Layanan Ini
                <ChevronRight class="w-4 h-4" />
              </button>
            </div>
          </div>

          <!-- Bento Item 2: AI & LLM Automation (Span 4 Cols) -->
          <div 
            v-if="services[1]"
            class="md:col-span-4 rounded-3xl p-8 sm:p-10 bg-white/[0.02] hover:bg-white/[0.04] border border-white/[0.08] hover:border-blue-500/50 hover:shadow-[0_0_35px_rgba(0,82,255,0.15)] transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-6">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono px-3 py-1 rounded-full bg-blue-500/10 text-sky-400 border border-blue-500/20">
                  {{ services[1].tagline || 'Intelligent System' }}
                </span>
                <component :is="getServiceIcon(services[1].icon)" class="w-6 h-6 text-slate-400 group-hover:text-blue-400 transition-colors" />
              </div>

              <div class="space-y-2">
                <h3 class="text-2xl font-bold text-white tracking-tight">
                  {{ services[1].title }}
                </h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                  {{ services[1].description }}
                </p>
              </div>

              <div class="space-y-2.5 pt-4 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (services[1].features || []).slice(0, 3)" 
                  :key="idx"
                  class="flex items-start gap-2 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-3.5 h-3.5 text-blue-400 shrink-0 mt-0.5" />
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
                class="text-xs font-bold text-sky-400 hover:text-white cursor-pointer"
              >
                Pilih
              </button>
            </div>
          </div>

          <!-- Bento Item 3, 4, 5 (Span 4 Cols Each di Baris Kedua) -->
          <div 
            v-for="service in services.slice(2)" 
            :key="service.id"
            class="md:col-span-4 rounded-3xl p-8 bg-white/[0.02] hover:bg-white/[0.04] border border-white/[0.08] hover:border-blue-500/50 hover:shadow-[0_0_35px_rgba(0,82,255,0.15)] transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400">
                  {{ service.tagline || 'Spesialisasi' }}
                </span>
                <component :is="getServiceIcon(service.icon)" class="w-5 h-5 text-slate-400 group-hover:text-blue-400 transition-colors" />
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
                  <CheckCircle2 class="w-3.5 h-3.5 text-blue-400 shrink-0 mt-0.5" />
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
                class="text-xs font-bold text-sky-400 hover:text-white cursor-pointer"
              >
                Diskusi
              </button>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- CASE STUDIES (IMPACT-DRIVEN ASYMMETRIC PORTFOLIO) -->
    <section id="case-studies" class="py-28 md:py-36 px-6 sm:px-8 border-b border-white/[0.06] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
            STUDI KASUS PRODUKSI
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
            Rekayasa Berbasis Dampak Bisnis
          </h2>
          <p class="text-base text-slate-400 leading-relaxed">
            Hasil rekayasa nyata yang memecahkan masalah kompleks dan mencetak metrik performa positif bagi mitra kami.
          </p>
        </div>

        <!-- Flagship Case Study (Large Horizontal Hero Card) -->
        <div 
          v-if="featuredPortfolio"
          class="rounded-3xl bg-white/[0.02] border border-white/[0.08] hover:border-blue-500/50 hover:shadow-[0_0_35px_rgba(0,82,255,0.15)] overflow-hidden transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 group"
        >
          <!-- Mockup Visual -->
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
            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-transparent via-[#090A0E]/30 to-[#090A0E]"></div>

            <div class="absolute top-6 left-6">
              <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#090A0E]/85 border border-blue-500/30 text-sky-300 text-xs font-mono font-semibold backdrop-blur-md shadow-lg">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                {{ featuredPortfolio.impact_metric }}
              </span>
            </div>
          </div>

          <!-- Editorial Case Study Content -->
          <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
              <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                <span>{{ featuredPortfolio.client_name }}</span>
                <span>{{ featuredPortfolio.industry }}</span>
              </div>

              <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight leading-snug">
                {{ featuredPortfolio.title }}
              </h3>

              <div class="space-y-4 pt-2">
                <div class="space-y-1">
                  <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-rose-400">
                    Kendala Awal
                  </span>
                  <p class="text-xs text-slate-300 leading-relaxed">
                    {{ featuredPortfolio.problem }}
                  </p>
                </div>
                <div class="space-y-1 pt-2 border-t border-white/[0.06]">
                  <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-blue-400">
                    Solusi SOLKIT
                  </span>
                  <p class="text-xs text-slate-300 leading-relaxed">
                    {{ featuredPortfolio.solution }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Tech Badges & Link -->
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
                title="Tinjau Proyek"
              >
                <ExternalLink class="w-4 h-4" />
              </a>
            </div>
          </div>
        </div>

        <!-- 2-Column Grid Remaining Portfolios -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div 
            v-for="item in remainingPortfolios" 
            :key="item.id"
            class="rounded-3xl bg-white/[0.02] border border-white/[0.08] hover:border-blue-500/50 hover:shadow-[0_0_35px_rgba(0,82,255,0.15)] overflow-hidden transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="relative h-60 w-full overflow-hidden bg-slate-900">
              <img 
                v-if="item.thumbnail_url" 
                :src="item.thumbnail_url" 
                :alt="item.title"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-85"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#090A0E] via-transparent to-transparent"></div>
              
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#090A0E]/85 border border-blue-500/30 text-sky-300 text-xs font-mono font-semibold backdrop-blur-md">
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

    <!-- TECH STACK SHOWCASE -->
    <section id="tech-stack" class="py-28 md:py-36 px-6 sm:px-8 border-b border-white/[0.06] bg-white/[0.01] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
            {{ techSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
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
            class="p-6 rounded-2xl bg-white/[0.02] hover:bg-white/[0.04] border border-white/[0.06] hover:border-blue-500/30 transition-all duration-300 space-y-3"
          >
            <span class="text-[11px] font-mono font-semibold text-sky-400 block">
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

    <!-- AGILE WORKFLOW METODOLOGI -->
    <section id="workflow" class="py-28 md:py-36 px-6 sm:px-8 border-b border-white/[0.06] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
            {{ workflowSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
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
            class="p-8 rounded-3xl bg-white/[0.02] border border-white/[0.06] hover:border-blue-500/30 transition-all duration-300 flex flex-col justify-between space-y-6"
          >
            <div class="text-3xl font-black font-mono text-blue-500/60">
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

    <!-- LATEST ENGINEERING ARTICLES & INSIGHTS (Google AdSense High-Value Content Hub) -->
    <section id="insights" class="py-28 md:py-36 px-6 sm:px-8 border-b border-white/[0.06] bg-[#07080B] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div class="max-w-2xl space-y-3">
            <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
              PUBLIKASI & RISET TEKNOLOGI
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
              Insight & Panduan Rekayasa Terbaru
            </h2>
            <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
              Studi kasus pemecahan masalah teknis nyata, optimasi performa backend/frontend, arsitektur cloud, dan panduan rekayasa sistem enterprise.
            </p>
          </div>
          <Link 
            :href="route('blog.index')"
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 text-white text-xs font-bold transition-all shrink-0 group shadow-lg"
          >
            Lihat Semua Publikasi
            <ArrowRight class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>

        <div v-if="posts && posts.length" class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <article 
            v-for="post in posts.slice(0, 3)" 
            :key="post.id"
            class="p-7 rounded-3xl bg-white/[0.02] border border-white/[0.06] hover:border-blue-500/40 hover:bg-white/[0.03] transition-all duration-300 flex flex-col justify-between space-y-6 group"
          >
            <div class="space-y-4">
              <div class="flex items-center justify-between text-xs font-mono text-slate-500">
                <span class="px-2.5 py-1 rounded bg-white/[0.04] text-sky-400 font-semibold border border-white/[0.06]">
                  {{ post.category?.name || 'Teknologi' }}
                </span>
                <span class="text-[11px]">
                  {{ new Date(post.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}
                </span>
              </div>

              <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-sky-300 transition-colors line-clamp-2 leading-snug">
                <Link :href="route('blog.show', post.slug)">
                  {{ post.title }}
                </Link>
              </h3>

              <p class="text-xs text-slate-400 leading-relaxed line-clamp-3">
                {{ post.content ? post.content.replace(/<[^>]*>/g, '').substring(0, 140) + '...' : '' }}
              </p>
            </div>

            <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between text-xs text-slate-400">
              <span class="text-[11px] font-mono text-slate-500">Oleh Hasan Arofid</span>
              <Link 
                :href="route('blog.show', post.slug)"
                class="text-sky-400 hover:text-white font-bold flex items-center gap-1 font-mono text-xs transition-colors"
              >
                Baca Panduan <ArrowRight class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
              </Link>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimonials" class="py-28 md:py-36 px-6 sm:px-8 border-b border-white/[0.06] bg-white/[0.01] relative">
      <div class="max-w-7xl mx-auto space-y-16">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
            {{ testimonialsSection.badge }}
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
            {{ testimonialsSection.title }}
          </h2>
        </div>

        <!-- Client Brands Trust Grid -->
        <div v-if="testimonialsSection.client_brands && testimonialsSection.client_brands.length" class="space-y-4 pt-2">
          <p class="text-xs font-mono font-semibold uppercase tracking-widest text-slate-400">
            Dipercaya Oleh Para Mitra & Klien Strategis:
          </p>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
            <div 
              v-for="(brand, bIdx) in testimonialsSection.client_brands" 
              :key="bIdx"
              class="px-5 py-4 rounded-2xl bg-white/[0.02] border border-white/[0.06] hover:border-blue-500/40 hover:bg-white/[0.04] flex items-center justify-center text-center transition-all duration-300 group"
            >
              <span class="text-xs sm:text-sm font-semibold text-slate-300 group-hover:text-white transition-colors tracking-tight">
                {{ brand }}
              </span>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
          <div 
            v-for="(item, idx) in testimonialsSection.items" 
            :key="idx"
            class="p-8 rounded-3xl bg-white/[0.02] border border-white/[0.06] hover:border-blue-500/30 hover:bg-white/[0.03] transition-all duration-300 flex flex-col justify-between space-y-6"
          >
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed italic">
              "{{ item.comment }}"
            </p>
            <div class="pt-6 border-t border-white/[0.06] flex items-center gap-4">
              <div 
                class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-sm shrink-0"
                :style="{ backgroundColor: primaryColor }"
              >
                {{ item.name.charAt(0) }}
              </div>
              <div>
                <h4 class="text-sm font-bold text-white">{{ item.name }}</h4>
                <p class="text-xs text-slate-400">{{ item.role }} · <span class="text-sky-400">{{ item.company }}</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DIRECT ENGAGEMENT (EXECUTIVE CTA) -->
    <section class="py-28 md:py-36 px-6 sm:px-8 relative">
      <div class="max-w-4xl mx-auto p-10 sm:p-14 rounded-3xl bg-white/[0.02] border border-white/10 backdrop-blur-xl text-center space-y-8 relative overflow-hidden">
        <div 
          class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full blur-[120px] pointer-events-none opacity-25"
          :style="{ backgroundColor: primaryColor }"
        ></div>

        <div class="space-y-4 relative z-10 max-w-2xl mx-auto">
          <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
            Siap Merekayasa Solusi Digital Anda?
          </h2>
          <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
            Diskusikan langsung dengan Tech Lead SOLKIT. Dapatkan analisis arsitektur, estimasi timeline, dan rekomendasi stack tanpa biaya awal.
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
          <button
            @click="isConsultModalOpen = true"
            :style="{ backgroundColor: primaryColor }"
            class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-bold text-white shadow-[0_0_25px_rgba(0,82,255,0.4)] hover:brightness-110 transition-all cursor-pointer"
          >
            Jadwalkan Konsultasi Teknis
          </button>

          <a
            :href="whatsappUrl"
            target="_blank"
            class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-bold text-slate-300 bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 hover:border-emerald-500/40 transition-colors flex items-center justify-center gap-2"
          >
            <Phone class="w-4 h-4 text-emerald-400" />
            WhatsApp Tech Lead
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER BERSIH & PRESISI -->
    <footer class="py-16 border-t border-white/[0.06] bg-[#07080B] text-slate-400 text-xs">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="space-y-4 md:col-span-2">
          <!-- Logo Footer Resmi SOLKIT -->
          <div class="flex items-center gap-3">
            <img 
              :src="settings.site_logo_url || '/images/solkit-dark.svg'" 
              alt="SOLKIT - Solusi Kode Kita" 
              class="h-9 w-auto max-w-[180px] object-contain"
              @error="$event.target.src = '/images/solkit-dark.svg'"
            />
          </div>
          <p class="text-xs text-slate-400 max-w-sm leading-relaxed">
            {{ settings.site_description || 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak untuk aplikasi web kustom, sistem mobile, dan otomatisasi AI berskala enterprise.' }}
          </p>
          <p class="text-xxs text-slate-500 font-mono">
            © {{ new Date().getFullYear() }} SOLKIT (Solusi Kode Kita). Seluruh hak cipta dilindungi.
          </p>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Hubungi Kami</h4>
          <p class="text-slate-400">{{ settings.contact_email || 'partner@solkit.tech' }}</p>
          <p class="text-slate-400">+{{ settings.whatsapp_number || '6281234567890' }}</p>
          <p class="text-slate-500 text-xxs leading-relaxed">{{ settings.company_address || 'Equity Tower SCBD Jakarta Selatan, Indonesia' }}</p>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Publikasi & Insight</h4>
          <ul class="space-y-2">
            <li><Link :href="route('blog.index')" class="hover:text-white transition-colors flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-sky-400"></span>Blog & Panduan</Link></li>
            <li><a href="#case-studies" class="hover:text-white transition-colors">Studi Kasus</a></li>
            <li><a href="#services" class="hover:text-white transition-colors">Layanan Rekayasa</a></li>
            <li><a href="#tech-stack" class="hover:text-white transition-colors">Stack Teknologi</a></li>
          </ul>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Legalitas & Kepatuhan</h4>
          <ul class="space-y-2">
            <li><Link href="/privacy-policy" class="hover:text-white transition-colors">Kebijakan Privasi</Link></li>
            <li><Link href="/terms-of-service" class="hover:text-white transition-colors">Syarat & Ketentuan</Link></li>
            <li><Link :href="route('blog.index')" class="hover:text-white transition-colors">Standar Kualitas E-E-A-T</Link></li>
            <li><Link :href="route('login')" class="hover:text-white transition-colors">Portal Akses Staf</Link></li>
          </ul>
        </div>
      </div>
    </footer>

    <!-- CONSULTATION MODAL -->
    <div 
      v-if="isConsultModalOpen" 
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
    >
      <div class="relative w-full max-w-xl bg-[#0C0E15] border border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl">
        <button 
          @click="isConsultModalOpen = false"
          class="absolute top-6 right-6 p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/[0.04] transition-colors cursor-pointer"
        >
          <X class="w-5 h-5" />
        </button>

        <div class="space-y-2 mb-6">
          <span class="text-xs font-mono uppercase tracking-widest text-sky-400 font-bold">
            SOLKIT CONSULTATION // 1-ON-1
          </span>
          <h3 class="text-2xl font-bold text-white tracking-tight">
            Diskusikan Kebutuhan Software Anda
          </h3>
          <p class="text-xs text-slate-400 leading-relaxed">
            Formulir ini akan langsung ditinjau oleh analis teknis SOLKIT dalam 1x24 jam kerja.
          </p>
        </div>

        <div v-if="isFormSuccess" class="p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
          <CheckCircle2 class="w-6 h-6 shrink-0" />
          <div class="text-xs space-y-0.5">
            <p class="font-bold">Permintaan Berhasil Terkirim</p>
            <p>Terima kasih. Tim engineering SOLKIT akan segera menghubungi kontak yang Anda cantumkan.</p>
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
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                required
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Email Bisnis *</label>
              <input
                v-model="consultForm.email"
                type="email"
                placeholder="nama@perusahaan.com"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                required
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Nomor WhatsApp *</label>
              <input
                v-model="consultForm.phone"
                type="text"
                placeholder="0812xxxxxxx"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Perusahaan / Startup</label>
              <input
                v-model="consultForm.company"
                type="text"
                placeholder="PT Solusi Digital"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Fokus Kebutuhan</label>
              <select
                v-model="consultForm.service_interest"
                class="w-full bg-slate-900 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500"
              >
                <option value="Custom Web & Enterprise SaaS">Custom Web & Enterprise SaaS</option>
                <option value="Mobile App (iOS/Android)">Mobile App (iOS/Android)</option>
                <option value="AI Integration & Automation">AI Integration & Automation</option>
                <option value="Cloud Infrastructure & DevOps">Cloud Infrastructure & DevOps</option>
                <option value="UI/UX Product Design">UI/UX Product Design</option>
              </select>
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Estimasi Budget</label>
              <select
                v-model="consultForm.budget_range"
                class="w-full bg-slate-900 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500"
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
              placeholder="Ceritakan gambaran sistem, fitur utama, atau bottleneck yang ingin diselesaikan..."
              class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
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
              class="px-6 py-2.5 rounded-xl text-xs font-bold text-white shadow-md hover:brightness-110 transition-all cursor-pointer disabled:opacity-50"
            >
              Kirim Spesifikasi
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
