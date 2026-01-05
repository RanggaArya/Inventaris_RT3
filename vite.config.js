import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'
import path from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/filament/admin/theme.css',
        'resources/views/**/*.blade.php',
      ],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    fs: {
      allow: [
        path.resolve(__dirname),
        path.resolve(__dirname, 'vendor'),
      ],
    },
  },
})



// import { defineConfig } from 'vite'
// import laravel from 'laravel-vite-plugin'
// import tailwindcss from '@tailwindcss/vite'

// export default defineConfig({
//   plugins: [
//     tailwindcss(),
//     laravel({
//       input: ['resources/css/app.css', 'resources/js/app.js'],
//       refresh: true,
//     }),
//   ],
//   server: {
//     host: '0.0.0.0',
//     port: 5173,
//     strictPort: true,
//     origin: 'http://192.168.100.20:5173',
//     cors: true,
//     hmr: { host: '192.168.100.20', port: 5173 },
//   },
// })
