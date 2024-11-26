<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAfiliacion extends Model
{
    // Definimos la tabla manualmente si no sigue la convención.
    protected $table = 'tipoafiliacion';
    
    use HasFactory;

    protected $fillable = ['nombre','detalle'];

    public function pacientes(){
        return $this->hasMany(Paciente::class);
    }
}
