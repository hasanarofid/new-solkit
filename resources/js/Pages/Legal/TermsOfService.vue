<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, BookOpen } from '@lucide/vue';
import FloatingWhatsApp from '@/Components/FloatingWhatsApp.vue';

defineProps({
  settings: {
    type: Object,
    required: true
  }
});
</script>

<template>
  <Head title="Syarat dan Ketentuan (Terms of Service) | SOLKIT">
    <meta name="description" content="Syarat dan Ketentuan layanan rekayasa perangkat lunak dan penggunaan konten di situs SOLKIT (Solusi Kode Kita)." />
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
          <BookOpen class="w-3.5 h-3.5" /> LEGAL AGREEMENT
        </div>
        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Syarat dan Ketentuan (Terms of Service)</h1>
        <p class="text-xs font-mono text-slate-500">Terakhir diperbarui: 9 Oktober 2026</p>
      </div>

      <div class="space-y-6">
        <h2 class="text-xl font-bold text-white">1. Ketentuan Umum & Penerimaan Syarat</h2>
        <p>
          Dengan mengakses situs web SOLKIT yang beralamat di <a href="https://solkit.tech" class="text-sky-400 underline">https://solkit.tech</a>, Anda menyatakan bahwa Anda telah membaca, memahami, dan menyetujui untuk terikat oleh Syarat dan Ketentuan Layanan (Terms of Service) ini, seluruh peraturan perundang-undangan yang berlaku di Republik Indonesia, dan standar etika digital global. Apabila Anda tidak menyetujui salah satu bagian dari ketentuan ini, Anda dipersilakan untuk menghentikan penggunaan situs web kami.
        </p>

        <h2 class="text-xl font-bold text-white">2. Definisi Istilah</h2>
        <ul class="list-disc pl-5 space-y-2 text-slate-300">
          <li><strong>"SOLKIT"</strong> merujuk pada studio rekayasa perangkat lunak SOLKIT (Solusi Kode Kita) yang berdomisili di Surabaya, Jawa Timur, Indonesia.</li>
          <li><strong>"Pengguna"</strong> atau <strong>"Anda"</strong> merujuk pada setiap individu, perwakilan badan usaha, atau institusi yang mengakses situs web atau menggunakan layanan konsultasi kami.</li>
          <li><strong>"Layanan"</strong> merujuk pada seluruh produk, jasa pembuatan aplikasi web, aplikasi mobile, audit performa, implementasi AI, dan materi publikasi teknis yang disediakan oleh SOLKIT.</li>
        </ul>

        <h2 class="text-xl font-bold text-white">3. Hak Kekayaan Intelektual (Intellectual Property)</h2>
        <p>
          Seluruh konten, materi teknis, artikel riset, logo, identitas visual, grafis, dan kode sumber dasar yang dipublikasikan di situs web SOLKIT adalah milik eksklusif SOLKIT dan dilindungi oleh Undang-Undang Hak Cipta No. 28 Tahun 2014 serta traktat kekayaan intelektual internasional.
        </p>
        <p>
          Pengunjung diberikan lisensi terbatas non-eksklusif untuk membaca dan mengutip materi artikel teknis kami maksimal 200 kata dengan kewajiban menyertakan tautan balik (backlink) aktif dan atribusi jelas ke <a href="https://solkit.tech" class="text-sky-400 underline">https://solkit.tech</a>. Dilarang keras melakukan scraping otomatis, redistribusi massal, atau mempublikasikan ulang artikel tanpa persetujuan tertulis dari manajemen SOLKIT.
        </p>

        <h2 class="text-xl font-bold text-white">4. Layanan Rekayasa Perangkat Lunak Komersial</h2>
        <p>
          Penyediaan jasa perancangan aplikasi kustom, sistem enterprise, integrasi cloud, dan otomatisasi bisnis tunduk pada Perjanjian Kerja Sama (PKS), Dokumen Spesifikasi Kebutuhan Perangkat Lunak (PRD), dan Berita Acara Serah Terima (BAST) tersendiri. Kepemilikan hak cipta atas source code produk akhir yang dipesan oleh klien komersial akan dialihkan secara penuh kepada klien sesuai kesepakatan kontrak kerja sama.
        </p>

        <h2 class="text-xl font-bold text-white">5. Kerahasiaan Informasi (Non-Disclosure Agreement)</h2>
        <p>
          SOLKIT menjamin kerahasiaan penuh atas segala data bisnis, logika bisnis proprietary, ide produk, dan kredensial akses yang dibagikan oleh calon klien saat sesi konsultasi maupun tahap implementasi proyek. Kami tidak akan pernah menjual, menyewakan, atau membagikan data Anda kepada pihak ketiga manapun tanpa persetujuan tertulis.
        </p>

        <h2 class="text-xl font-bold text-white">6. Jaminan Kualitas & Masa Garansi Bebas Cacat (Bug Warranty)</h2>
        <p>
          Setiap aplikasi perangkat lunak yang diserahterimakan oleh SOLKIT kepada klien komersial dilindungi oleh masa garansi pemeliharaan (warranty period) minimal 30 hingga 90 hari kalender. Selama masa garansi, tim engineer kami bertanggung jawab penuh untuk memperbaiki segala galat logika, memory leak, atau cacat fungsional yang tidak sesuai dengan spesifikasi PRD awal tanpa biaya tambahan.
        </p>

        <h2 class="text-xl font-bold text-white">7. Penafian Tanggung Jawab (Disclaimer of Warranty)</h2>
        <p>
          Materi pada artikel blog teknis situs web SOLKIT disediakan atas dasar <em>"as is"</em> (sebagaimana adanya) untuk tujuan edukasi dan referensi industri perangkat lunak. SOLKIT tidak memberikan jaminan tersirat atas kerugian teknis yang dialami pengguna akibat implementasi kode pihak ketiga di luar lingkungan pengawasan kami.
        </p>

        <h2 class="text-xl font-bold text-white">8. Pembatasan Tanggung Jawab (Limitation of Liability)</h2>
        <p>
          Dalam keadaan apa pun, SOLKIT, direktur, karyawan, atau mitra kerjanya tidak bertanggung jawab atas kerugian tidak langsung, insidental, khusus, atau konsekuensial (termasuk kehilangan keuntungan, kehilangan data bisnis, atau penghentian operasional) yang timbul dari penggunaan atau ketidakmampuan menggunakan materi di situs web ini.
        </p>

        <h2 class="text-xl font-bold text-white">9. Perubahan Syarat dan Ketentuan</h2>
        <p>
          SOLKIT berhak untuk memperbarui atau memodifikasi Syarat dan Ketentuan ini sewaktu-waktu demi mematuhi perkembangan hukum digital dan kebijakan perayapan mesin pencari (search engine). Tanggal pembaruan terakhir akan selalu dicantumkan di bagian atas halaman ini.
        </p>

        <h2 class="text-xl font-bold text-white">10. Hukum yang Berlaku & Yurisdiksi Penyelesaian Sengketa</h2>
        <p>
          Syarat dan Ketentuan ini diatur dan ditafsirkan sesuai dengan hukum Negara Kesatuan Republik Indonesia. Segala perselisihan yang timbul sehubungan dengan penafsiran atau pelaksanaan ketentuan ini akan diselesaikan secara musyawarah untuk mufakat, dan apabila tidak tercapai kesepakatan, para pihak sepakat untuk memilih domisili hukum di Pengadilan Negeri Surabaya, Jawa Timur, Indonesia.
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
