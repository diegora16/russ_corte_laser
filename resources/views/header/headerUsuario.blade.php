<header class="text-white body-font border-b border-gray-300 bg-gray-900 rounded-b-2xl shadow-md">
  <div class="container mx-auto flex flex-wrap p-1 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/">
      <img src="/img/logoheader.png" alt="Logo" class="w-36 h-30 p-2" />
      <span class="text-sm text-white mx-3">Diseños perfectos, grabados únicos</span>
    </a>
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-blue-900" href="/"><i class="fa-solid fa-house mr-2"></i>Inicio</a>
      <a class="mr-5 hover:text-blue-900" href="/Tienda"><i class="fa-solid fa-store mr-2"></i>Tienda</a>
      <a class="mr-5 hover:text-blue-900" href="/Nosotros"><i class="fa-solid fa-users mr-2"></i>Nosotros</a>
      <a class="mr-5 hover:text-blue-900" href="/Contacto"><i class="fa-solid fa-envelope mr-2"></i>Contacto</a>
    </nav>
    
    <!-- Botón "Mi carrito" con contador dinámico -->
    <a href="/Carrito">
      <button id="cart-button" class="inline-flex items-center bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-700 rounded text-base mt-4 md:mt-0 text-white font-semibold">
          <i class="fa-solid fa-cart-shopping mr-2 text-2xl"></i>
          Mi carrito (<span id="cart-count">0</span>)
      </button>
    </a>
  </div>
</header>

<script>
  // Actualizar el contador del carrito al cargar la página
  document.addEventListener('DOMContentLoaded', function () {
      fetch('{{ route("carrito.contar") }}')
          .then(response => response.json())
          .then(data => {
              document.getElementById('cart-count').textContent = data.count || 0;
          });
  });
</script>
