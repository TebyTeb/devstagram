/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // Añadimos tailwind a todas las vistas de blade que creemos
    "./resources/**/*.blade.php",
    // Añadimos tailwind al JS que maneje las vistas
    "./resources/**/*.js",
    // Añadimos tailwind a los templates de paginación de laravel tailwind
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

