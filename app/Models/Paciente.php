<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;


class Paciente extends Model
{
    use HasRoles, HasFactory;

    protected $fillable = ['nombres','apellidos','ci','fecha_nacimiento','genero','celular','correo','direccion','grupo_sanguineo','alergias','contacto_emergencia','observaciones','user_id','tipopaciente_id','tipoafiliacion_id'];

    protected $guard_name = 'web';



    public function pagos(){
        return $this->hasMany(Pago::class);
    }

    public function tipopaciente(){
        return $this->belongsTo(TipoPaciente::class,'tipopaciente_id');
    }

    public function tipoafiliacion(){
        return $this->belongsTo(TipoAfiliacion::class,'tipoafiliacion_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
