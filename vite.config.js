import { defineConfig } from 'vite';

export default defineConfig({
  base: './',
  server: {
    port: 3000,
    open: false,
    host: true
  },
  build: {
    outDir: 'dist',
    assetsDir: 'assets',
    sourcemap: true,
    minify: 'esbuild',
    rollupOptions: {
      output: {
        entryFileNames: 'assets/js/main.js',
        chunkFileNames: (chunkInfo) => {
          if (chunkInfo.name === 'three') return 'assets/js/three-vendor.js';
          if (chunkInfo.name === 'gsap') return 'assets/js/gsap-vendor.js';
          return 'assets/js/[name].js';
        },
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'assets/css/style.css';
          }
          return 'assets/[name].[ext]';
        },
        manualChunks: {
          three: ['three'],
          gsap: ['gsap', 'gsap/ScrollTrigger']
        }
      }
    }
  }
});
