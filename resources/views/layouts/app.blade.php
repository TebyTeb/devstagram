<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles -->
  @vite('resources/css/app.css')

  <title>DevStagram - @yield('titulo')</title>

</head>

<body>
  <header class="p-5 border-b bg-white shadow">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-black"><a href="/">DevStagram</a></h1>
      <nav class="flex gap-3 items-center">
        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
      </nav>
    </div>
  </header>
  <main class="container mx-auto mt-10">
    <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
    @yield('contenido')
  </main>
  <footer class="mt-10 text-center font-bold text-gray-500 p-5 uppercase">
    DevStagram - &copy;{{now()->year}} Todos los derechos reservados
  </footer>
</body>

</html>
