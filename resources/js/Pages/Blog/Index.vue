<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { 
  Search, 
  Clock, 
  ArrowRight, 
  Calendar, 
  BookOpen, 
  ArrowLeft,
  Share2,
  Tag
} from '@lucide/vue';

const props = defineProps({
  settings: {
    type: Object,
    required: true
  },
  posts: {
    type: Object,
    required: true
  },
  categories: {
    type: Array,
    default: () => []
  },
  featuredPost: {
    type: Object,
    default: null
  },
  filters: {
    type: Object,
    default: () => ({})
  }
});

const searchQuery = ref(props.filters.q || '');

const handleSearch = () => {
  router.get(route('blog.index'), {
    q: searchQuery.value,
    category: props.filters.category
  }, {
    preserveState: true,
    replace: true
  });
};

const filterByCategory = (categorySlug) => {
  router.get(route('blog.index'), {
    category: categorySlug === props.filters.category ? null : categorySlug,
    q: searchQuery.value
  }, {
    preserveState: true
  });
};

const formatDate = (dateString) => {
  if (!dateString) return '';
  return new Date(dateString).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'short',
    year: 'numeric'
  });
};

const calculateReadingTime = (content) => {
  if (!content) return 3;
  const words = content.replace(/<[^>]*>/g, '').split(/\s+/).length;
  return Math.max(1, Math.ceil(words / 200));
};

const stripTags = (html, length = 140) => {
  if (!html) return '';
  const text = html.replace(/<[^>]*>/g, '').trim();
  return text.length > length ? text.substring(0, length) + '...' : text;
};
</script>

