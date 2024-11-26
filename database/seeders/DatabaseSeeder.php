<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Configuracione;
use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Secretaria;
use App\Models\Paciente;
use App\Models\TipoAfiliacion;
use App\Models\TipoPaciente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([RoleSeeder::class,]);


        User::create([
            'name'=>'Administrador',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('admin');




        User::create([
            'name'=>'Secretaria',
            'email'=>'secretaria@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('secretaria');

        Secretaria::create([
            'nombres' => 'Secretaria',
            'apellidos' => '1',
            'ci' => '111111',
            'celular' => '777777777',
            'fecha_nacimiento' => '10/10/2000',
            'direccion' => 'Zona Miraflores calle 5',
            'user_id' =>'2'
        ]);




        User::create([
            'name'=>'Doctor1',
            'email'=>'doctor1@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor1',
            'apellidos' => 'Swift',
            'telefono' => '74774634',
            'licencia_medica' => '8874734',
            'especialidad' => 'PEDIATRIA',
            'user_id' =>'3'
        ]);



        User::create([
            'name'=>'Doctor2',
            'email'=>'doctor2@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor2',
            'apellidos' => 'Barrientos',
            'telefono' => '747732323',
            'licencia_medica' => '22222222',
            'especialidad' => 'ODONTOLOGIA',
            'user_id' =>'4'
        ]);

        User::create([
            'name'=>'Doctor3',
            'email'=>'doctor3@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor3',
            'apellidos' => 'Valdez',
            'telefono' => '733333333',
            'licencia_medica' => '3333333333',
            'especialidad' => 'FISIOTERAPIA',
            'user_id' =>'5'
        ]);


        Consultorio::create([
            'nombre' => 'PEDIATRIA',
            'ubicacion' => '1-1A',
            'capacidad' => '10',
            'telefono' => '',
            'especialidad' => 'PEDIATRIA',
            'estado' => 'ACTIVO',
        ]);
        Consultorio::create([
            'nombre' => 'FISIOTERAPIA',
            'ubicacion' => '3-1A',
            'capacidad' => '20',
            'telefono' => '3773663',
            'especialidad' => 'FISIOTERAPIA',
            'estado' => 'ACTIVO',
        ]);
        Consultorio::create([
            'nombre' => 'ODONTOLOGIA',
            'ubicacion' => '2-1A',
            'capacidad' => '5',
            'telefono' => '83773883',
            'especialidad' => 'ODONTOLOGIA',
            'estado' => 'ACTIVO',
        ]);


        TipoAfiliacion::create([
            'nombre'=>'Subsidiada',
            'detalle'=>'Este tipo de afiliación se refiere a personas que no pueden realizar aportes económicos al sistema de salud debido a su situación económica',
        ]);

        TipoAfiliacion::create([
            'nombre'=>'Contributiva',
            'detalle'=>'Abarca a las personas que sí realizan aportes al sistema de salud, como trabajadores formales que contribuyen a través de su salario o aquellos que pagan un seguro de salud privado',
        ]);

        TipoPaciente::create([
            'nombre'=>'Titular',
            'detalle'=>'El titular es la persona que es el principal beneficiario de los servicios de salud, generalmente quien realiza el pago o está a cargo de la afiliación al sistema de salud, ya sea contributivo o subsidiado.',
        ]);

        TipoPaciente::create([
            'nombre'=>'Dependiente',
            'detalle'=>'Son aquellos pacientes que están cubiertos por la afiliación de un titular, como los hijos, cónyuges o dependientes económicos.',
        ]);

        User::create([
            'name'=>'Paciente1',
            'email'=>'paciente1@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('paciente');

        Paciente::create([
            'nombres' => 'Omar',
            'apellidos' => 'Vasquez',
            'ci' => '12345678',
            'fecha_nacimiento' => '2002-10-10',
            'genero' => 'M',
            'celular' => '300423912',
            'correo' => 'paciente1@admin.com',
            'direccion' => 'Carrera 50 #45-90 apto 100 casas 56',
            'grupo_sanguineo' => 'A+',
            'alergias' => 'No presenta()',
            'contacto_emergencia' => '300423910',
            'observaciones' => 'No presenta()',
            'user_id' => '6',
            'tipoafiliacion_id' => '1',
            'tipopaciente_id' => '1',
        ]);

        User::create([
            'name'=>'Paciente2',
            'email'=>'paciente2@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('paciente');

        Paciente::create([
            'nombres' => 'Johan Sebastian',
            'apellidos' => 'Quintero',
            'ci' => '21345778',
            'fecha_nacimiento' => '2002-10-10',
            'genero' => 'M',
            'celular' => '3124508990',
            'correo' => 'paciente2@admin.com',
            'direccion' => 'Carrera 45 #12-90 apto 90',
            'grupo_sanguineo' => 'A+',
            'alergias' => 'No presenta()',
            'contacto_emergencia' => '3124508990',
            'observaciones' => 'No presenta()',
            'user_id' => '7',
            'tipoafiliacion_id' => '1',
            'tipopaciente_id' => '2',
        ]);

        User::create([
            'name'=>'Usuario1',
            'email'=>'usuario1@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('usuario');

        $this->call([PacienteSeeder::class,]);





        /////creacion de horarios
        Horario::create([
            'dia'=>'LUNES',
            'hora_inicio'=>'08:00:00',
            'hora_fin'=>'14:00:00',
            'doctor_id'=>'1',
            'consultorio_id'=>'1'
        ]);


        Configuracione::create([
            'nombre'=>'Hospital Regional Olaya Herrera',
            'direccion'=>' Barrio San José de, Cra. 12 #8-44, Gamarra, Cesar',
            'telefono'=>'317 2458489 - 3773663773',
            'correo'=>'info@olayaherrera.com',
            'logo'=>'logos/BAaMiuyHHGWAjfaWLlWaEhnZcRANInuUmCMnk7TD.jpg'
        ]);
    }
}
