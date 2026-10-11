<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import FloatingWhatsApp from '@/Components/FloatingWhatsApp.vue';
import { 
  ArrowUpRight, 
  ArrowRight,
  BookOpen,
  CheckCircle2, 
  Check,
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
  Menu,
  Phone,
  Mail,
  MapPin,
  Terminal,
  Activity,
  ShieldCheck,
  Server,
  Zap,
  Layers,
  Database,
  Sparkles,
  Sliders,
  Network
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

// Primary Brand Color: Solkit Royal Electric Blue (#0052FF) from logo right-wing
const primaryColor = computed(() => props.settings.primary_color || '#0052FF');

// Modal State & Mobile Navigation State
const isConsultModalOpen = ref(false);
const isMobileMenuOpen = ref(false);

// Helper for dynamic section content from DB
const getSection = (key) => {
  if (!props.page || !props.page.sections) return null;
  return props.page.sections.find(s => s.key === key && s.is_active);
};

const heroSection = computed(() => getSection('hero')?.content || {
  badge: 'Kapasitas Proyek Q4 Tersedia',
  headline: 'Rekayasa Perangkat Lunak Presisi Tinggi untuk Sistem Kritis',
  subheadline: 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak enterprise. Kami merancang arsitektur cloud berdaya tahan tinggi, aplikasi web performa ekstrem, dan sistem mobile tanpa kompromi.',
  cta_primary: 'Konsultasi Arsitektur',
  cta_secondary: 'Eksplorasi Studi Kasus',
  stats: [
    { label: 'Proyek Skala Produksi', value: '45+' },
    { label: 'Rata-rata SLA Uptime', value: '99.98%' },
    { label: 'Throughput Transaksi/Hari', value: '1.2M+' },
    { label: 'Retensi Kemitraan Klien', value: '98%' }
  ]
});

// Interactive Hero Architecture Sandbox Data (Replacing generic fake terminal)
const activeArchTab = ref('web');
const architectureTabs = [
  { id: 'web', label: 'Web & SaaS Enterprise', badge: 'High-Concurrency' },
  { id: 'mobile', label: 'Mobile System', badge: 'Offline-First' },
  { id: 'ai', label: 'Enterprise AI & RAG', badge: 'Autonomous' },
  { id: 'cloud', label: 'Cloud Infrastructure', badge: 'Zero-Downtime' }
];

const architectureDetails = computed(() => {
  switch (activeArchTab.value) {
    case 'mobile':
      return {
        title: 'Arsitektur Mobile Fluid Multi-Platform',
        description: 'Engine lintas platform dengan sinkronisasi offline-first, native bridges 60fps, dan isolasi cache lokal.',
        stack: ['Flutter Core', 'Kotlin Native', 'SQLite / Isar', 'Biometric Auth', 'Push Broker'],
        flow: [
          { step: 'Device Client', note: 'Touch Response <16ms' },
          { step: 'Local DB & Sync', note: 'Conflict-Free Replicated' },
          { step: 'Edge Gateway', note: 'Mutual TLS (mTLS)' },
          { step: 'Core Backend', note: 'Realtime WebSocket' }
        ],
        metrics: [
          { label: 'Frame Rate', value: '60 FPS', status: 'Lancar' },
          { label: 'Offline Resiliency', value: '100%', status: 'Aktif' },
          { label: 'Crash-Free Rate', value: '99.94%', status: 'Enterprise' }
        ],
        codeSnippet: `// Solkit Offline-First Synchronization Engine
final syncEngine = SolkitSyncPipeline(
  conflictResolver: TimestampPriorityResolver(),
  transport: SecureWebSocketTransport(pinCertificates: true),
  storage: EncryptedLocalStorage(cipher: AES256GCM())
);
await syncEngine.drainQueueWithBackoff();`
      };
    case 'ai':
      return {
        title: 'Orkestrasi Dokumen & Autonomous AI RAG',
        description: 'Integrasi LLM aman untuk query data korporat internal dengan vector database dan mitigasi halusinasi berlapis.',
        stack: ['Python FastAPI', 'Vector DB (Pgvector)', 'Hybrid Semantic Search', 'Agent Workers', 'Telemetry'],
        flow: [
          { step: 'Enterprise Raw Data', note: 'Chunking & Metadata' },
          { step: 'Dense Embeddings', note: 'High-Dimensional Vector' },
          { step: 'Reranker & Filter', note: 'Cosine Top-K + BM25' },
          { step: 'Audited Synthesis', note: 'Strict Guardrails' }
        ],
        metrics: [
          { label: 'Retrieval Latency', value: '<85 ms', status: 'Teroptimasi' },
          { label: 'Halusinasi Mitigation', value: '99.4%', status: 'Guardrail Aktif' },
          { label: 'Data Privacy', value: 'On-Prem / VPC', status: 'Terisolasi' }
        ],
        codeSnippet: `// RAG Guardrail & Verified Retrieval Pipeline
async def retrieve_verified_context(query: str, tenant_id: str):
    embeddings = await vector_engine.embed_query(query)
    docs = await pgvector_store.similarity_search(embeddings, top_k=5, tenant=tenant_id)
    return guardrail_evaluator.filter_grounded(docs, min_confidence=0.92)`
      };
    case 'cloud':
      return {
        title: 'Infrastruktur Cloud Terisolasi & Auto-Scaling',
        description: 'Cluster containerized dengan load balancer multi-zona, rollback otomatis dalam 10 detik, dan zero-downtime deployment.',
        stack: ['Docker', 'Kubernetes Mesh', 'Terraform IaC', 'Redis Cluster', 'Prometheus & Grafana'],
        flow: [
          { step: 'Global CDN / DNS', note: 'DDoS Shield & Anycast' },
          { step: 'Ingress Controller', note: 'SSL Termination' },
          { step: 'Pod Orchestration', note: 'HPA Autoscaling' },
          { step: 'Database Sharding', note: 'Read Replica Pool' }
        ],
        metrics: [
          { label: 'Deployment Downtime', value: '0 Detik', status: 'Rolling Blue-Green' },
          { label: 'Mean Time to Recover', value: '< 2 Menit', status: 'Automated' },
          { label: 'Ingress Bandwidth', value: '10 Gbps+', status: 'Burst Ready' }
        ],
        codeSnippet: `// Zero-Downtime Deployment Spec
apiVersion: apps/v1
kind: Deployment
metadata:
  name: solkit-core-engine
spec:
  strategy:
    type: RollingUpdate
    rollingUpdate:
      maxSurge: 25%
      maxUnavailable: 0`
      };
    case 'web':
    default:
      return {
        title: 'Arsitektur Web Monolith Modular & High-Throughput',
        description: 'Stack Laravel 11 modern digabung Vue 3 Inertia, relasional database teroptimasi, dan asynchronous queue berkinerja tinggi.',
        stack: ['Laravel 11 Engine', 'Vue 3 & Inertia', 'PostgreSQL 16', 'Redis Cache Tier', 'Tailwind CSS'],
        flow: [
          { step: 'Client Browser', note: 'Single-Page Reactivity' },
          { step: 'Inertia Gateway', note: 'Zero REST Boilerplate' },
          { step: 'Job Queue Workers', note: '10k+ Tasks/Menit' },
          { step: 'Relational Database', note: 'Indexed & Query Tuned' }
        ],
        metrics: [
          { label: 'Edge TTFB', value: '< 42 ms', status: 'Ultra Cepat' },
          { label: 'Concurrent Capacity', value: '50k+ Req/s', status: 'Scale Ready' },
          { label: 'Security Score', value: 'A+ Grade', status: 'OWASP Verified' }
        ],
        codeSnippet: `// High-Throughput Transaction Pipeline
public function processEnterpriseTransaction(OrderPayload $payload): Result
{
    return DB::transaction(fn() => $this->pipeline
        ->send($payload)
        ->through([ValidateInventory::class, ReserveFunds::class, DispatchEvents::class])
        ->then(fn($tx) => Result::success($tx))
    );
}`
      };
  }
});

// Interactive Scope & Project Cost Estimator (Directly inspired by crafted UI references)
const estimatorService = ref('web');
const estimatorTimeline = ref('standard');
const estimatorModules = ref(['auth', 'payment']);

const toggleModule = (modId) => {
  if (estimatorModules.value.includes(modId)) {
    estimatorModules.value = estimatorModules.value.filter(id => id !== modId);
  } else {
    estimatorModules.value.push(modId);
  }
};

const estimationResult = computed(() => {
  let baseWeeks = 6;
  let baseMin = 40;
  let baseMax = 70;

  if (estimatorService.value === 'mobile') {
    baseWeeks = 8;
    baseMin = 60;
    baseMax = 110;
  } else if (estimatorService.value === 'ai') {
    baseWeeks = 7;
    baseMin = 50;
    baseMax = 100;
  } else if (estimatorService.value === 'enterprise') {
    baseWeeks = 10;
    baseMin = 90;
    baseMax = 180;
  }

  // Timeline modifier
  if (estimatorTimeline.value === 'express') {
    baseWeeks = Math.max(4, Math.round(baseWeeks * 0.75));
    baseMin = Math.round(baseMin * 1.25);
    baseMax = Math.round(baseMax * 1.3);
  } else if (estimatorTimeline.value === 'enterprise') {
    baseWeeks = Math.round(baseWeeks * 1.4);
    baseMin = Math.round(baseMin * 1.35);
    baseMax = Math.round(baseMax * 1.5);
  }

  // Module addition
  const moduleAdd = estimatorModules.value.length * 8;
  baseMin += moduleAdd;
  baseMax += Math.round(moduleAdd * 1.5);

  let squad = '1 Principal Architect + 2 Full-Stack Engineers + 1 QA';
  if (estimatorService.value === 'mobile') {
    squad = '1 Tech Lead + 2 Mobile Engineers + 1 Backend Engineer + 1 UI/UX';
  } else if (estimatorService.value === 'ai') {
    squad = '1 AI Architect + 1 Data/LLM Engineer + 1 Full-Stack + 1 DevOps';
  } else if (estimatorService.value === 'enterprise') {
    squad = '1 Lead Architect + 3 Core Engineers + 1 DevOps + 1 Dedicated QA';
  }

  return {
    weeks: `${baseWeeks} - ${baseWeeks + 3} Minggu`,
    budget: `Rp ${baseMin} - ${baseMax} Juta`,
    squad: squad
  };
});

const applyEstimationToConsult = () => {
  const serviceLabels = {
    web: 'Custom Web & Enterprise SaaS',
    mobile: 'Mobile App (iOS & Android)',
    ai: 'AI Integration & Automation',
    enterprise: 'Custom Web & Enterprise SaaS'
  };

  consultForm.service_interest = serviceLabels[estimatorService.value] || 'Custom Web & Enterprise SaaS';
  consultForm.budget_range = estimationResult.value.budget;
  consultForm.message = `Kebutuhan Sistem: ${serviceLabels[estimatorService.value]}\nEstimasi Timeline: ${estimationResult.value.weeks}\nModul Tambahan: ${estimatorModules.value.join(', ')}\nEstimasi Budget: ${estimationResult.value.budget}`;
  isConsultModalOpen.value = true;
};

// Services filter tab state
const activeServiceFilter = ref('all');
const filteredServices = computed(() => {
  if (activeServiceFilter.value === 'all') return props.services;
  return props.services.filter(s => {
    const title = s.title.toLowerCase();
    const tag = (s.tagline || '').toLowerCase();
    if (activeServiceFilter.value === 'web') return title.includes('web') || title.includes('saas') || tag.includes('web');
    if (activeServiceFilter.value === 'mobile') return title.includes('mobile') || title.includes('app') || tag.includes('mobile');
    if (activeServiceFilter.value === 'ai') return title.includes('ai') || title.includes('otomatisasi') || tag.includes('ai') || title.includes('cloud');
    return true;
  });
});

// Portfolios Filter Tab
const activePortfolioFilter = ref('all');
const filteredPortfolios = computed(() => {
  if (activePortfolioFilter.value === 'all') return props.portfolios;
  return props.portfolios.filter(p => {
    const ind = (p.industry || '').toLowerCase();
    const title = p.title.toLowerCase();
    if (activePortfolioFilter.value === 'finance') return ind.includes('fintech') || ind.includes('keuangan') || title.includes('fin');
    if (activePortfolioFilter.value === 'logistics') return ind.includes('logistik') || ind.includes('supply') || title.includes('kargo');
    if (activePortfolioFilter.value === 'saas') return ind.includes('saas') || ind.includes('erp') || title.includes('saas');
    return true;
  });
});

const featuredPortfolio = computed(() => {
  return filteredPortfolios.value.find(p => p.is_featured) || filteredPortfolios.value[0];
});

const remainingPortfolios = computed(() => {
  if (!featuredPortfolio.value) return filteredPortfolios.value;
  return filteredPortfolios.value.filter(p => p.id !== featuredPortfolio.value.id);
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
  const number = props.settings.whatsapp_number || '628814959247';
  const cleanNumber = number.replace(/[^0-9]/g, '');
  const text = encodeURIComponent(`Halo Tim SOLKIT (Solusi Kode Kita), saya ingin mendiskusikan kebutuhan arsitektur software untuk proyek kami.`);
  return `https://wa.me/${cleanNumber}?text=${text}`;
});

// Structured Data
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
        'description': props.settings.site_description || 'Studio rekayasa perangkat lunak modern berbasis di Surabaya, Jawa Timur.',
        'telephone': props.settings.whatsapp_number ? `+${props.settings.whatsapp_number}` : '+628814959247',
        'email': props.settings.contact_email || 'partner@solkit.tech',
        'priceRange': '$$',
        'address': {
          '@type': 'PostalAddress',
          'streetAddress': props.settings.company_address || 'Surabaya, Jawa Timur, Indonesia',
          'addressLocality': 'Surabaya',
          'addressRegion': 'Jawa Timur',
          'postalCode': '60111',
          'addressCountry': 'ID'
        }
      }
    ]
  });
});
</script>

