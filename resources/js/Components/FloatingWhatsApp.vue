<script setup>
defineProps({
  phoneNumber: {
    type: String,
    default: '628814959247'
  },
  defaultMessage: {
    type: String,
    default: 'Halo SOLKIT, saya ingin konsultasi mengenai pembuatan aplikasi / rekayasa sistem software.'
  }
});
</script>

<template>
  <div class="fixed bottom-6 right-6 z-50 flex items-center group">
    <!-- Tooltip Bubble on Hover -->
    <div class="hidden sm:flex items-center mr-3 px-3.5 py-1.5 rounded-full bg-[#0C0E15]/95 border border-white/10 text-slate-200 text-xs font-medium shadow-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none translate-x-2 group-hover:translate-x-0 backdrop-blur-md">
      <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2 animate-ping"></span>
      <span>Konsultasi Tech Lead</span>
    </div>

    <!-- Floating WhatsApp Button -->
    <a
      :href="`https://wa.me/${phoneNumber.replace(/[^0-9]/g, '')}?text=${encodeURIComponent(defaultMessage)}`"
      target="_blank"
      rel="noopener noreferrer"
      aria-label="Hubungi SOLKIT via WhatsApp"
      class="relative flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] text-white shadow-[0_4px_20px_rgba(37,211,102,0.4)] hover:shadow-[0_6px_28px_rgba(37,211,102,0.65)] hover:scale-110 active:scale-95 transition-all duration-300 border-[3px] border-white cursor-pointer"
    >
      <!-- Pulsing halo behind button -->
      <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-40 animate-ping -z-10 pointer-events-none"></span>

      <!-- Official WhatsApp SVG Icon -->
      <svg
        class="w-7 h-7 fill-current drop-shadow-sm"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2ZM12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.16 12.04 20.16C10.66 20.16 9.31 19.8 8.13 19.11L7.85 18.94L4.72 19.76L5.56 16.71L5.38 16.42C4.62 15.2 4.22 13.58 4.22 11.91C4.22 7.37 7.92 3.67 12.05 3.67ZM8.83 7.35C8.63 7.35 8.44 7.42 8.28 7.6C8.11 7.77 7.64 8.21 7.64 9.11C7.64 10.01 8.3 10.87 8.39 11C8.49 11.12 9.68 12.96 11.51 13.74C13.03 14.4 13.64 14.39 14.29 14.33C14.71 14.29 15.65 13.78 15.85 13.22C16.05 12.65 16.05 12.17 15.99 12.07C15.93 11.97 15.77 11.91 15.53 11.79C15.29 11.67 14.11 11.09 13.89 11.01C13.67 10.93 13.51 10.89 13.35 11.13C13.19 11.37 12.72 11.91 12.58 12.07C12.44 12.23 12.3 12.25 12.06 12.13C11.82 12.01 11.05 11.76 10.13 10.94C9.42 10.3 8.93 9.51 8.81 9.31C8.69 9.11 8.8 9 8.92 8.88C9.03 8.77 9.16 8.6 9.28 8.46C9.4 8.32 9.44 8.22 9.52 8.06C9.6 7.9 9.56 7.76 9.5 7.64C9.44 7.52 8.97 6.37 8.83 7.35Z"/>
      </svg>
    </a>
  </div>
</template>
