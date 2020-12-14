<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $listaRespuestas = Respuesta::all();
            return response()->json([
                "res"=> "success",
                "data" => $listaRespuestas
            ]);

        } catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al obtener los datos"
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),
            [
                'valor' => 'required|integer',
                'texto' => 'required',
                'pregunta_id' => 'required|integer',
                'orden' => 'required|integer',

            ]
        );
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "message" => $validator->messages()
            ]);
        }
        try {
            $objRespuesta = new Respuesta();
            $objRespuesta->fill($request->json()->all());
            $objRespuesta->save();
            return response()->json([
                "res" => "success",
                "data" => $objRespuesta
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al guardar Respuesta"
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $objRespuesta = Respuesta::find($id);
            if ($objRespuesta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado"
                ],404);
            }
            return response()->json([
                "res"=> "success",
                "data" => $objRespuesta
            ],200);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al obtener Respuesta"
            ],500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Respuesta $respuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->json()->all(),
            [
                'valor' => 'required|integer',
                'texto' => 'required',
                'orden' => 'required|integer',
                'pregunta_id' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "message" => $validator->messages()
            ]);
        }
        try {
            $objRespuesta = Respuesta::find($id);
            if ($objRespuesta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado"
                ],404);
            }
            $objRespuesta->fill($request->json()->all());
            $objRespuesta->save();
            return response()->json([
                "res" => "success",
                "data" => $objRespuesta
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al actualizar Respuesta"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $objRespuesta = Respuesta::find($id);
            if ($objRespuesta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado para eliminar"
                ],404);
            }
            $objRespuesta->delete();
            return response()->json([
                "res" => "success"
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al querer eliminar Respuesta"
            ],500);
        }
    }
    public function archivoStore(Request $request)
    {
        try {

            $file = $request->file('texto');
            $archivo = time() . $file->getClientOriginalName();
            //$file->move(public_path('/') . "archivos/", $archivo);
            $file->move (public_path() . '/archivo/',$archivo);


            $valor = $request->get('valor');
            $orden = $request->get('orden');
            $preguntaId = $request->get('pregunta_id');

            $objArchivoRespuesta = new Respuesta();
            $objArchivoRespuesta->valor = $valor;
            $objArchivoRespuesta->texto = $archivo;
            $objArchivoRespuesta->pregunta_id = $preguntaId;
            $objArchivoRespuesta->orden = $orden;


            $objArchivoRespuesta->save();
            return response()->json([
                "res" => "success",
                "data" => $objArchivoRespuesta
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res" => "error",
                "data" => $e->getMessage()
            ], 500);
        }
    }
    public function archivoUpdate(Request $request, $id){


        $objRespuesta = Respuesta::find($id);

        try {

            if ($objRespuesta == null) {
                return response()->json([
                    "res" => "error",
                    "message" => "Objeto no encontrado"
                ], 404);
            }

            $file = $request->file('texto');
            $archivo = time() . $file->getClientOriginalName();
            //$file->move(public_path('/') . "archivos/", $archivo);
            $file->move (public_path() . '/archivo/',$archivo);


            $valor = $request->get('valor');
            $orden = $request->get('orden');
            $preguntaId = $request->get('pregunta_id');


            $objRespuesta->valor = $valor;
            $objRespuesta->texto = $archivo;
            $objRespuesta->pregunta_id = $preguntaId;
            $objRespuesta->orden = $orden;


            $objRespuesta->save();
            return response()->json([
                "res" => "success",
                "data" => $objRespuesta
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res" => "error",
                "data" => $e->getMessage()
            ], 500);
        }
    }
}
