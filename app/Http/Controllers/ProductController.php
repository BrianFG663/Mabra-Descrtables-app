<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function formularioProducto(){

        $categorias = Category::all();
        return view('agregararticulo',compact('categorias'));
        
    }

    public function agregarProducto(Request $request){
        
        $producto = Product::create([
            'nombre'=>$request->name,
            'descripcion'=>$request->descripcion,
            'precio'=>$request->precio,
            'stock'=>$request->stock
        ]);
        
        $producto->categorias()->attach($request->categoria);

        return view('inicio');

    }

    public function buscarProducto(Request $request){

        $id = $request->input('id');

        $producto = Product::find($id);
        $categorias = $producto->categorias;



        return response()->json(['producto'=>$producto, 'categorias'=>$categorias]);
    }
}
