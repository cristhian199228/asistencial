<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Articulo;

class VariosController extends Controller
{
    

    public function vacinglespdf(){
        $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre',
            'categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock',
            'articulos.descripcion','articulos.condicion')
            ->orderBy('articulos.nombre', 'asc')->get();

        $cont=Articulo::count();

        $pdf = \PDF::loadView('pdf.atenciondirecta',['articulos'=>$articulos,'cont'=>$cont])->setPaper('a4', 'portrait');
        //return $pdf->download('articulos.pdf');
       
        return $pdf->stream('articulos.pdf');

    }

   

}
