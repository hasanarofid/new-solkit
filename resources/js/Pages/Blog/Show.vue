<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import FloatingWhatsApp from '@/Components/FloatingWhatsApp.vue';
import { 
  ArrowLeft, 
  Calendar, 
  Clock, 
  User, 
  Share2, 
  BookOpen, 
  ArrowRight,
  ShieldCheck,
  CheckCircle2
} from '@lucide/vue';

const props = defineProps({
  settings: {
    type: Object,
    required: true
  },
  post: {
    type: Object,
    required: true
  },
  relatedPosts: {
    type: Array,
    default: () => []
  }
});

const formatDate = (dateString) => {
  if (!dateString) return '';
  return new Date(dateString).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
};

const calculateReadingTime = (content) => {
  if (!content) return 3;
  const words = content.replace(/<[^>]*>/g, '').split(/\s+/).length;
  return Math.max(1, Math.ceil(words / 200));
};

const cleanExcerpt = computed(() => {
  const text = props.post.content ? props.post.content.replace(/<[^>]*>/g, '').trim() : '';
  return text.length > 160 ? text.substring(0, 157) + '...' : text;
});

// Structured Data (Schema.org / JSON-LD TechArticle & BreadcrumbList) for Google
const schemaArticleJson = computed(() => {
  return JSON.stringify({
    '@context': 'https://schema.org',
    '@graph': [
      {
        '@type': 'TechArticle',
        '@id': `https://solkit.tech/blog/${props.post.slug}#article`,
        'isPartOf': {
          '@type': 'WebSite',
          '@id': 'https://solkit.tech/#website',
          'name': 'SOLKIT Tech Engineering'
        },
        'headline': props.post.title,
        'description': cleanExcerpt.value,
        'datePublished': props.post.created_at,
        'dateModified': props.post.updated_at || props.post.created_at,
        'author': {
          '@type': 'Person',
          'name': 'Hasan Arofid',
          'jobTitle': 'Lead Software Architect',
          'worksFor': {
            '@type': 'Organization',
            'name': 'SOLKIT (Solusi Kode Kita)'
          },
          'sameAs': [
            'https://github.com/hasanarofid',
            'https://hasanarofid.site'
          ]
        },
        'publisher': {
          '@type': 'Organization',
          'name': 'SOLKIT (Solusi Kode Kita)',
          'logo': {
            '@type': 'ImageObject',
            'url': 'https://solkit.tech/images/solkit-dark.svg'
          }
        },
        'mainEntityOfPage': `https://solkit.tech/blog/${props.post.slug}`
      },
      {
        '@type': 'BreadcrumbList',
        'itemListElement': [
          {
            '@type': 'ListItem',
            'position': 1,
            'name': 'Beranda',
            'item': 'https://solkit.tech'
          },
          {
            '@type': 'ListItem',
            'position': 2,
            'name': 'Blog & Insight',
            'item': 'https://solkit.tech/blog'
          },
          {
            '@type': 'ListItem',
            'position': 3,
            'name': props.post.title,
            'item': `https://solkit.tech/blog/${props.post.slug}`
          }
        ]
      }
    ]
  });
});

const shareArticle = () => {
  if (navigator.share) {
    navigator.share({
      title: props.post.title,
      url: window.location.href
    }).catch(() => {});
  } else {
    navigator.clipboard.writeText(window.location.href);
    alert('Tautan artikel berhasil disalin!');
  }
};
</script>

