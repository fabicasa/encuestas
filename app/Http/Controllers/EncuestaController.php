<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
        //$listaEncuentas = Encuesta::with('preguntas')->get();
        $listaEncuentas=Encuesta::all();
        return response()->json([
            "res"=>"success",
            "data"=>$listaEncuentas
        ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al obtener la lista de datos"
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),
            [
                'titulos' => 'required',
                'descripcion' => 'required',
                'requiereCorreos' => 'required|integer',
                'requiereInicioSesion' => 'required|integer',
                'estado' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "message" => $validator->messages()
            ]);
        }
        try {
            $objEncuesta = new Encuesta();
            $objEncuesta->fill($request->json()->all());
            $objEncuesta->save();
            return response()->json([
                "res" => "success",
                "data" => $objEncuesta
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al guardar Encuesta"
            ],500);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id)
    {
        try {
            $objEncuesta = Encuesta::find($id);
            if ($objEncuesta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado"
                ],404);
            }
            return response()->json([
                "res"=> "success",
                "data" => $objEncuesta
            ],200);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al obtener Encuesta"
            ],500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Encuesta $encuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->json()->all(),
            [
                'titulos' => 'required',
                'descripcion' => 'required',
                'requiereCorreos' => 'required|integer',
                'requiereInicioSesion' => 'required|integer',
                'estado' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "message" => $validator->messages()
            ]);
        }
        try {
            $objEncuesta = Encuesta::find($id);
            if ($objEncuesta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado"
                ],404);
            }
            $objEncuesta->fill($request->json()->all());
            $objEncuesta->save();
            return response()->json([
                "res" => "success",
                "data" => $objEncuesta
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al actualizar Encuesta"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $objEncuesta = Encuesta::find($id);
            if ($objEncuesta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado para eliminar"
                ],404);
            }
            $objEncuesta->delete();
            return response()->json([
                "res" => "success"
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al intentar eliminar Encuesta"
            ],500);
        }
    }
}
