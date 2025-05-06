<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function buscar(Request $request){
        $query = $request->get('query');
        $productos = Product::where('nombre', 'like', '%' . $query . '%')->get();
        
        return response()->json($productos);
    }

    public function buscarCategoria(){

    }


    public function registrar(Request $request){
        $productos = $request->all();
        Log::info('Datos de la venta: ', $request->all());

        
        $venta = Sale::create([
            'user_id' => Auth::user()['id'],
            'fecha' =>  Carbon::today(),
            'total' => $request->total
        ]);

        foreach ($productos['productos'] as $producto) {
            Sale_detail::create([
                'sales_id' => $venta->id,
                'product_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio']
            ]);
        } 

        if (empty($productos)) {
            return response()->json(['error' => 'No se recibieron productos.'], 400);
        }

        return response()->json(['message' => 'Venta recibida correctamente.', 'productos' => $productos]);
    }
}



