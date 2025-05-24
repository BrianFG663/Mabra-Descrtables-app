<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_detail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class SaleController extends Controller
{

    public function getSale($id){

        $venta = Sale::find($id);
        return $venta;

    }

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
            'fecha' => Carbon::today('America/Argentina/Buenos_Aires'),
            'total' => $request->total
        ]);

        foreach ($productos['productos'] as $producto) {
            Sale_detail::create([
                'sales_id' => $venta->id,
                'product_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio']
            ]);


            $product = Product::find($producto['id']);
            $product->stock -= $producto['cantidad'];
            $product->save();
        } 

        if (empty($productos)) {
            return response()->json(['error' => 'No se recibieron productos.'], 400);
        }

        return response()->json(['message' => 'Venta recibida correctamente.', 'productos' => $productos]);
    }

    public function formularioVentas(){
        $categorias = Category::all();

        return view('ProductosVendidos', compact('categorias'));
    }


    public function productosVendidos(){

        $productos = Sale_detail::with(['product.categorias'])
        ->select(
            'product_id',
            DB::raw('SUM(cantidad) as total_vendido'),
            DB::raw('SUM(cantidad * precio_unitario) as total_recaudado')
        )
        ->groupBy('product_id')
        ->orderByDesc('total_vendido')
        ->take(10)
        ->get();

        return response()->json(['productos' => $productos]);
    }

    public function productosVendidosCategoria(Request $request){

        $desde = $request->fecha;
        $hasta = Carbon::now()->toDateString();;
        $categoriaId = $request->id;

        $productos = Sale_detail::with('product.categorias')
            ->whereHas('sale', function ($q) use ($desde, $hasta) {
                $q->whereBetween('fecha', [$desde, $hasta]);
            })
            ->whereHas('product.categorias', function ($q) use ($categoriaId) {
                $q->where('categories.id', $categoriaId);
            })
            ->select(
                'product_id',
                DB::raw('SUM(cantidad) as total_vendido'),
                DB::raw('SUM(cantidad * precio_unitario) as total_recaudado')
            )
            ->groupBy('product_id')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        return response()->json(['productos' => $productos]);
    }

    public function ventasDia(Request $request){

        $fecha = $request->input('fecha');

       $ventas = Sale::with(['sales_details'])
        ->withCount('sales_details')
        ->whereDate('fecha', $fecha)
        ->orderByDesc('id')
        ->get();


        $userIds = $ventas->pluck('user_id')->unique();
        $vendedores = User::find($userIds);



        return response()->json(['ventas' => $ventas, 'vendedor'=> $vendedores]);
    }

    public function eliminarVenta(Request $request){
        $id = $request->input('id');
        $registro = Sale::find($id);

        if ($registro) {
            $registro->delete();
        }

        return response()->json(['mensaje'=>'verdadero']);
    }

    public function detalleVenta(Request $request){

        $id = $request->input('id');
        $sale = Sale::with('sales_details.product.categorias')->findOrFail($id);
        
        $detalles = $sale->sales_details;

        return view('sale', compact('detalles'));
    }


}



