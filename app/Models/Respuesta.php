<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Respuesta
 *
 * @property int $id
 * @property int $valor
 * @property string $texto
 * @property int $pregunta_id
 * @property int $orden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pregunta $pregunta
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta wherePreguntaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta whereTexto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Respuesta whereValor($value)
 * @mixin \Eloquent
 */
class Respuesta extends Model
{
    use HasFactory;
    protected $guarded =["id"];
    public function pregunta(){
        return $this->belongsTo(Pregunta::class,'pregunta_id');
    }
}