<template>
  <Head :title="'Engineering Blog & Knowledge Base | ' + (settings.site_name || 'SOLKIT')">
    <meta name="description" content="Kumpulan panduan teknis mendalam, studi kasus arsitektur perangkat lunak, optimasi database, dan strategi cloud engineering dari tim SOLKIT." />
    <meta name="keywords" :content="'blog teknis, tutorial laravel, arsitektur software, optimasi web, software house surabaya, ' + (settings.meta_keywords || '')" />
  </Head>

  <div class="min-h-screen bg-[#090A0E] text-slate-100 font-sans selection:bg-[#0052FF] selection:text-white relative">
    <!-- Ambient Glows -->
    <div class="absolute top-0 right-1/4 w-[600px] h-[600px] rounded-full blur-[180px] pointer-events-none opacity-20 bg-[#0052FF]"></div>
    <div class="absolute top-[40%] -left-36 w-[500px] h-[500px] rounded-full blur-[180px] pointer-events-none opacity-15 bg-[#0052FF]"></div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-[#090A0E]/80 backdrop-blur-xl border-b border-white/[0.08]">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-3">
          <img 
            :src="settings.site_logo_url || '/images/solkit-dark.svg'" 
            alt="SOLKIT" 
            class="h-10 w-auto object-contain"
            @error="$event.target.src = '/images/solkit-dark.svg'"
          />
        </Link>
        <div class="flex items-center gap-6">
          <Link href="/" class="text-xs font-semibold text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
            <ArrowLeft class="w-3.5 h-3.5" />
            Kembali ke Beranda
          </Link>
          <a 
            :href="'https://wa.me/' + (settings.whatsapp_number || '6281234567890')" 
            target="_blank"
            class="px-4 py-2 rounded-xl bg-[#0052FF] hover:bg-blue-600 text-white text-xs font-bold transition-all shadow-[0_0_20px_rgba(0,82,255,0.3)] hidden sm:inline-flex"
          >
            Konsultasi Proyek
          </a>
        </div>
      </div>
    </header>

    <!-- HERO HEADER -->
    <section class="pt-16 pb-12 px-6 sm:px-8 border-b border-white/[0.06] relative">
      <div class="max-w-5xl mx-auto text-center space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/[0.03] border border-white/10 text-sky-400 text-xs font-mono">
          <BookOpen class="w-3.5 h-3.5" />
          SOLKIT ENGINEERING ARTICLES & RESEARCH
        </div>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
          Arsitektur, Kode & <span class="bg-gradient-to-r from-blue-400 to-sky-300 bg-clip-text text-transparent">Insight Teknologi</span>
        </h1>
        <p class="text-sm sm:text-base text-slate-400 max-w-2xl mx-auto leading-relaxed">
          Studi kasus pemecahan masalah teknis nyata, optimasi performa backend/frontend, arsitektur cloud, dan panduan rekayasa sistem enterprise.
        </p>

        <!-- Search Bar -->
        <div class="max-w-xl mx-auto pt-4">
          <form @submit.prevent="handleSearch" class="relative">
            <input 
              v-model="searchQuery" 
              type="text" 
              placeholder="Cari artikel, topik, atau kata kunci..." 
              class="w-full px-5 py-3.5 pl-12 rounded-2xl bg-white/[0.03] border border-white/10 focus:border-blue-500 text-sm text-white placeholder-slate-500 focus:outline-none transition-all"
            />
            <Search class="w-4 h-4 text-slate-500 absolute left-4 top-1/2 -translate-y-1/2" />
          </form>
        </div>

        <!-- Category Chips -->
        <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
          <button 
            @click="filterByCategory(null)" 
            :class="[
              !filters.category ? 'bg-[#0052FF] text-white border-transparent' : 'bg-white/[0.02] text-slate-400 border-white/[0.08] hover:text-white',
              'px-3.5 py-1.5 rounded-xl text-xs font-medium border transition-all'
            ]"
          >
            Semua Topik
          </button>
          <button 
            v-for="cat in categories" 
            :key="cat.id"
            @click="filterByCategory(cat.slug)"
            :class="[
              filters.category === cat.slug ? 'bg-[#0052FF] text-white border-transparent' : 'bg-white/[0.02] text-slate-400 border-white/[0.08] hover:text-white',
              'px-3.5 py-1.5 rounded-xl text-xs font-medium border transition-all flex items-center gap-1.5'
            ]"
          >
            {{ cat.name }}
            <span class="text-[10px] opacity-60">({{ cat.posts_count }})</span>
          </button>
        </div>
      </div>
    </section>

    <!-- CONTENT BODY -->
    <main class="max-w-7xl mx-auto px-6 sm:px-8 py-16 space-y-16">
      
      <!-- FEATURED POST HERO (jika ada dan tidak sedang search) -->
      <div v-if="featuredPost && !filters.q && !filters.category" class="relative group">
        <Link 
          :href="route('blog.show', featuredPost.slug)"
          class="block p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-white/[0.04] to-white/[0.01] border border-white/[0.08] hover:border-blue-500/40 transition-all duration-300 relative overflow-hidden"
        >
          <div class="max-w-3xl space-y-5">
            <div class="flex items-center gap-3 text-xs font-mono">
              <span class="px-2.5 py-1 rounded-md bg-blue-500/20 text-sky-400 font-semibold border border-blue-500/30">
                ⭐ FEATURED DEEP-DIVE
              </span>
              <span class="text-slate-500">·</span>
              <span class="text-slate-400">{{ featuredPost.category?.name || 'Teknologi' }}</span>
              <span class="text-slate-500">·</span>
              <span class="text-slate-400 flex items-center gap-1">
                <Clock class="w-3 h-3" /> {{ calculateReadingTime(featuredPost.content) }} menit baca
              </span>
            </div>

            <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight group-hover:text-sky-300 transition-colors">
              {{ featuredPost.title }}
            </h2>

            <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
              {{ stripTags(featuredPost.content, 220) }}
            </p>

            <div class="pt-2 flex items-center gap-2 text-sky-400 text-xs font-bold font-mono group-hover:translate-x-1 transition-transform">
              BACA PANDUAN LENGKAP <ArrowRight class="w-3.5 h-3.5" />
            </div>
          </div>
        </Link>
      </div>

      <!-- ARTICLES GRID -->
      <div class="space-y-8">
        <div class="flex items-center justify-between">
          <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight flex items-center gap-2">
            <Tag class="w-5 h-5 text-sky-400" />
            Semua Publikasi & Artikel Teknis
          </h2>
          <span class="text-xs font-mono text-slate-500">
            Total: {{ posts.total }} artikel
          </span>
        </div>

        <div v-if="posts.data && posts.data.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article 
            v-for="post in posts.data" 
            :key="post.id"
            class="p-7 rounded-3xl bg-white/[0.02] border border-white/[0.06] hover:border-blue-500/40 hover:bg-white/[0.03] transition-all duration-300 flex flex-col justify-between space-y-6 group"
          >
            <div class="space-y-4">
              <div class="flex items-center justify-between text-xs font-mono text-slate-500">
                <span class="px-2 py-0.5 rounded bg-white/[0.04] text-sky-400 font-semibold border border-white/[0.06]">
                  {{ post.category?.name || 'Teknologi' }}
                </span>
                <span class="flex items-center gap-1">
                  <Clock class="w-3 h-3" /> {{ calculateReadingTime(post.content) }} mnt
                </span>
              </div>

              <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-sky-300 transition-colors line-clamp-2 leading-snug">
                <Link :href="route('blog.show', post.slug)">
                  {{ post.title }}
                </Link>
              </h3>

              <p class="text-xs text-slate-400 leading-relaxed line-clamp-3">
                {{ stripTags(post.content, 150) }}
              </p>
            </div>

            <div class="pt-4 border-t border-white/[0.06] flex items-center justify-between text-xs text-slate-400">
              <span class="flex items-center gap-1 text-[11px] font-mono">
                <Calendar class="w-3 h-3 text-slate-500" />
                {{ formatDate(post.created_at) }}
              </span>
              <Link 
                :href="route('blog.show', post.slug)"
                class="text-sky-400 hover:text-white font-bold flex items-center gap-1 font-mono text-xs transition-colors"
              >
                Baca <ArrowRight class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
              </Link>
            </div>
          </article>
        </div>

        <div v-else class="text-center py-20 p-8 rounded-3xl bg-white/[0.01] border border-white/[0.06] space-y-4">
          <BookOpen class="w-12 h-12 text-slate-600 mx-auto" />
          <h3 class="text-lg font-bold text-white">Tidak ada artikel ditemukan</h3>
          <p class="text-xs text-slate-400">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
        </div>

        <!-- PAGINATION -->
        <div v-if="posts.links && posts.links.length > 3" class="flex justify-center items-center gap-2 pt-8">
          <Link 
            v-for="(link, lIdx) in posts.links" 
            :key="lIdx"
            :href="link.url || '#'"
            v-html="link.label"
            :class="[
              link.active ? 'bg-[#0052FF] text-white font-bold border-transparent' : 'bg-white/[0.02] text-slate-400 border-white/[0.06] hover:text-white',
              !link.url ? 'opacity-30 cursor-not-allowed' : 'cursor-pointer',
              'px-4 py-2 rounded-xl text-xs border transition-all'
            ]"
          />
        </div>
      </div>

    </main>

    <!-- FOOTER -->
    <footer class="py-12 border-t border-white/[0.06] bg-[#07080B] text-slate-400 text-xs">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-3">
          <img :src="settings.site_logo_url || '/images/solkit-dark.svg'" alt="SOLKIT" class="h-7 w-auto" />
          <span class="text-slate-500">·</span>
          <span>© {{ new Date().getFullYear() }} SOLKIT (Solusi Kode Kita).</span>
        </div>
        <div class="flex items-center gap-6 text-xs">
          <Link href="/privacy-policy" class="hover:text-white transition-colors">Privacy Policy</Link>
          <Link href="/terms-of-service" class="hover:text-white transition-colors">Terms of Service</Link>
          <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
        </div>
      </div>
    </footer>
  </div>
</template>
