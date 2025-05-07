const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      // Laravel default paths
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      
      // Your application views
      './resources/views/**/*.blade.php',
      
      // JavaScript/React files
      './resources/js/**/*.js',
      './resources/js/**/*.jsx',
      './resources/js/**/*.ts',
      './resources/js/**/*.tsx',
      
      // Livewire components if used
      './app/Http/Livewire/**/*.php',
      
      // Custom vendor views if any
      './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }
