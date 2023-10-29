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
         Products::create([
            "nombre"=>$request->nombre,
            "descripcion"=>$request->descripcion,
            "precio"=>$request->precio,
            "imgUrl"=>$request->img,
        ]);

        return "Producto creado";
    }
    public function update(Request $request){
        $id = $request->id;
        $descripcion = $request->descripcion;
        $producto = Products::where('id',$id)->first();
        if(!$producto){
            return 'No existe producto';
        }
        $producto->descripcion = $descripcion;
        $producto->save();
        $producto = Products::where('id',$id)->first();

        return $producto;


    }
    public function search(Request $request){
        $param = $request->parametro;
        
        $palabras = explode(' ', $param);
        $terminoBusquedaFormateado = implode(' +', $palabras);
  
        $productos = Products::select('*')
        ->whereRaw("MATCH(nombre, descripcion) AGAINST(? IN BOOLEAN MODE)", [$terminoBusquedaFormateado])
        ->get();

        return $productos;
    }
}