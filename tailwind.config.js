/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // Añadimos tailwind a todas las vistas de blade que creemos
    "./resources/**/*.blade.php",
    // Añadimos tailwind al JS que maneje las vistas
    "./resources/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

