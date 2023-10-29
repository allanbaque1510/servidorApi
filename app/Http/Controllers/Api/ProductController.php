<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $productos = Products::all();
        return $productos;
    }
    public function store(Request $request){
        $productos = Products::create([
            "nombre"=>$request->nombre,
            "descripcion"=>$request->descripcion,
            "precio"=>$request->precio,
            "imgUrl"=>$request->img,
        ]);

        return "Producto creado";
    }
}