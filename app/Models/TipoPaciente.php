<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPaciente extends Model
{
    // Definimos la tabla manualmente si no sigue la convención.
    protected $table = 'tipopaciente';

    use HasFactory;

    protected $fillable = ['nombre','detalle'];

    public function pacientes(){
        return $this->hasMany(Paciente::class);
    }
}