<template>
  <Head :title="post.title + ' | Engineering Blog SOLKIT'">
    <meta name="description" :content="cleanExcerpt" />
    <meta name="author" content="Hasan Arofid (Lead Architect SOLKIT)" />
    <meta property="og:title" :content="post.title" />
    <meta property="og:description" :content="cleanExcerpt" />
    <meta property="og:type" content="article" />
    <meta property="og:url" :content="'https://solkit.tech/blog/' + post.slug" />
    <meta property="og:image" :content="post.image_url ? (post.image_url.startsWith('http') ? post.image_url : 'https://solkit.tech' + post.image_url) : 'https://solkit.tech/images/og-share.jpg'" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="post.title" />
    <meta name="twitter:description" :content="cleanExcerpt" />
    <meta name="twitter:image" :content="post.image_url ? (post.image_url.startsWith('http') ? post.image_url : 'https://solkit.tech' + post.image_url) : 'https://solkit.tech/images/og-share.jpg'" />
    <link rel="canonical" :href="'https://solkit.tech/blog/' + post.slug" />
    <component :is="'script'" type="application/ld+json" v-html="schemaArticleJson" />
  </Head>

  <div class="min-h-screen bg-[#090A0E] text-slate-100 font-sans selection:bg-[#0052FF] selection:text-white relative">
    <!-- Ambient Glows -->
    <div class="absolute top-0 right-1/3 w-[600px] h-[600px] rounded-full blur-[180px] pointer-events-none opacity-15 bg-[#0052FF]"></div>

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
          <Link :href="route('blog.index')" class="text-xs font-semibold text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
            <ArrowLeft class="w-3.5 h-3.5" />
            Daftar Artikel
          </Link>
          <a 
            :href="'https://wa.me/' + (settings.whatsapp_number || '6281234567890')" 
            target="_blank"
            class="px-4 py-2 rounded-xl bg-[#0052FF] hover:bg-blue-600 text-white text-xs font-bold transition-all hidden sm:inline-flex"
          >
            Konsultasi Teknis
          </a>
        </div>
      </div>
    </header>

    <!-- ARTICLE HEADER -->
    <div class="pt-14 pb-10 px-6 sm:px-8 border-b border-white/[0.06]">
      <div class="max-w-4xl mx-auto space-y-6">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-mono text-slate-400">
          <Link href="/" class="hover:text-white transition-colors">Home</Link>
          <span>/</span>
          <Link :href="route('blog.index')" class="hover:text-white transition-colors">Blog</Link>
          <span>/</span>
          <span class="text-sky-400 truncate max-w-[200px]">{{ post.category?.name || 'Teknologi' }}</span>
        </nav>

        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
          {{ post.title }}
        </h1>

        <!-- Metadata Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-white/[0.06] text-xs font-mono text-slate-400">
          <div class="flex flex-wrap items-center gap-4">
            <span class="flex items-center gap-1.5 text-white font-medium">
              <User class="w-3.5 h-3.5 text-sky-400" /> Hasan Arofid
            </span>
            <span>·</span>
            <span class="flex items-center gap-1.5">
              <Calendar class="w-3.5 h-3.5 text-slate-500" /> {{ formatDate(post.created_at) }}
            </span>
            <span>·</span>
            <span class="flex items-center gap-1.5 text-sky-300">
              <Clock class="w-3.5 h-3.5 text-sky-400" /> {{ calculateReadingTime(post.content) }} menit baca
            </span>
          </div>
          <button 
            @click="shareArticle" 
            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.03] hover:bg-white/[0.08] text-slate-300 transition-colors"
          >
            <Share2 class="w-3.5 h-3.5" /> Bagikan
          </button>
        </div>
      </div>
    </div>

    <!-- MAIN BODY -->
    <div class="max-w-4xl mx-auto px-6 sm:px-8 py-14 space-y-14">
      
      <!-- In-Article AdSense Banner Placeholder -->
      <div class="my-6 p-4 rounded-2xl bg-white/[0.01] border border-white/[0.05] text-center">
        <!-- Google AdSense Container -->
        <ins class="adsbygoogle block"
             style="display:block; text-align:center;"
             data-ad-layout="in-article"
             data-ad-format="fluid"
             data-ad-client="ca-pub-7190047001129861"
             data-ad-slot="default"></ins>
      </div>

      <!-- RICH ARTICLE CONTENT -->
      <article 
        class="text-slate-300 leading-relaxed text-sm sm:text-base space-y-6
               [&>h2]:text-2xl [&>h2]:sm:text-3xl [&>h2]:font-extrabold [&>h2]:text-white [&>h2]:tracking-tight [&>h2]:pt-8 [&>h2]:pb-2 [&>h2]:border-b [&>h2]:border-white/[0.08]
               [&>h3]:text-lg [&>h3]:sm:text-xl [&>h3]:font-bold [&>h3]:text-sky-300 [&>h3]:pt-4 [&>h3]:pb-1
               [&>p]:text-slate-300 [&>p]:leading-relaxed [&>p]:mb-4
               [&>pre]:bg-[#050608] [&>pre]:p-5 [&>pre]:rounded-2xl [&>pre]:border [&>pre]:border-white/10 [&>pre]:overflow-x-auto [&>pre]:my-6 [&>pre]:text-xs [&>pre]:font-mono [&>pre]:text-sky-300
               [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:space-y-2 [&>ul]:my-4 [&>ul]:text-slate-300
               [&>ol]:list-decimal [&>ol]:pl-6 [&>ol]:space-y-2 [&>ol]:my-4 [&>ol]:text-slate-300
               [&>blockquote]:p-5 [&>blockquote]:rounded-2xl [&>blockquote]:bg-blue-500/[0.06] [&>blockquote]:border-l-4 [&>blockquote]:border-[#0052FF] [&>blockquote]:my-6 [&>blockquote]:text-sky-100 [&>blockquote]:italic
               [&>table]:w-full [&>table]:border-collapse [&>table]:my-6 [&>table]:text-xs [&>table]:font-mono
               [&>table_th]:border [&>table_th]:border-white/10 [&>table_th]:p-3 [&>table_th]:bg-white/[0.03] [&>table_th]:text-left [&>table_th]:text-white
               [&>table_td]:border [&>table_td]:border-white/10 [&>table_td]:p-3 [&>table_td]:text-slate-300"
        v-html="post.content"
      />

      <!-- In-Article Bottom AdSense Slot -->
      <div class="my-8 p-4 rounded-2xl bg-white/[0.01] border border-white/[0.05] text-center">
        <ins class="adsbygoogle block"
             style="display:block"
             data-ad-client="ca-pub-7190047001129861"
             data-ad-slot="default"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
      </div>

      <!-- AUTHOR BIO BOX (E-E-A-T Google AdSense Compliance) -->
      <div class="p-8 rounded-3xl bg-white/[0.02] border border-white/[0.08] flex flex-col sm:flex-row items-center sm:items-start gap-6">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#0052FF] to-sky-400 flex items-center justify-center font-black text-white text-xl shrink-0 shadow-lg shadow-blue-500/20">
          HA
        </div>
        <div class="space-y-2 text-center sm:text-left">
          <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
            <h3 class="text-base font-bold text-white">Hasan Arofid</h3>
            <span class="px-2 py-0.5 rounded-full bg-blue-500/20 border border-blue-500/30 text-sky-400 text-[10px] font-mono font-semibold">
              Principal Software Architect
            </span>
          </div>
          <p class="text-xs text-slate-400 leading-relaxed">
            Insinyur perangkat lunak senior & Lead Architect di SOLKIT (Solusi Kode Kita). Memiliki pengalaman 10+ tahun dalam rekayasa aplikasi web berskala enterprise, optimasi database, telemetri IoT, dan cloud architecture di Indonesia & Asia Tenggara.
          </p>
          <div class="pt-2 flex items-center justify-center sm:justify-start gap-4 text-xs font-mono text-sky-400">
            <a href="https://github.com/hasanarofid" target="_blank" class="hover:underline">GitHub</a>
            <span>·</span>
            <a href="https://hasanarofid.site" target="_blank" class="hover:underline">hasanarofid.site</a>
          </div>
        </div>
      </div>

      <!-- CTA CONSULTATION BOX -->
      <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-blue-600/20 to-sky-500/10 border border-blue-500/30 text-center space-y-5">
        <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">
          Menghadapi Kendala Arsitektur Serupa pada Proyek Anda?
        </h3>
        <p class="text-xs sm:text-sm text-slate-300 max-w-xl mx-auto leading-relaxed">
          Tim engineer SOLKIT siap mendiagnosis bottleneck, merancang ulang skema data, dan membangun sistem digital berkinerja tinggi untuk bisnis Anda.
        </p>
        <a 
          :href="'https://wa.me/' + (settings.whatsapp_number || '6281234567890') + '?text=Halo%20SOLKIT,%20saya%20tertarik%20berdiskusi%20tentang%20rekayasa%20sistem%20setelah%20membaca%20artikel:%20' + encodeURIComponent(post.title)"
          target="_blank"
          class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#0052FF] hover:bg-blue-600 text-white text-xs font-bold transition-all shadow-[0_0_25px_rgba(0,82,255,0.4)]"
        >
          Diskusikan dengan Tim Engineer SOLKIT <ArrowRight class="w-4 h-4" />
        </a>
      </div>

      <!-- RELATED POSTS -->
      <div v-if="relatedPosts && relatedPosts.length" class="space-y-6 pt-6 border-t border-white/[0.06]">
        <h3 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
          <BookOpen class="w-4 h-4 text-sky-400" /> Artikel Terkait Lainnya
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
          <Link 
            v-for="rel in relatedPosts" 
            :key="rel.id"
            :href="route('blog.show', rel.slug)"
            class="p-5 rounded-2xl bg-white/[0.02] border border-white/[0.06] hover:border-blue-500/40 hover:bg-white/[0.04] transition-all flex flex-col justify-between space-y-4 group"
          >
            <div class="space-y-2">
              <span class="text-[10px] font-mono text-sky-400">
                {{ rel.category?.name || 'Teknologi' }}
              </span>
              <h4 class="text-xs font-bold text-white group-hover:text-sky-300 transition-colors line-clamp-2">
                {{ rel.title }}
              </h4>
            </div>
            <span class="text-[11px] font-mono text-slate-500 flex items-center gap-1 group-hover:text-white transition-colors">
              Baca artikel <ArrowRight class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
            </span>
          </Link>
        </div>
      </div>

    </div>

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
          <Link :href="route('blog.index')" class="hover:text-white transition-colors">Blog</Link>
          <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
        </div>
      </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <FloatingWhatsApp :phone-number="settings.whatsapp_number || '628814959247'" />
  </div>
</template>