<template>
  <Head :title="page?.title || settings.meta_title || 'SOLKIT (Solusi Kode Kita) | Studio Rekayasa Perangkat Lunak Surabaya'">
    <meta name="description" :content="page?.meta_description || settings.meta_description || 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak enterprise di Surabaya untuk pembuatan custom web application, sistem mobile, dan cloud architecture.'" />
    <meta name="keywords" :content="settings.meta_keywords || 'software house surabaya, jasa pembuatan aplikasi surabaya, custom software indonesia, solkit, solusi kode kita'" />
    <meta name="author" content="SOLKIT (Solusi Kode Kita)" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://solkit.tech" />
    <component :is="'script'" type="application/ld+json" v-html="structuredDataJson" />
  </Head>

  <!-- ROOT CONTAINER: Deep Obsidian Black Canvas (#07080E) with Solkit Cobalt & Sky Accents -->
  <div 
    class="min-h-screen bg-[#07080E] text-slate-100 font-sans selection:bg-[#0052FF] selection:text-white relative overflow-hidden"
    :style="{ '--solkit-blue': primaryColor }"
  >
    <!-- Hairline Structural Grid Texture (Engineered Precision, Not Fuzzy AI Blobs) -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:40px_40px] pointer-events-none"></div>

    <!-- Directional Architectural Ambient Beam (Subtle, purposeful lighting) -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[450px] bg-[radial-gradient(ellipse_80%_60%_at_50%_0%,rgba(0,82,255,0.18),transparent_70%)] pointer-events-none"></div>

    <!-- STICKY GLASSMORPHIC NAVIGATION BAR -->
    <header class="sticky top-0 z-50 bg-[#07080E]/90 backdrop-blur-xl border-b border-white/[0.08] transition-all">
      <div class="max-w-7xl mx-auto px-5 sm:px-8 h-20 flex items-center justify-between">
        
        <!-- Logo Resmi SOLKIT (Selaras Presisi dengan solkit-logo.jpeg) -->
        <Link href="/" class="flex items-center gap-3 group py-1.5 cursor-pointer">
          <div class="h-10 w-auto flex items-center">
            <img 
              src="/images/solkit-dark.svg" 
              alt="SOLKIT - Solusi Kode Kita" 
              class="h-9 sm:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-[1.02]"
            />
          </div>
        </Link>

        <!-- Navigation Links (Desktop) -->
        <nav class="hidden md:flex items-center gap-8 text-[12px] font-semibold tracking-wide text-slate-300">
          <a href="#services" class="hover:text-white transition-colors py-1 relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-[2px] hover:after:bg-[#0052FF]">
            Layanan
          </a>
          <a href="#architecture" class="hover:text-white transition-colors py-1 relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-[2px] hover:after:bg-[#0052FF]">
            Arsitektur
          </a>
          <a href="#estimator" class="hover:text-white transition-colors py-1 relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-[2px] hover:after:bg-[#0052FF]">
            Estimator
          </a>
          <a href="#case-studies" class="hover:text-white transition-colors py-1 relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-[2px] hover:after:bg-[#0052FF]">
            Studi Kasus
          </a>
          <a href="#workflow" class="hover:text-white transition-colors py-1 relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-[2px] hover:after:bg-[#0052FF]">
            Metodologi
          </a>
          <Link :href="route('blog.index')" class="text-sky-400 hover:text-white transition-colors font-bold">
            Blog
          </Link>
        </nav>

        <!-- Header Actions -->
        <div class="flex items-center gap-2.5 sm:gap-3.5">
          <button
            @click="isConsultModalOpen = true"
            class="relative inline-flex items-center gap-1.5 sm:gap-2 px-3.5 sm:px-5 py-2 sm:py-2.5 text-xs font-bold text-white rounded-xl bg-[#0052FF] hover:bg-[#1A62FF] active:scale-95 shadow-[0_0_24px_rgba(0,82,255,0.45),inset_0_1px_0_rgba(255,255,255,0.2)] transition-all duration-200 cursor-pointer"
          >
            <span class="hidden sm:inline">Konsultasi Teknis</span>
            <span class="sm:hidden">Konsultasi</span>
            <ChevronRight class="w-3.5 h-3.5" />
          </button>

          <Link 
            v-if="user" 
            :href="route('admin.dashboard')" 
            class="hidden sm:inline-flex text-xs font-semibold text-slate-300 hover:text-white px-3.5 py-2 rounded-xl bg-white/[0.04] border border-white/10 hover:border-white/20 transition-all"
          >
            Admin
          </Link>

          <!-- Mobile Hamburger Toggle Button -->
          <button
            @click="isMobileMenuOpen = !isMobileMenuOpen"
            aria-label="Buka Menu Navigasi"
            class="md:hidden p-2 rounded-xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/10 text-slate-300 hover:text-white transition-colors cursor-pointer"
          >
            <X v-if="isMobileMenuOpen" class="w-5 h-5 text-white" />
            <Menu v-else class="w-5 h-5 text-white" />
          </button>
        </div>
      </div>

      <!-- Mobile Dropdown Navigation Menu -->
      <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 -translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 -translate-y-2"
      >
        <div 
          v-if="isMobileMenuOpen" 
          class="md:hidden border-t border-white/[0.08] bg-[#0A0D18]/95 backdrop-blur-2xl px-5 py-6 space-y-4 shadow-2xl"
        >
          <div class="grid grid-cols-1 gap-1">
            <a 
              href="#services" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span>Layanan Rekayasa</span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </a>
            <a 
              href="#architecture" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span>Arsitektur Sandbox</span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </a>
            <a 
              href="#estimator" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-sky-400 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span class="flex items-center gap-2">
                <Sliders class="w-4 h-4" />
                Kalkulator Estimasi Proyek
              </span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </a>
            <a 
              href="#case-studies" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span>Studi Kasus Produksi</span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </a>
            <a 
              href="#workflow" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span>Metodologi Agile</span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </a>
            <Link 
              :href="route('blog.index')" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span class="flex items-center gap-2">
                <BookOpen class="w-4 h-4 text-sky-400" />
                Blog & Riset Teknologi
              </span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </Link>
            <Link 
              v-if="user" 
              :href="route('admin.dashboard')" 
              @click="isMobileMenuOpen = false"
              class="flex items-center justify-between p-3 rounded-xl text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/[0.05] transition-colors"
            >
              <span>Admin Panel</span>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </Link>
          </div>

          <!-- Quick Actions in Mobile Menu -->
          <div class="pt-4 border-t border-white/[0.08] flex flex-col gap-2.5">
            <button
              @click="isMobileMenuOpen = false; isConsultModalOpen = true"
              class="w-full py-3 px-4 rounded-xl text-xs font-bold text-white bg-[#0052FF] hover:bg-[#1A62FF] shadow-lg flex items-center justify-center gap-2 cursor-pointer"
            >
              Jadwalkan Konsultasi Teknis
              <ChevronRight class="w-4 h-4" />
            </button>
            <a
              :href="whatsappUrl"
              target="_blank"
              class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-slate-300 bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 flex items-center justify-center gap-2 text-center"
            >
              <Phone class="w-3.5 h-3.5 text-emerald-400" />
              WhatsApp Tech Lead
            </a>
          </div>
        </div>
      </transition>
    </header>

    <!-- HERO SECTION: Bold Editorial Asymmetry & Interactive Architecture Sandbox -->
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-28 px-5 sm:px-8 border-b border-white/[0.08]">
      <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
        
        <!-- Left: Authoritative Value Proposition & Direct Confidence -->
        <div class="lg:col-span-6 space-y-7 text-left">
          
          <!-- Engineered Status Badge -->
          <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/[0.04] border border-white/[0.12] backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-[#0052FF] shadow-[0_0_8px_#0052FF] animate-pulse"></span>
            <span class="text-xs font-mono font-medium text-slate-300 tracking-wide">
              {{ heroSection.badge }}
            </span>
          </div>

          <!-- Main Typography: Tight, Intentional, High Contrast -->
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.08]">
            Rekayasa Perangkat Lunak <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-[#0052FF] to-sky-300">Presisi Tinggi.</span>
          </h1>

          <!-- Crisp Subheadline -->
          <p class="text-base sm:text-lg text-slate-300/90 font-normal leading-relaxed max-w-xl">
            {{ heroSection.subheadline }}
          </p>

          <!-- Tactile Primary CTAs -->
          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-1">
            <button 
              @click="isConsultModalOpen = true"
              class="px-7 py-3.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#0052FF] hover:bg-[#1A62FF] active:scale-98 shadow-[0_0_28px_rgba(0,82,255,0.45),inset_0_1px_0_rgba(255,255,255,0.2)] transition-all flex items-center justify-center gap-2 group cursor-pointer"
            >
              {{ heroSection.cta_primary }}
              <ChevronRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
            </button>

            <a 
              href="#estimator"
              class="px-7 py-3.5 rounded-xl text-xs sm:text-sm font-bold text-slate-200 bg-white/[0.03] hover:bg-white/[0.07] border border-white/[0.12] hover:border-sky-400/40 active:scale-98 transition-all flex items-center justify-center gap-2"
            >
              <Sliders class="w-4 h-4 text-sky-400" />
              Hitung Estimasi Proyek
            </a>
          </div>

          <!-- Production SLA & Metrics Ribbon -->
          <div class="pt-7 border-t border-white/[0.08] grid grid-cols-2 sm:grid-cols-4 gap-5">
            <div v-for="(st, idx) in heroSection.stats" :key="idx" class="space-y-1">
              <div class="text-2xl sm:text-3xl font-black font-mono text-white tracking-tight" :style="{ color: idx === 0 ? '#38BDF8' : 'white' }">
                {{ st.value }}
              </div>
              <div class="text-[11px] text-slate-400 font-medium leading-snug">
                {{ st.label }}
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Interactive Architecture Sandbox (Replaces Generic Fake Terminal) -->
        <div id="architecture" class="lg:col-span-6 relative">
          <!-- Outer Precision Frame with Inset Glow -->
          <div class="relative rounded-2xl bg-[#0C101B] border border-white/[0.12] shadow-[0_20px_50px_rgba(0,0,0,0.6),inset_0_1px_0_rgba(255,255,255,0.08)] overflow-hidden">
            
            <!-- Sandbox Header Bar with Segmented Tactile Toggles (Inspired by toggles.colorion.co) -->
            <div class="p-4 sm:p-5 border-b border-white/[0.08] bg-[#0A0D17] flex flex-col gap-3">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                  <span class="text-xs font-mono font-semibold text-white tracking-wide">
                    SOLKIT ARCHITECTURE SANDBOX
                  </span>
                </div>
                <span class="text-[11px] font-mono text-sky-400 px-2.5 py-0.5 rounded bg-sky-500/10 border border-sky-500/20">
                  {{ architectureDetails.metrics[0].status }}
                </span>
              </div>

              <!-- Tactile Segmented Pill Toggles -->
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-1.5 p-1 rounded-xl bg-black/40 border border-white/[0.08]">
                <button
                  v-for="tab in architectureTabs"
                  :key="tab.id"
                  @click="activeArchTab = tab.id"
                  :class="[
                    'py-2 px-2.5 rounded-lg text-[11px] font-medium transition-all text-center cursor-pointer truncate',
                    activeArchTab === tab.id
                      ? 'bg-[#0052FF] text-white shadow-[0_0_12px_rgba(0,82,255,0.5)] font-bold'
                      : 'text-slate-400 hover:text-slate-200 hover:bg-white/[0.04]'
                  ]"
                >
                  {{ tab.label.split(' ')[0] }}
                </button>
              </div>
            </div>

            <!-- Sandbox Content Body -->
            <div class="p-5 sm:p-6 space-y-5">
              
              <!-- Tab Header & Description -->
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">
                    {{ architectureDetails.title }}
                  </h3>
                  <span class="text-xs font-mono text-slate-400">
                    SLA 99.98%
                  </span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                  {{ architectureDetails.description }}
                </p>
              </div>

              <!-- Interactive Architecture Pipeline Flow -->
              <div class="space-y-2">
                <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 font-bold block">
                  Alur Pipeline Arsitektur:
                </span>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                  <div 
                    v-for="(f, idx) in architectureDetails.flow" 
                    :key="idx"
                    class="p-2.5 rounded-xl bg-white/[0.02] border border-white/[0.06] space-y-1 relative group hover:border-[#0052FF]/50 transition-all"
                  >
                    <div class="flex items-center justify-between text-[11px] font-semibold text-white">
                      <span>{{ f.step }}</span>
                      <span class="text-[9px] font-mono text-sky-400">#0{{ idx + 1 }}</span>
                    </div>
                    <div class="text-[10px] text-slate-400 truncate">
                      {{ f.note }}
                    </div>
                  </div>
                </div>
              </div>

              <!-- Metrics Triad Strip -->
              <div class="grid grid-cols-3 gap-2.5 pt-2">
                <div 
                  v-for="(m, idx) in architectureDetails.metrics" 
                  :key="idx"
                  class="p-3 rounded-xl bg-black/30 border border-white/[0.06] space-y-0.5"
                >
                  <span class="text-[10px] text-slate-400 uppercase tracking-wider font-mono block">
                    {{ m.label }}
                  </span>
                  <div class="text-sm font-bold font-mono text-white">
                    {{ m.value }}
                  </div>
                </div>
              </div>

              <!-- Authentic Production Code Snippet (Syntax Clean) -->
              <div class="rounded-xl bg-[#07090F] border border-white/[0.08] p-3.5 space-y-1 font-mono text-[11px]">
                <div class="flex items-center justify-between pb-2 mb-1 border-b border-white/[0.06] text-[10px] text-slate-500">
                  <span>core-pipeline.spec</span>
                  <span class="text-emerald-400 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Verified
                  </span>
                </div>
                <pre class="text-slate-300 overflow-x-auto whitespace-pre leading-relaxed font-mono"><code>{{ architectureDetails.codeSnippet }}</code></pre>
              </div>

              <!-- Tech Stack Badges -->
              <div class="flex flex-wrap gap-1.5 pt-1">
                <span 
                  v-for="(st, idx) in architectureDetails.stack" 
                  :key="idx"
                  class="px-2.5 py-1 rounded-md bg-white/[0.03] text-slate-300 text-[11px] font-mono border border-white/[0.06]"
                >
                  {{ st }}
                </span>
              </div>
            </div>

            <!-- Sandbox Footer Action -->
            <div class="p-3.5 bg-[#090C15] border-t border-white/[0.08] flex items-center justify-between text-xs">
              <span class="text-slate-400 font-mono text-[11px]">
                Arsitektur teruji di skala produksi
              </span>
              <button 
                @click="consultForm.service_interest = architectureDetails.title; isConsultModalOpen = true"
                class="text-sky-400 hover:text-white font-bold inline-flex items-center gap-1 cursor-pointer"
              >
                Terapkan pada Proyek Anda
                <ChevronRight class="w-3.5 h-3.5" />
              </button>
            </div>

          </div>
        </div>

      </div>
    </section>

    <!-- INTERACTIVE PROJECT SCOPE & ESTIMATOR (Inspirasi Kuat dari Referensi Tactile UI/UX) -->
    <section id="estimator" class="py-24 md:py-32 px-5 sm:px-8 border-b border-white/[0.08] bg-[#0A0E18]/60 relative">
      <div class="max-w-7xl mx-auto space-y-14">
        
        <!-- Section Header -->
        <div class="max-w-2xl space-y-3">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-sky-400 text-xs font-mono font-semibold">
            <Sliders class="w-3.5 h-3.5" />
            KALKULATOR ESTIMASI PROYEK
          </div>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Transparansi Ruang Lingkup & Waktu Rilis
          </h2>
          <p class="text-sm text-slate-400 leading-relaxed">
            Eksplorasi parameter proyek Anda secara instan. Dapatkan rekomendasi alokasi tim rekayasa, rentang durasi sprint, dan estimasi investasi tanpa menunggu proposal berhari-hari.
          </p>
        </div>

        <!-- Interactive Control Matrix -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left Controls Column (8 Cols) -->
          <div class="lg:col-span-7 space-y-8 p-6 sm:p-8 rounded-2xl bg-[#0D121F] border border-white/[0.1] shadow-xl">
            
            <!-- 1. Tipe Solusi (Tactile Segmented Toggle) -->
            <div class="space-y-3">
              <label class="text-xs font-mono font-bold uppercase tracking-wider text-slate-300 block">
                1. Fokus Kebutuhan Sistem
              </label>
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                <button
                  type="button"
                  @click="estimatorService = 'web'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer space-y-1',
                    estimatorService === 'web'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.04]'
                  ]"
                >
                  <Code2 class="w-4 h-4 text-sky-400" />
                  <div class="text-xs font-bold text-white">Web & SaaS</div>
                  <div class="text-[10px] text-slate-400">Portal / Core Platform</div>
                </button>

                <button
                  type="button"
                  @click="estimatorService = 'mobile'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer space-y-1',
                    estimatorService === 'mobile'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.04]'
                  ]"
                >
                  <Smartphone class="w-4 h-4 text-sky-400" />
                  <div class="text-xs font-bold text-white">Mobile App</div>
                  <div class="text-[10px] text-slate-400">iOS & Android 60fps</div>
                </button>

                <button
                  type="button"
                  @click="estimatorService = 'ai'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer space-y-1',
                    estimatorService === 'ai'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.04]'
                  ]"
                >
                  <Cpu class="w-4 h-4 text-sky-400" />
                  <div class="text-xs font-bold text-white">AI & RAG</div>
                  <div class="text-[10px] text-slate-400">Otomatisasi Cerdas</div>
                </button>

                <button
                  type="button"
                  @click="estimatorService = 'enterprise'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer space-y-1',
                    estimatorService === 'enterprise'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.04]'
                  ]"
                >
                  <Cloud class="w-4 h-4 text-sky-400" />
                  <div class="text-xs font-bold text-white">Full Ecosystem</div>
                  <div class="text-[10px] text-slate-400">Web + Mobile + Cloud</div>
                </button>
              </div>
            </div>

            <!-- 2. Target Waktu Rilis (Pill Switcher) -->
            <div class="space-y-3">
              <label class="text-xs font-mono font-bold uppercase tracking-wider text-slate-300 block">
                2. Target Waktu Peluncuran (Delivery Pace)
              </label>
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                <button
                  type="button"
                  @click="estimatorTimeline = 'express'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer',
                    estimatorTimeline === 'express'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white'
                  ]"
                >
                  <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-white">Express MVP</span>
                    <span class="text-[10px] px-2 py-0.5 rounded bg-amber-500/10 text-amber-300 font-mono">Fast Track</span>
                  </div>
                  <p class="text-[11px] text-slate-400 mt-1">4 - 6 Minggu (Prioritas Rilis)</p>
                </button>

                <button
                  type="button"
                  @click="estimatorTimeline = 'standard'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer',
                    estimatorTimeline === 'standard'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white'
                  ]"
                >
                  <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-white">Standard Agile</span>
                    <span class="text-[10px] px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-300 font-mono">Disarankan</span>
                  </div>
                  <p class="text-[11px] text-slate-400 mt-1">8 - 12 Minggu (Siklus Matang)</p>
                </button>

                <button
                  type="button"
                  @click="estimatorTimeline = 'enterprise'"
                  :class="[
                    'p-3 rounded-xl border text-left transition-all cursor-pointer',
                    estimatorTimeline === 'enterprise'
                      ? 'bg-[#0052FF]/15 border-[#0052FF] text-white shadow-[0_0_15px_rgba(0,82,255,0.25)]'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:text-white'
                  ]"
                >
                  <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-white">Enterprise Roadmap</span>
                    <span class="text-[10px] px-2 py-0.5 rounded bg-purple-500/10 text-purple-300 font-mono">Multi-Sprint</span>
                  </div>
                  <p class="text-[11px] text-slate-400 mt-1">12+ Minggu (Arsitektur Rumit)</p>
                </button>
              </div>
            </div>

            <!-- 3. Modul Kebutuhan Tambahan (Toggle Checkboxes) -->
            <div class="space-y-3">
              <label class="text-xs font-mono font-bold uppercase tracking-wider text-slate-300 block">
                3. Modul Kritis Tambahan (Pilih yang relevan)
              </label>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                
                <div 
                  @click="toggleModule('auth')"
                  :class="[
                    'p-3 rounded-xl border flex items-center justify-between cursor-pointer transition-all',
                    estimatorModules.includes('auth')
                      ? 'bg-[#0052FF]/10 border-[#0052FF]/60 text-white'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:border-white/20'
                  ]"
                >
                  <div class="text-xs font-semibold">Multi-tenant & Role Permission (RBAC)</div>
                  <div :class="['w-5 h-5 rounded-md flex items-center justify-center border transition-colors', estimatorModules.includes('auth') ? 'bg-[#0052FF] border-[#0052FF] text-white' : 'border-white/20']">
                    <Check v-if="estimatorModules.includes('auth')" class="w-3.5 h-3.5" />
                  </div>
                </div>

                <div 
                  @click="toggleModule('payment')"
                  :class="[
                    'p-3 rounded-xl border flex items-center justify-between cursor-pointer transition-all',
                    estimatorModules.includes('payment')
                      ? 'bg-[#0052FF]/10 border-[#0052FF]/60 text-white'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:border-white/20'
                  ]"
                >
                  <div class="text-xs font-semibold">Payment Gateway (Midtrans / Xendit / QRIS)</div>
                  <div :class="['w-5 h-5 rounded-md flex items-center justify-center border transition-colors', estimatorModules.includes('payment') ? 'bg-[#0052FF] border-[#0052FF] text-white' : 'border-white/20']">
                    <Check v-if="estimatorModules.includes('payment')" class="w-3.5 h-3.5" />
                  </div>
                </div>

                <div 
                  @click="toggleModule('realtime')"
                  :class="[
                    'p-3 rounded-xl border flex items-center justify-between cursor-pointer transition-all',
                    estimatorModules.includes('realtime')
                      ? 'bg-[#0052FF]/10 border-[#0052FF]/60 text-white'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:border-white/20'
                  ]"
                >
                  <div class="text-xs font-semibold">Real-time WebSocket & Telemetri</div>
                  <div :class="['w-5 h-5 rounded-md flex items-center justify-center border transition-colors', estimatorModules.includes('realtime') ? 'bg-[#0052FF] border-[#0052FF] text-white' : 'border-white/20']">
                    <Check v-if="estimatorModules.includes('realtime')" class="w-3.5 h-3.5" />
                  </div>
                </div>

                <div 
                  @click="toggleModule('ai_module')"
                  :class="[
                    'p-3 rounded-xl border flex items-center justify-between cursor-pointer transition-all',
                    estimatorModules.includes('ai_module')
                      ? 'bg-[#0052FF]/10 border-[#0052FF]/60 text-white'
                      : 'bg-white/[0.02] border-white/[0.08] text-slate-400 hover:border-white/20'
                  ]"
                >
                  <div class="text-xs font-semibold">Integrasi AI / LLM Agent Otomatis</div>
                  <div :class="['w-5 h-5 rounded-md flex items-center justify-center border transition-colors', estimatorModules.includes('ai_module') ? 'bg-[#0052FF] border-[#0052FF] text-white' : 'border-white/20']">
                    <Check v-if="estimatorModules.includes('ai_module')" class="w-3.5 h-3.5" />
                  </div>
                </div>

              </div>
            </div>

          </div>

          <!-- Right Summary Card (5 Cols) -->
          <div class="lg:col-span-5 p-6 sm:p-8 rounded-2xl bg-[#0F1424] border border-white/[0.12] shadow-2xl space-y-6 sticky top-28">
            <div class="flex items-center justify-between pb-4 border-b border-white/[0.08]">
              <span class="text-xs font-mono font-bold text-sky-400 uppercase tracking-widest">
                HASIL ESTIMASI TEKNIS
              </span>
              <span class="text-xs font-mono text-slate-400">
                100% Bebas Biaya Awal
              </span>
            </div>

            <!-- Dynamic Numbers Display -->
            <div class="space-y-4">
              <div class="space-y-1">
                <span class="text-xs text-slate-400">Estimasi Durasi Sprint</span>
                <div class="text-2xl sm:text-3xl font-black font-mono text-white">
                  {{ estimationResult.weeks }}
                </div>
              </div>

              <div class="space-y-1 pt-3 border-t border-white/[0.06]">
                <span class="text-xs text-slate-400">Rentang Alokasi Anggaran</span>
                <div class="text-2xl sm:text-3xl font-black font-mono text-sky-400">
                  {{ estimationResult.budget }}
                </div>
              </div>

              <div class="space-y-1 pt-3 border-t border-white/[0.06]">
                <span class="text-xs text-slate-400">Rekomendasi Komposisi Squad</span>
                <p class="text-xs font-mono text-slate-300 leading-relaxed">
                  {{ estimationResult.squad }}
                </p>
              </div>
            </div>

            <!-- Direct Conversion CTA -->
            <div class="pt-4 space-y-3">
              <button
                @click="applyEstimationToConsult"
                class="w-full py-3.5 px-6 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#0052FF] hover:bg-[#1A62FF] active:scale-98 shadow-[0_0_24px_rgba(0,82,255,0.4)] transition-all cursor-pointer flex items-center justify-center gap-2"
              >
                Kirim Spesifikasi Ini ke Tech Lead
                <ArrowRight class="w-4 h-4" />
              </button>

              <p class="text-[11px] text-center text-slate-500 leading-snug">
                Data estimasi akan langsung dimasukkan ke form konsultasi untuk ditinjau oleh principal architect SOLKIT.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- SERVICES (CRAFTED BENTO GRID DENGAN FILTER SEGMENTED CONTROLS) -->
    <section id="services" class="py-24 md:py-32 px-5 sm:px-8 border-b border-white/[0.08] relative">
      <div class="max-w-7xl mx-auto space-y-14">
        
        <!-- Header & Segmented Filter Bar -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div class="max-w-2xl space-y-3">
            <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
              KAPABILITAS REKAYASA
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
              Solusi Software yang Dibangun untuk Bertahan
            </h2>
            <p class="text-sm text-slate-400 leading-relaxed">
              Arsitektur terstruktur tanpa utang teknis (clean code), menjamin aplikasi bisnis Anda tetap cepat dan mudah diperluas seiring pertumbuhan pengguna.
            </p>
          </div>

          <!-- Tactile Filter Pill (toggles.colorion.co inspiration) -->
          <div class="flex items-center gap-1 p-1 rounded-xl bg-white/[0.03] border border-white/[0.08] shrink-0 self-start md:self-auto">
            <button
              v-for="flt in [
                { id: 'all', label: 'Semua Layanan' },
                { id: 'web', label: 'Web & SaaS' },
                { id: 'mobile', label: 'Mobile Apps' },
                { id: 'ai', label: 'AI & Cloud' }
              ]"
              :key="flt.id"
              @click="activeServiceFilter = flt.id"
              :class="[
                'px-3 py-1.5 rounded-lg text-xs font-medium transition-all cursor-pointer',
                activeServiceFilter === flt.id
                  ? 'bg-[#0052FF] text-white shadow-md font-bold'
                  : 'text-slate-400 hover:text-white'
              ]"
            >
              {{ flt.label }}
            </button>
          </div>
        </div>

        <!-- Asymmetric Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
          
          <!-- Flagship Item 1 (Span 8 Cols) -->
          <div 
            v-if="filteredServices[0]"
            class="md:col-span-8 rounded-2xl p-8 sm:p-10 bg-[#0C101C] hover:bg-[#0E1324] border border-white/[0.08] hover:border-[#0052FF]/50 hover:shadow-[0_0_30px_rgba(0,82,255,0.15)] transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-6">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono px-3 py-1 rounded-full bg-blue-500/10 text-sky-300 border border-blue-500/20">
                  {{ filteredServices[0].tagline || 'Layanan Unggulan' }}
                </span>
                <component :is="getServiceIcon(filteredServices[0].icon)" class="w-6 h-6 text-slate-400 group-hover:text-sky-400 transition-colors" />
              </div>

              <div class="space-y-2 max-w-2xl">
                <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                  {{ filteredServices[0].title }}
                </h3>
                <p class="text-sm text-slate-300 leading-relaxed">
                  {{ filteredServices[0].description }}
                </p>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (filteredServices[0].features || [])" 
                  :key="idx"
                  class="flex items-start gap-2.5 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-4 h-4 text-[#0052FF] shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <div class="pt-8 mt-6 border-t border-white/[0.06] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div class="flex flex-wrap gap-1.5">
                <span 
                  v-for="(tech, idx) in (filteredServices[0].tech_stack || [])" 
                  :key="idx"
                  class="px-2.5 py-1 rounded bg-white/[0.03] text-slate-300 text-xs font-mono border border-white/[0.06]"
                >
                  {{ tech }}
                </span>
              </div>
              <button
                @click="consultForm.service_interest = filteredServices[0].title; isConsultModalOpen = true"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-400 hover:text-white transition-colors cursor-pointer"
              >
                Konsultasikan Layanan Ini
                <ChevronRight class="w-4 h-4" />
              </button>
            </div>
          </div>

          <!-- Secondary Item 2 (Span 4 Cols) -->
          <div 
            v-if="filteredServices[1]"
            class="md:col-span-4 rounded-2xl p-8 bg-[#0C101C] hover:bg-[#0E1324] border border-white/[0.08] hover:border-[#0052FF]/50 hover:shadow-[0_0_30px_rgba(0,82,255,0.15)] transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-6">
              <div class="flex items-center justify-between">
                <span class="text-xs font-mono px-3 py-1 rounded-full bg-blue-500/10 text-sky-300 border border-blue-500/20">
                  {{ filteredServices[1].tagline || 'Spesialisasi' }}
                </span>
                <component :is="getServiceIcon(filteredServices[1].icon)" class="w-6 h-6 text-slate-400 group-hover:text-sky-400 transition-colors" />
              </div>

              <div class="space-y-2">
                <h3 class="text-xl sm:text-2xl font-bold text-white tracking-tight">
                  {{ filteredServices[1].title }}
                </h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                  {{ filteredServices[1].description }}
                </p>
              </div>

              <div class="space-y-2.5 pt-4 border-t border-white/[0.06]">
                <div 
                  v-for="(feat, idx) in (filteredServices[1].features || []).slice(0, 3)" 
                  :key="idx"
                  class="flex items-start gap-2 text-xs text-slate-300"
                >
                  <CheckCircle2 class="w-3.5 h-3.5 text-[#0052FF] shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <div class="pt-6 mt-6 border-t border-white/[0.06] flex items-center justify-between">
              <button
                @click="consultForm.service_interest = filteredServices[1].title; isConsultModalOpen = true"
                class="text-xs font-bold text-sky-400 hover:text-white cursor-pointer"
              >
                Pilih Layanan Ini
              </button>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </div>
          </div>

          <!-- Remaining Services (Span 4 Cols Each) -->
          <div 
            v-for="service in filteredServices.slice(2)" 
            :key="service.id"
            class="md:col-span-4 rounded-2xl p-7 bg-[#0C101C] hover:bg-[#0E1324] border border-white/[0.08] hover:border-[#0052FF]/50 hover:shadow-[0_0_30px_rgba(0,82,255,0.15)] transition-all duration-300 flex flex-col justify-between group"
          >
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono text-slate-400">
                  {{ service.tagline || 'Engineering' }}
                </span>
                <component :is="getServiceIcon(service.icon)" class="w-5 h-5 text-slate-400 group-hover:text-sky-400 transition-colors" />
              </div>

              <h3 class="text-lg font-bold text-white tracking-tight">
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
                  <CheckCircle2 class="w-3.5 h-3.5 text-[#0052FF] shrink-0 mt-0.5" />
                  <span>{{ feat }}</span>
                </div>
              </div>
            </div>

            <div class="pt-5 mt-5 border-t border-white/[0.06] flex items-center justify-between">
              <button
                @click="consultForm.service_interest = service.title; isConsultModalOpen = true"
                class="text-xs font-bold text-sky-400 hover:text-white cursor-pointer"
              >
                Diskusi Teknis
              </button>
              <ChevronRight class="w-4 h-4 text-slate-500" />
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- CASE STUDIES (REAL BUSINESS IMPACT & CLEAN VISUAL SHOWCASES) -->
    <section id="case-studies" class="py-24 md:py-32 px-5 sm:px-8 border-b border-white/[0.08] relative">
      <div class="max-w-7xl mx-auto space-y-14">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div class="max-w-2xl space-y-3">
            <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
              REKAM JEJAK PRODUKSI
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
              Studi Kasus & Rekayasa Terukur
            </h2>
            <p class="text-sm text-slate-400 leading-relaxed">
              Bukan sekadar mockup fiktif. Inilah sistem nyata yang kami bangun dan operasikan untuk mendukung percepatan operasional klien.
            </p>
          </div>

          <!-- Category Segmented Filters -->
          <div class="flex items-center gap-1 p-1 rounded-xl bg-white/[0.03] border border-white/[0.08] shrink-0">
            <button
              v-for="flt in [
                { id: 'all', label: 'Semua Proyek' },
                { id: 'finance', label: 'Fintech & Payment' },
                { id: 'logistics', label: 'Logistik & IoT' },
                { id: 'saas', label: 'SaaS Platform' }
              ]"
              :key="flt.id"
              @click="activePortfolioFilter = flt.id"
              :class="[
                'px-3 py-1.5 rounded-lg text-xs font-medium transition-all cursor-pointer',
                activePortfolioFilter === flt.id
                  ? 'bg-[#0052FF] text-white font-bold shadow-md'
                  : 'text-slate-400 hover:text-white'
              ]"
            >
              {{ flt.label }}
            </button>
          </div>
        </div>

        <!-- Featured Case Study Card -->
        <div 
          v-if="featuredPortfolio"
          class="rounded-2xl bg-[#0C101D] border border-white/[0.08] hover:border-[#0052FF]/50 overflow-hidden transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 group shadow-xl"
        >
          <!-- Mockup Frame -->
          <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-auto overflow-hidden bg-slate-950">
            <img 
              v-if="featuredPortfolio.thumbnail_url" 
              :src="featuredPortfolio.thumbnail_url" 
              :alt="featuredPortfolio.title"
              class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-700 opacity-90"
            />
            <div v-else class="w-full h-full flex items-center justify-center bg-[#080B14] text-slate-700">
              <Code2 class="w-20 h-20" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-transparent via-[#0C101D]/40 to-[#0C101D]"></div>

            <div class="absolute top-5 left-5">
              <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#07080E]/90 border border-blue-500/30 text-sky-300 text-xs font-mono font-semibold backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-[#0052FF] animate-pulse"></span>
                {{ featuredPortfolio.impact_metric }}
              </span>
            </div>
          </div>

          <!-- Editorial Context -->
          <div class="lg:col-span-5 p-7 sm:p-9 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
              <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                <span>{{ featuredPortfolio.client_name }}</span>
                <span>{{ featuredPortfolio.industry }}</span>
              </div>

              <h3 class="text-2xl font-bold text-white tracking-tight leading-snug">
                {{ featuredPortfolio.title }}
              </h3>

              <div class="space-y-3 pt-2">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-rose-400">
                    Tantangan Awal
                  </span>
                  <p class="text-xs text-slate-300 leading-relaxed">
                    {{ featuredPortfolio.problem }}
                  </p>
                </div>
                <div class="space-y-1 pt-2 border-t border-white/[0.06]">
                  <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-sky-400">
                    Solusi Rekayasa SOLKIT
                  </span>
                  <p class="text-xs text-slate-300 leading-relaxed">
                    {{ featuredPortfolio.solution }}
                  </p>
                </div>
              </div>
            </div>

            <div class="pt-5 border-t border-white/[0.06] flex items-center justify-between">
              <div class="flex flex-wrap gap-1.5">
                <span 
                  v-for="(tech, idx) in (featuredPortfolio.tech_stack || []).slice(0, 4)" 
                  :key="idx"
                  class="px-2.5 py-1 rounded bg-white/[0.03] text-slate-300 text-[11px] font-mono border border-white/[0.06]"
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

        <!-- 2-Column Grid for Remaining Portfolios -->
        <div v-if="remainingPortfolios.length" class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div 
            v-for="item in remainingPortfolios" 
            :key="item.id"
            class="rounded-2xl bg-[#0C101D] border border-white/[0.08] hover:border-[#0052FF]/50 overflow-hidden transition-all duration-300 flex flex-col justify-between group shadow-lg"
          >
            <div class="relative h-56 w-full overflow-hidden bg-slate-950">
              <img 
                v-if="item.thumbnail_url" 
                :src="item.thumbnail_url" 
                :alt="item.title"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-85"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#0C101D] via-transparent to-transparent"></div>
              
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#07080E]/90 border border-blue-500/30 text-sky-300 text-xs font-mono font-semibold backdrop-blur-md">
                  {{ item.impact_metric }}
                </span>
              </div>
            </div>

            <div class="p-7 space-y-4 flex-1 flex flex-col justify-between">
              <div class="space-y-2.5">
                <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                  <span>{{ item.client_name }}</span>
                  <span>{{ item.industry }}</span>
                </div>
                <h3 class="text-xl font-bold text-white tracking-tight">
                  {{ item.title }}
                </h3>
                <p class="text-xs text-slate-300 leading-relaxed">
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

    <!-- METODOLOGI & WORKFLOW (STEP-BY-STEP RIGOR) -->
    <section id="workflow" class="py-24 md:py-32 px-5 sm:px-8 border-b border-white/[0.08] relative">
      <div class="max-w-7xl mx-auto space-y-14">
        <div class="max-w-2xl space-y-3">
          <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
            METODOLOGI KAMI
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Alur Kerja Rekayasa Berstandar Agensi Global
          </h2>
          <p class="text-sm text-slate-400 leading-relaxed">
            Transparansi penuh melalui sprint mingguan, automated testing, dan pelaporan progres yang terukur.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div 
            v-for="(step, idx) in [
              {
                num: '01',
                title: 'Discovery & System Blueprint',
                desc: 'Audit kebutuhan bisnis, model ancaman OWASP, penyusunan PRD, dan skema database relasional optimal.'
              },
              {
                num: '02',
                title: 'Tactile UI/UX & Prototyping',
                desc: 'Desain interface interaktif Figma dengan design system terstandarisasi, fokus pada konversi pengguna.'
              },
              {
                num: '03',
                title: 'Agile Sprint & Automated CI/CD',
                desc: 'Clean code teruji (TDD), bi-weekly sprint demo, dan code review ketat sebelum deploy ke staging.'
              },
              {
                num: '04',
                title: 'Security Audit & Zero-Downtime Launch',
                desc: 'Load stress test, penetrasi celah keamanan, setup telemetry server, serta pendampingan go-live 24/7.'
              }
            ]" 
            :key="idx"
            class="p-7 rounded-2xl bg-[#0C101C] border border-white/[0.08] hover:border-[#0052FF]/50 transition-all flex flex-col justify-between space-y-6"
          >
            <div class="text-3xl font-black font-mono text-[#0052FF]">
              {{ step.num }}
            </div>
            <div class="space-y-2">
              <h3 class="text-base font-bold text-white tracking-tight">
                {{ step.title }}
              </h3>
              <p class="text-xs text-slate-400 leading-relaxed">
                {{ step.desc }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PUBLIKASI & INSIGHTS (Google AdSense High-Value Content Hub) -->
    <section id="insights" class="py-24 md:py-32 px-5 sm:px-8 border-b border-white/[0.08] bg-[#07090F] relative">
      <div class="max-w-7xl mx-auto space-y-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div class="max-w-2xl space-y-3">
            <span class="text-xs font-mono font-bold tracking-widest uppercase text-sky-400">
              PUBLIKASI & RISET TEKNOLOGI
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
              Insight Rekayasa Software & Panduan
            </h2>
            <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
              Dokumentasi pemecahan masalah teknis, arsitektur backend/frontend, dan studi kasus sistem enterprise.
            </p>
          </div>
          <Link 
            :href="route('blog.index')"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 text-white text-xs font-bold transition-all shrink-0 group"
          >
            Lihat Semua Artikel
            <ArrowRight class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>

        <div v-if="posts && posts.length" class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <article 
            v-for="post in posts.slice(0, 3)" 
            :key="post.id"
            class="p-6 rounded-2xl bg-[#0C101C] border border-white/[0.08] hover:border-[#0052FF]/40 transition-all flex flex-col justify-between space-y-5 group"
          >
            <div class="space-y-3">
              <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                <span class="px-2 py-0.5 rounded bg-sky-500/10 text-sky-300 font-semibold border border-sky-500/20">
                  {{ post.category?.name || 'Teknologi' }}
                </span>
                <span class="text-[11px]">
                  {{ new Date(post.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}
                </span>
              </div>

              <h3 class="text-base font-bold text-white tracking-tight group-hover:text-sky-300 transition-colors line-clamp-2 leading-snug">
                <Link :href="route('blog.show', post.slug)">
                  {{ post.title }}
                </Link>
              </h3>

              <p class="text-xs text-slate-400 leading-relaxed line-clamp-3">
                {{ post.content ? post.content.replace(/<[^>]*>/g, '').substring(0, 130) + '...' : '' }}
              </p>
            </div>

            <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between text-xs text-slate-400">
              <span class="text-[11px] font-mono text-slate-500">Oleh Hasan Arofid</span>
              <Link 
                :href="route('blog.show', post.slug)"
                class="text-sky-400 hover:text-white font-bold flex items-center gap-1 font-mono text-xs transition-colors"
              >
                Baca Artikel <ArrowRight class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
              </Link>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- EXECUTIVE ENGAGEMENT CTA -->
    <section class="py-24 md:py-32 px-5 sm:px-8 relative">
      <div class="max-w-4xl mx-auto p-8 sm:p-12 rounded-2xl bg-[#0D1222] border border-white/[0.12] text-center space-y-7 relative overflow-hidden shadow-2xl">
        <div class="space-y-3 max-w-2xl mx-auto">
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Siap Merekayasa Solusi Digital Anda?
          </h2>
          <p class="text-sm text-slate-300 leading-relaxed">
            Diskusikan langsung dengan Tech Lead SOLKIT. Dapatkan analisis arsitektur, estimasi timeline, dan rekomendasi stack tanpa biaya awal.
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 pt-2">
          <button
            @click="isConsultModalOpen = true"
            class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#0052FF] hover:bg-[#1A62FF] shadow-[0_0_24px_rgba(0,82,255,0.4)] transition-all cursor-pointer"
          >
            Jadwalkan Konsultasi Teknis
          </button>

          <a
            :href="whatsappUrl"
            target="_blank"
            class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-xs sm:text-sm font-bold text-slate-200 bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 hover:border-emerald-500/40 transition-colors flex items-center justify-center gap-2"
          >
            <Phone class="w-4 h-4 text-emerald-400" />
            WhatsApp Tech Lead
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER RESMI SOLKIT -->
    <footer class="py-16 border-t border-white/[0.08] bg-[#07080E] text-slate-400 text-xs">
      <div class="max-w-7xl mx-auto px-5 sm:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
        
        <div class="space-y-4 md:col-span-2">
          <div class="flex items-center gap-3">
            <img 
              src="/images/solkit-dark.svg" 
              alt="SOLKIT - Solusi Kode Kita" 
              class="h-9 w-auto max-w-[180px] object-contain"
            />
          </div>
          <p class="text-xs text-slate-400 max-w-sm leading-relaxed">
            {{ settings.site_description || 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak untuk aplikasi web kustom, sistem mobile, dan cloud architecture enterprise.' }}
          </p>
          <p class="text-[11px] text-slate-500 font-mono">
            © {{ new Date().getFullYear() }} SOLKIT (Solusi Kode Kita). Seluruh hak cipta dilindungi.
          </p>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Hubungi Kami</h4>
          <p class="text-slate-300">{{ settings.contact_email || 'partner@solkit.tech' }}</p>
          <p class="text-slate-300">+{{ settings.whatsapp_number || '628814959247' }}</p>
          <p class="text-slate-500 text-[11px] leading-relaxed">{{ settings.company_address || 'Surabaya, Jawa Timur, Indonesia' }}</p>
        </div>

        <div class="space-y-3">
          <h4 class="text-xs font-bold uppercase tracking-wider text-white">Navigasi Cepat</h4>
          <ul class="space-y-2">
            <li><Link :href="route('blog.index')" class="hover:text-white transition-colors flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>Blog & Riset</Link></li>
            <li><a href="#estimator" class="hover:text-white transition-colors">Kalkulator Estimasi</a></li>
            <li><a href="#case-studies" class="hover:text-white transition-colors">Studi Kasus</a></li>
            <li><Link href="/privacy-policy" class="hover:text-white transition-colors">Kebijakan Privasi</Link></li>
            <li><Link href="/terms-of-service" class="hover:text-white transition-colors">Syarat & Ketentuan</Link></li>
          </ul>
        </div>

      </div>
    </footer>

    <!-- CONSULTATION MODAL -->
    <div 
      v-if="isConsultModalOpen" 
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
    >
      <div class="relative w-full max-w-xl bg-[#0C101D] border border-white/[0.12] rounded-2xl p-6 sm:p-8 shadow-2xl">
        <button 
          @click="isConsultModalOpen = false"
          class="absolute top-5 right-5 p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/[0.04] transition-colors cursor-pointer"
        >
          <X class="w-5 h-5" />
        </button>

        <div class="space-y-1.5 mb-6">
          <span class="text-xs font-mono uppercase tracking-widest text-sky-400 font-bold">
            SOLKIT CONSULTATION // 1-ON-1
          </span>
          <h3 class="text-2xl font-bold text-white tracking-tight">
            Diskusikan Kebutuhan Software Anda
          </h3>
          <p class="text-xs text-slate-400 leading-relaxed">
            Formulir ini langsung ditinjau oleh principal engineer SOLKIT dalam 1x24 jam kerja.
          </p>
        </div>

        <div v-if="isFormSuccess" class="p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
          <CheckCircle2 class="w-6 h-6 shrink-0" />
          <div class="text-xs space-y-0.5">
            <p class="font-bold">Permintaan Berhasil Terkirim</p>
            <p>Terima kasih! Tim engineering SOLKIT akan segera menghubungi kontak yang Anda cantumkan.</p>
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
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#0052FF]"
                required
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Email Bisnis *</label>
              <input
                v-model="consultForm.email"
                type="email"
                placeholder="nama@perusahaan.com"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#0052FF]"
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
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#0052FF]"
              />
            </div>
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Perusahaan / Startup</label>
              <input
                v-model="consultForm.company"
                type="text"
                placeholder="PT Solusi Digital"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#0052FF]"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
              <label class="block text-xs font-medium text-slate-300">Fokus Kebutuhan</label>
              <select
                v-model="consultForm.service_interest"
                class="w-full bg-[#070A12] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-[#0052FF]"
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
              <input
                v-model="consultForm.budget_range"
                type="text"
                placeholder="Contoh: Rp 50 - 150 Juta"
                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#0052FF]"
              />
            </div>
          </div>

          <div class="space-y-1">
            <label class="block text-xs font-medium text-slate-300">Deskripsi Tantangan / Kebutuhan *</label>
            <textarea
              v-model="consultForm.message"
              rows="3"
              placeholder="Ceritakan gambaran sistem, fitur utama, atau kendala performa yang ingin diselesaikan..."
              class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#0052FF]"
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
              class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-[#0052FF] hover:bg-[#1A62FF] shadow-md transition-all cursor-pointer disabled:opacity-50"
            >
              Kirim Spesifikasi
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- FLOATING WHATSAPP WIDGET -->
    <FloatingWhatsApp :phone-number="settings.whatsapp_number || '628814959247'" />
  </div>
</template>
