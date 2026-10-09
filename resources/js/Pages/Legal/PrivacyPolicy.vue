<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, ShieldCheck } from '@lucide/vue';
import FloatingWhatsApp from '@/Components/FloatingWhatsApp.vue';

defineProps({
  settings: {
    type: Object,
    required: true
  }
});
</script>

<template>
  <Head title="Kebijakan Privasi (Privacy Policy) | SOLKIT">
    <meta name="description" content="Kebijakan Privasi SOLKIT (Solusi Kode Kita). Informasi kepatuhan privasi, penggunaan cookie, dan kebijakan iklan Google AdSense." />
    <meta name="robots" content="index, follow" />
  </Head>

  <div class="min-h-screen bg-[#090A0E] text-slate-100 font-sans selection:bg-[#0052FF] selection:text-white">
    <header class="sticky top-0 z-50 bg-[#090A0E]/80 backdrop-blur-xl border-b border-white/[0.08]">
      <div class="max-w-5xl mx-auto px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-3">
          <img :src="settings.site_logo_url || '/images/solkit-dark.svg'" alt="SOLKIT" class="h-9 w-auto" />
        </Link>
        <Link href="/" class="text-xs font-semibold text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
          <ArrowLeft class="w-3.5 h-3.5" /> Beranda
        </Link>
      </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-16 space-y-10 text-sm leading-relaxed text-slate-300">
      <div class="space-y-4 border-b border-white/[0.08] pb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-sky-400 text-xs font-mono">
          <ShieldCheck class="w-3.5 h-3.5" /> PRIVACY & ADSENSE COMPLIANCE
        </div>
        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Kebijakan Privasi (Privacy Policy)</h1>
        <p class="text-xs font-mono text-slate-500">Terakhir diperbarui: 9 Oktober 2026</p>
      </div>

      <div class="space-y-6">
        <h2 class="text-xl font-bold text-white">1. Pendahuluan</h2>
        <p>
          Selamat datang di SOLKIT (Solusi Kode Kita), yang dapat diakses melalui <a href="https://solkit.tech" class="text-sky-400 underline">https://solkit.tech</a>. Privasi pengunjung kami adalah salah satu prioritas utama kami. Dokumen Kebijakan Privasi ini berisi jenis informasi yang dikumpulkan dan dicatat oleh SOLKIT serta bagaimana kami menggunakannya.
        </p>

        <h2 class="text-xl font-bold text-white">2. Berkas Log (Log Files)</h2>
        <p>
          SOLKIT mengikuti prosedur standar menggunakan berkas log. Berkas ini mencatat pengunjung saat mereka mengunjungi situs web. Informasi yang dikumpulkan oleh berkas log meliputi alamat protokol internet (IP), jenis peramban (browser), Penyedia Layanan Internet (ISP), stempel tanggal dan waktu, halaman perujuk/keluar, dan kemungkinan jumlah klik. Informasi ini tidak terkait dengan informasi apa pun yang dapat diidentifikasi secara pribadi.
        </p>

        <h2 class="text-xl font-bold text-white">3. Cookie dan Web Beacon</h2>
        <p>
          Seperti situs web lainnya, SOLKIT menggunakan "cookie". Cookie ini digunakan untuk menyimpan informasi termasuk preferensi pengunjung dan halaman di situs web yang diakses atau dikunjungi pengunjung. Informasi tersebut digunakan untuk mengoptimalkan pengalaman pengguna dengan menyesuaikan konten halaman web kami berdasarkan jenis browser pengunjung dan/atau informasi lainnya.
        </p>

        <h2 class="text-xl font-bold text-white">4. Cookie Google DoubleClick DART (Google AdSense)</h2>
        <p>
          Google adalah salah satu vendor pihak ketiga di situs kami. Google juga menggunakan cookie, yang dikenal sebagai cookie DART, untuk menayangkan iklan kepada pengunjung situs kami berdasarkan kunjungan mereka ke situs kami dan situs lain di internet. Pengunjung dapat memilih untuk menolak penggunaan cookie DART dengan mengunjungi Kebijakan Privasi jaringan iklan dan konten Google di URL berikut: <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener noreferrer" class="text-sky-400 underline">https://policies.google.com/technologies/ads</a>.
        </p>

        <h2 class="text-xl font-bold text-white">5. Mitra Periklanan Kami</h2>
        <p>
          Beberapa pengiklan di situs kami mungkin menggunakan cookie dan web beacon. Mitra periklanan kami meliputi <strong>Google AdSense</strong>. Masing-masing mitra periklanan kami memiliki Kebijakan Privasi mereka sendiri untuk kebijakan mereka tentang data pengguna. Server iklan atau jaringan iklan pihak ketiga menggunakan teknologi seperti cookie, JavaScript, atau Web Beacon yang digunakan dalam iklan dan tautan masing-masing yang muncul di SOLKIT. Mereka secara otomatis menerima alamat IP Anda ketika hal ini terjadi.
        </p>

        <h2 class="text-xl font-bold text-white">6. Kebijakan Privasi Pihak Ketiga</h2>
        <p>
          Kebijakan Privasi SOLKIT tidak berlaku untuk pengiklan atau situs web lain. Oleh karena itu, kami menyarankan Anda untuk berkonsultasi dengan Kebijakan Privasi masing-masing dari server iklan pihak ketiga ini untuk informasi yang lebih rinci.
        </p>

        <h2 class="text-xl font-bold text-white">7. Persetujuan</h2>
        <p>
          Dengan menggunakan situs web kami, Anda dengan ini menyetujui Kebijakan Privasi kami dan menyetujui syarat-syaratnya.
        </p>

        <h2 class="text-xl font-bold text-white">8. Hubungi Kami</h2>
        <p>
          Jika Anda memiliki pertanyaan tambahan atau memerlukan informasi lebih lanjut tentang Kebijakan Privasi kami, jangan ragu untuk menghubungi kami melalui email di <a :href="'mailto:' + (settings.contact_email || 'partner@solkit.tech')" class="text-sky-400 underline">{{ settings.contact_email || 'partner@solkit.tech' }}</a>.
        </p>
      </div>
    </main>

    <footer class="py-8 border-t border-white/[0.06] text-center text-xs text-slate-500">
      © {{ new Date().getFullYear() }} SOLKIT (Solusi Kode Kita). Seluruh hak cipta dilindungi.
    </footer>

    <!-- Floating WhatsApp Button -->
    <FloatingWhatsApp :phone-number="settings.whatsapp_number || '628814959247'" />
  </div>
</template>
