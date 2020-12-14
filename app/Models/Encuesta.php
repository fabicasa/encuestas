<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Encuesta
 *
 * @property int $id
 * @property string $titulos
 * @property string $descripcion
 * @property string $fechaIniciollenado
 * @property string $fechaFinalizacionllenado
 * @property int $requiereCorreos 0=Si,1=No
 * @property int $requiereInicioSesion 0 = Si, 1 = No
 * @property int $contarRespuestas
 * @property int $estado 0=cerrada,1=abierta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pregunta[] $preguntas
 * @property-read int|null $preguntas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereContarRespuestas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereFechaFinalizacionllenado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereFechaIniciollenado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereRequiereCorreos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereRequiereInicioSesion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereTitulos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Encuesta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Encuesta extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

/*    public function preguntas(){
        return $this->hasMany(Pregunta::class);
    }*/
}
