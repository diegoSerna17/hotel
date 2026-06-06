<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HotelController extends Controller
{
    public function index()
    {
        // Consumir la API externa
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        
        if ($response->successful()) {

            $apiHoteles = array_slice($response->json(), 0, 7);
            
            $ciudades = ['Cartagena', 'Santa Marta', 'San Andrés', 'Medellín', 'Bogotá', 'Cali', 'Pereira'];
            $precios = [250000, 180000, 320000, 150000, 210000, 135000,2000000];
            $calificaciones = [4.8, 4.2, 4.9, 4.5, 4.0, 4.3,5.0];
            $habitaciones = [12, 5, 2, 24, 15, 8,9];
            $imagenes = [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500',
                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=500',
                'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=500',
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=500',
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500',
                'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=500',
                'https://images.unsplash.com/photo-1495365200479-c4ed1d35e1aa?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ];

            $hoteles = [];
            foreach ($apiHoteles as $index => $item) {
                $hoteles[] = [
                    'id' => $item['id'],
                    'nombre' => 'Hotel ' . ucwords(substr($item['title'], 0, 15)), 
                    'descripcion' => $item['body'],
                    'ciudad' => $ciudades[$index] ?? 'Colombia',
                    'precio' => $precios[$index] ?? 200000,
                    'habitaciones' => $habitaciones[$index] ?? 10,
                    'calificacion' => $calificaciones[$index] ?? 4.5,
                    'imagen' => $imagenes[$index] ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500'
                ];
            }
        } else {
            $hoteles = [];
        }

        return view('hoteles.index', compact('hoteles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'hotel_nombre' => 'required|string',
            'detalles_reserva' => 'required|string',
        ]);

        $response = Http::post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'Reserva ' . $request->input('hotel_nombre'),
            'body' => $request->input('detalles_reserva')
        ]);

        if ($response->successful()) {
            $resultado = $response->json();
            return view('hoteles.reservas', [
                'id_reserva' => $resultado['id'],
                'hotel' => $request->input('hotel_nombre'),
                'detalles' => $request->input('detalles_reserva'),
                'fecha' => now()->format('d/m/Y H:i A') 
            ]);
        }

        return redirect()->route('hoteles.index')->with('error', 'No se pudo registrar la reserva.');
    }
}