<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Definir los estados posibles como constantes
    const STATUS_PENDING = 'Pendiente';
    const STATUS_ASSISTED = 'Si asistió';
    const STATUS_NOT_ASSISTED = 'No asistió';
    const STATUS_POSTPONED = 'Aplazado';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }

    public function historial(){
        return $this->hasMany(Historial::class);
    }



    /**
     * Acceder a los estados como propiedades de la clase
     */

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ASSISTED,
            self::STATUS_NOT_ASSISTED,
        ];
    }

}
