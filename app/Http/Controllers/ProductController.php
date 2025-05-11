<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

        return view('formularioEditarProducto', compact('producto'));
    }
}
