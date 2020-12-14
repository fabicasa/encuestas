<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Factory;
class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //$listaPregunta = Pregunta::with('dueno')->get();
            $listaPregunta =Pregunta::all();
            return response()->json([
                "res"=> "success",
                "data" => $listaPregunta
            ]);

        } catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al obtener la lista Preguntas "
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
    public function store(Request $request,$encuesta_id)
    {
        $validator = Validator::make($request->json()->all(),
            [
                'titulos' => 'required',
                'tipoPregunta' => 'required',
                'cantidadArchivos' => 'required|integer',
                'ordenEspecifico' => 'required|integer',
                'encuesta_id' => 'required|integer',

            ]
        );
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "message" => $validator->messages()
            ]);
        }
        try {
            $objPregunta = new Pregunta();
            $objPregunta->fill($request->json()->all());
            $objPregunta->save();
            $listaPreguntas = DB::table('preguntas')->where('preguntas.encuesta_id','=',$encuesta_id)->get();
            return response()->json([
                "res" => "success",
                "data" =>  $listaPreguntas
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al guardar pregunta"
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            //$objPregunta = Pregunta::with('opcionespuestas')->find($id);
            $listaPreguntas=DB::table('preguntas')->where('preguntas.encuesta_id','=',$id)->get();
            if ( $listaPreguntas == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado"
                ],404);
            }
            return response()->json([
                "res"=> "success",
                "data" =>  $listaPreguntas
            ],200);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al obtener Preguntas "
            ],500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregunta $pregunta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->json()->all(),
            [
                'titulos' => 'required',
                'tipoPregunta' => 'required',
                'cantidadArchivos' => 'required|integer',
                'ordenEspecifico' => 'required|integer',
                'encuesta_id' => 'required|integer',

            ]
        );
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "message" => $validator->messages()
            ]);
        }
        try {
            $objPregunta = Pregunta::find($id);
            if ( $objPregunta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado"
                ],404);
            }
            $objPregunta->fill($request->json()->all());
            $objPregunta->save();
            return response()->json([
                "res" => "success",
                "data" =>  $objPregunta
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al actualizar la Pregunta"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $objPregunta = Pregunta::find($id);
            if ( $objPregunta == null){
                return response()->json([
                    "res"=> "error",
                    "data" => "Objeto no encontrado para eliminar"
                ],404);
            }
            $objPregunta->delete();
            return response()->json([
                "res" => "success"
            ]);
        }catch (\Exception $e){
            report($e);
            return response()->json([
                "res"=> "error",
                "data" => "Error al intentar eliminar la Pregunta"
            ],500);
        }
    }
}
