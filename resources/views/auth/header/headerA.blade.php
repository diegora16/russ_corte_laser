<header class="text-white body-font border-b border-gray-300 bg-gray-900 rounded-b-2xl shadow-md">
  <div class="container mx-auto flex flex-wrap p-1 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/panel">
      <img src="/img/logoheader.png" alt="Logo" class="w-36 h-30 p-2" />
      <span class="text-sm text-white mx-3">ADMINISTRACIÓN DE PRODUCTOS</span>
    </a>
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-blue-900" href="/panel"><i class="fa-solid fa-house mr-2"></i>Inicio</a>
      <a class="mr-5 hover:text-blue-900" href="/categorias"><i class="fa-solid fa-icons mr-2"></i>Categorias</a>
      <a class="mr-5 hover:text-blue-900" href="/productos"><i class="fa-solid fa-box mr-2"></i>Productos</a>
      @auth
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="mr-5 hover:text-blue-900" href="/Salir"><i class="fa-solid fa-right-from-bracket mr-2"></i>Salir</button>
          </form>
      @endauth
    </nav>
    
  </div>
</header>


