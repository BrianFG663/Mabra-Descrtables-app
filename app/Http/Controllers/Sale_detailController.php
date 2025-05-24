<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Sale_detail;
use Illuminate\Http\Request;

class Sale_detailController extends Controller
{
public function eliminarProductoVenta(Request $request)
{
    $id = $request->input('id');
    $detalle = Sale_detail::find($id);

    if ($detalle) {
        $detalle->delete();
    }

    $sale_id = $request->input('sale_id');
    $sale = Sale::find($sale_id);

    if (!$sale) {
        return response()->json(['error' => 'Venta no encontrada'], 404);
    }else{
        $detalles_venta = $sale->sales_details;

        if ($detalles_venta->isEmpty()) {
            return response()->json(['detalles' => "false"]);
        }else{
            return response()->json(['detalles' => "true"]);
        }
    }

    


}
}
