<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelNow Colombia S.A.S. - Panel Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header class="bg-blue-900 text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-2xl font-black tracking-wider text-teal-400">Hoteleria</span>
                <span class="text-xs bg-teal-500 text-blue-950 font-bold px-2 py-0.5 rounded">Colombia</span>
            </div>
            <nav class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="#" class="hover:text-teal-300 transition">Inicio</a>
                <a href="#" class="text-teal-400 border-b-2 border-teal-400 pb-1">Hoteles</a>
                <a href="{{ route('hoteles.index') }}" class="hover:text-teal-300 transition">Reservas</a>
                <a href="#" class="hover:text-teal-300 transition">Reportes</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Consola de Administración de Hoteles</h2>
                    <p class="text-sm text-gray-600">Datos</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-950 text-white text-sm uppercase tracking-wider">
                                <th class="p-4 text-center">ID</th>
                                <th class="p-4">Hotel</th>
                                <th class="p-4">Ubicación</th>
                                <th class="p-4 text-right">Precio/Noche</th>
                                <th class="p-4 text-center">Hab. Disponibles</th>
                                <th class="p-4 text-center">Calificación</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($hoteles as $hotel)
                                <tr class="border-b hover:bg-blue-50 transition {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="p-4 font-bold text-center text-gray-500">{{ $hotel['id'] }}</td>
                                    <td class="p-4">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $hotel['imagen'] }}" alt="{{ $hotel['nombre'] }}" class="w-16 h-12 object-cover rounded-md shadow-sm">
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $hotel['nombre'] }}</div>
                                                <div class="text-xs text-gray-500 line-clamp-1 max-w-xs">{{ $hotel['descripcion'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600 font-medium">{{ $hotel['ciudad'] }}</td>
                                    <td class="p-4 text-right font-bold text-teal-600">${{ number_format($hotel['precio'], 0, ',', '.') }} COP</td>
                                    <td class="p-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $hotel['habitaciones'] > 5 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $hotel['habitaciones'] }} disp.
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="text-amber-500 font-bold">★</span> {{ $hotel['calificacion'] }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">No se encontraron hoteles disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 self-start">
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h3 class="text-lg font-bold text-blue-950">Registrar Nueva Reserva</h3>
                </div>

                <form action="{{ route('reserva.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-700 mb-1">Seleccionar Hotel</label>
                        <select name="hotel_nombre" class="w-full p-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-blue-900 focus:outline-none text-sm bg-white" required>
                            <option value="">Seleccione un destino </option>
                            @foreach($hoteles as $hotel)
                                <option value="{{ $hotel['nombre'] }} ({{ $hotel['ciudad'] }})">{{ $hotel['nombre'] }} - {{ $hotel['ciudad'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-700 mb-1">Detalles de la Reserva</label>
                        <textarea name="detalles_reserva" rows="4" placeholder="Ej: Reserva para 2 adultos, 3 noches. Incluye desayuno." class="w-full p-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-blue-900 focus:outline-none text-sm" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-blue-950 font-bold py-3 px-4 rounded transition shadow-md tracking-wide text-sm uppercase">
                        Confirmar Reserva
                    </button>
                </form>
            </div>

        </div>
    </main>

    <footer class="bg-blue-950 text-gray-400 text-xs py-6 mt-12 border-t border-blue-900">
        <div class="container mx-auto px-6 text-center">
            &copy; 2026 TravelNow Colombia S.A.S. Todos los derechos reservados. Sistema de Gestión de Aliados Internos.
        </div>
    </footer>

</body>
</html>