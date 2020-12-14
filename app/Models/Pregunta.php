<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pregunta
 *
 * @property int $id
 * @property string $titulos
 * @property int $tipoPregunta 0=RadioButton,1=Checkbox,2=Input,3=Archivo,4=Textarea
 * @property int $cantidadArchivos
 * @property int $ordenEspecifico
 * @property int $encuesta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Encuesta $encuesta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Respuesta[] $respuestas
 * @property-read int|null $respuestas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereCantidadArchivos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereEncuestaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereOrdenEspecifico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereTipoPregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereTitulos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pregunta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pregunta extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function encuesta(){
        return $this->belongsTo(Encuesta::class,'encuesta_id');
    }
    public function respuestas(){
        return $this->hasMany(Respuesta::class);
    }
}
