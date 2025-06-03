<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Document</title>
</head>

<body>
  <header class="bg-white shadow-md">
    <nav class="container mx-auto py-4 px-6">
      <div class="flex items-center justify-between">
        <a href="#" class="text-2xl font-bold text-gray-800">BookRoute</a>
        <a href="http://localhost/bookroute/user/" class="text-gray-600 hover:text-gray-800">Inicio</a>
        <a href="http://localhost/bookroute/user/reservas.html" class="text-gray-600 hover:text-gray-800">Reservas</a>
        <div class="space-x-4">
          <a href="#" class="text-gray-600 hover:text-gray-800">
            <form action="/bookroute/api/controllers/auth_login.php" method="post">
              <button type="submit" name="btnLogout" id="btnLogout"
                class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 font-bold rounded">Cerrar Sesión</button>
            </form>
          </a>
        </div>
      </div>
    </nav>
  </header>
  <main class="container mx-auto mt-8 p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4 text-gray-800">Mis Reservas</h1>


    <div id="reservas-container" class="space-y-4">

    </div>
  </main>

  <script>
    usuarioId = <?= json_encode($_SESSION['id']) ?>;
    console.log("Usuario ID:", usuarioId);
    const reservasContainer = document.getElementById('reservas-container');

    function mostrarReservas() {
      fetch("http://localhost/bookroute/api/controllers/reservas_controller.php?usuario=<?= urlencode($_SESSION['id']) ?>")
        .then(response => response.json())
        .then(data => {
          reservasContainer.innerHTML = '';
          data.forEach(reserva => {
            console.log(reserva);
            const reservaElement = document.createElement('div');
            reservaElement.innerHTML = `
        <div id="reservaCard-${reserva.id}" class="max-w-sm mx-auto bg-white rounded-xl shadow-md overflow-hidden cursor-pointer transition duration-300">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b">
        <span class="bg-teal-500 text-white text-sm font-medium px-3 py-1 rounded-full">Pendiente</span>
        <span class="text-sm text-gray-500">${reserva.fecha} ${reserva.horario}</span>
        </div>
        
        <!-- Ruta -->
        <div class="px-4 pt-4 text-center">
        <div class="flex items-center justify-between text-gray-800 font-semibold text-lg">
          <span>${reserva.origen}</span>
          <div class="flex-1 mx-2 border-t border-dashed border-gray-400 relative">
            <span class="absolute left-1/2 -top-4 transform -translate-x-1/2 text-xs text-gray-500">${reserva.distancia} km</span>
          </div>
          <span>${reserva.destino}</span>
        </div>
        </div>
        
        <!-- ID Reserva -->
        <div class="flex justify-between px-4 py-2 text-sm text-gray-600 font-medium border-b">
        <span>ID de Reserva</span>
        <span>${String(reserva.id).padStart(5, '0')}</span>
        </div>
        
        <!-- Datos del Vehículo (ocultos inicialmente) -->
        <div id="vehiculoDetalle-${reserva.id}" class="px-4 py-3 bg-gray-50 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
        <h3 class="text-center font-semibold text-gray-800 mb-2">Datos del Vehiculo Reservado:</h3>
        <p class="text-sm text-gray-700"><span class="font-medium">Matrícula:</span> ${reserva.matricula}</p>
        <p class="text-sm text-gray-700"><span class="font-medium">Tipo de Vehículo:</span> ${reserva.tipo}</p>
        <p class="text-sm text-gray-700"><span class="font-medium">Capacidad:</span> ${reserva.asientos_totales} asientos</p>
        </div>
        </div>
        


          `;
            reservasContainer.appendChild(reservaElement);
            const card = document.getElementById('reservaCard-' + reserva.id);
            const detalle = document.getElementById('vehiculoDetalle-' + reserva.id);
            let visible = false;

            card.addEventListener('click', () => {
              visible = !visible;
              if (visible) {
                detalle.classList.remove('opacity-0', 'max-h-0');
                detalle.classList.add('opacity-100', 'max-h-96');
              } else {
                detalle.classList.remove('opacity-100', 'max-h-96');
                detalle.classList.add('opacity-0', 'max-h-0');
              }
            });
          });
        })
        .catch(error => {
          console.error('Error al cargar las reservas:', error);
          reservasContainer.innerHTML = '<p class="text-red-500">Error al cargar las reservas.</p>';
        });
    }

    mostrarReservas();
  </script>
</body>

</html>