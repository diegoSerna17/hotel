<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Reserva - TravelNow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col justify-between">

    <header class="bg-blue-900 text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-2xl font-black tracking-wider text-teal-400">TravelNow</span>
                <span class="text-xs bg-teal-500 text-blue-950 font-bold px-2 py-0.5 rounded">Colombia S.A.S</span>
            </div>
            <a href="{{ route('hoteles.index') }}" class="text-sm bg-blue-800 hover:bg-blue-700 text-white py-2 px-4 rounded transition">
                Volver al Panel
            </a>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12 flex justify-center items-center flex-grow">
        <div class="bg-white max-w-xl w-full rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            
            <div class="bg-gradient-to-r top-0 bg-blue-950 text-white p-6 text-center">
                <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center mx-auto mb-3 shadow-md">
                    <svg class="w-8 h-8 text-blue-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold tracking-wide">¡Reserva Confirmada!</h2>
                <p class="text-teal-300 text-xs mt-1 uppercase tracking-widest font-semibold">Comprobante de Operación Exitosa</p>
            </div>

            <div class="p-8 space-y-6">
                <div class="text-center">
                    <span class="text-xs font-bold text-gray-400 uppercase block">Código Único de Registro (API ID)</span>
                    <span class="text-3xl font-black text-blue-900 tracking-wider">{{ $id_reserva }}</span>
                </div>

                <hr class="border-dashed border-gray-300">

                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-start">
                        <span class="text-gray-500 font-medium">Establecimiento:</span>
                        <span class="text-gray-900 font-bold text-right">{{ $hotel }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Fecha de Procesamiento:</span>
                        <span class="text-gray-900 font-semibold text-right">{{ $fecha }}</span>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <span class="text-xs font-bold text-gray-400 uppercase block mb-1">Especificaciones del Servicio</span>
                        <p class="text-gray-700 italic">"{{ $detalles }}"</p>
                    </div>
                </div>

                <hr class="border-dashed border-gray-300">

                <div class="text-center text-xs text-gray-500">
                    <p>Este documento es un reflejo digital de la petición procesada por la API REST externa de simulación JSONPlaceholder.</p>
                </div>

                <div class="pt-2">
                    <a href="{{ route('hoteles.index') }}" class="block text-center w-full bg-teal-500 hover:bg-teal-600 text-blue-950 font-bold py-3 rounded transition shadow-md uppercase tracking-wide text-sm">
                        Finalizar y Regresar
                    </a>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-blue-950 text-gray-400 text-xs py-4 text-center border-t border-blue-900">
        &copy; 2026 TravelNow Colombia S.A.S. Interno Operativo.
    </footer>

</body>
</html>