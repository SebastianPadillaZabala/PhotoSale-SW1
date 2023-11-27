<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Aws\Rekognition\RekognitionClient;
use App\Models\Curso;

class Cursos_Controller extends Controller
{
    public function index()
    {   
        $list = DB::table('cursos')->where('estado','=',"Aceptado" )->get();
        $cursos=[];
        foreach($list as $item){
    
         
         $curso = new \stdClass();
         $curso->id=$item->id_curso;
         $curso->nombreCurso = $item->nombreCurso;
         $curso->image = $item->image;
         $curso->descripcion = $item->descripcion;
         $curso->cantidad_clases=$item->cantidad_clases;
         $curso->estado = $item->estado;
         $curso->fecha = $item->fecha;
         $curso->id_prof = $item->id_prof;
         $curso->id_categoria =$item->id_categoria;
         array_push($cursos, $curso);
        }
         return response()->json($cursos);
    }
    public function get_by_Categorias()
    { }

    public function categorias()
    {    $response = [
        'data' => 'aceptado',
    ];
         return response()->json($response, 200);
    }

    //Funcion que activa la IA, foto que se envia desde flutter
    public function store(Request $request)
    {  
        if($request->hasFile('file')){
            $client = new RekognitionClient([
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest'
            ]);

            $image = fopen($request->file('file')->getPathname(),'r');
            $bytes = fread($image, $request->file('file')->getSize());

            $result = $client->detectFaces([
                'Image' => ['Bytes' => $bytes],
                "Attributes" => ["ALL"]
            ]);

            $resultLabels = $result->get('FaceDetails');

            if($resultLabels[0]['Gender']['Value'] == 'Female'){
                //dd('aceptado');
                //return response('aceptado');
                $response = [
                    'data' => 'aceptado',
                ];
                return response()->json($response, 200);
            }else{
               //dd('rechazado');
               $response = [
                'data' => 'rechazado',
               ];
               // return response('rechazado');
                return response()->json($response, 201);
            }
        }
    }

}
