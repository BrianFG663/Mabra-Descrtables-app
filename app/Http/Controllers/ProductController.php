<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function formularioProducto(){

        $categorias = Category::all();
        return view('agregararticulo',compact('categorias'));
        
    }

    public function agregarProducto(Request $request){
        
        $producto = Product::create([
            'nombre'=>strtoupper($request->name),
            'descripcion'=>ucfirst($request->descripcion),
            'precio'=>$request->precio,
            'stock'=>$request->stock
        ]);
        
        $producto->categorias()->attach($request->categoria);

        return redirect()->route('formulario.producto');
        
    }

    public function buscarProducto(Request $request){

        $id = $request->input('id');

        $producto = Product::find($id);
        $categorias = $producto->categorias;

        return response()->json(['producto'=>$producto, 'categorias'=>$categorias]);
    }

    public function TraerProductos(Request $request){

        $id = $request->input('id');
        $categoria = Category::find($id);
        $productos = $categoria->productos;

        if(!$productos->isEmpty()){
            return response()->json(['productos'=>$productos,'categoria'=>$categoria->nombre, 'mensaje'=> 'verdadero']);
        }else{
            return  response()->json(['mensaje'=>'falso']);
        }

    }

    public function ProductosCategoria(){

        $categorias = Category::all();

        return view('busquedaarticulos',compact('categorias'));
    }

    public function buscarProductoEdicion(Request $request){

        $id = $request->input('id');
        $producto = Product::find($id);
        $categorias_producto = $producto->categorias;
        $categorias = Category::all();

        return view('formularioEditarProducto', compact('producto','categorias','categorias_producto'));
    }


    public function edicionProducto(Request $request){

        $producto = Product::find($request->input('id'));

        if(!empty($request->input('nombre'))){
            $producto->nombre = strtoupper($request->input('nombre'));
            $producto->save();
        }

        if(!empty($request->input('descripcion'))){
            $producto->descripcion = ucfirst($request->input('descripcion'));
            $producto->save();
        }

        if(!empty($request->input('precio'))){
            $producto->precio = $request->input('precio');
            $producto->save();
        }

        if($request->input('categoria_nueva') != "default"){
            $producto->categorias()->syncWithoutDetaching([$request->input('categoria_nueva')]);
        }

        if ($request->input('categoria_eliminar') != "default" && $request->input('categoria_eliminar') != null) {
            $producto->categorias()->detach($request->input('categoria_eliminar'));
        };

        return  response()->json(['mensaje'=>'verdadero']);
    }

    public function eliminarProducto(Request $request){

        $producto = Product::find($request->input('id'));
        $producto->delete();

        return  response()->json(['mensaje'=>'verdadero']);
    }

    public function formularioCambiarPrecios(){

        $categorias = Category::all();

        return view('cambioPrecios', compact('categorias'));

    }

    public function cambiarPrecio(Request $request){

        
        $valor = $request->input('categoria');
        [$id, $nombre] = explode('|', $valor); 
        $categoria = Category::find($id);
        $productos = $categoria->productos;
        $porcentaje = $request->porcentaje;


        if($request->accion == "suba"){
            foreach($productos as $producto){
                $resultado = round($producto->precio * (1 + $porcentaje / 100), 2);;
                $producto->precio = $resultado;
                $producto->save();
            }
        }

        if($request->accion == "baja"){
            foreach($productos as $producto){
                $resultado = $producto->precio * (1 - $porcentaje / 100);
                $producto->precio = $resultado;
                $producto->save();
            }
        }

        return redirect()->route('formulario.precio');

    }

    public function controlStock(){
        $productos = Product::with('categorias')
        ->where('stock', '<=', 5)
        ->orderBy('stock','asc')
        ->get();

        return view("controlStock",compact('productos'));
    }

 
}
