<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// seeder para los roles y permisos    admin, secretaria, doctores, paciente, usuarios
        $admin = Role::create(['name'=>'admin']);
        $secretaria = Role::create(['name'=>'secretaria']);
        $doctor = Role::create(['name'=>'doctor']);
        $paciente = Role::create(['name'=>'paciente']);
        $usuario = Role::create(['name'=>'usuario']);




        Permission::create(['name'=>'admin.index']);

        // rutas para el admin - usuarios
        Permission::create(['name'=>'admin.usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.destroy'])->syncRoles([$admin]);

        // rutas para el admin - configuraciones
        Permission::create(['name'=>'admin.configuraciones.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuraciones.destroy'])->syncRoles([$admin]);


        ///// rutas para el admin - secretarias
        Permission::create(['name'=>'admin.secretarias.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.destroy'])->syncRoles([$admin]);

        ///// rutas para el admin - pacientes
        Permission::create(['name'=>'admin.pacientes.index'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pacientes.create'])->syncRoles([$admin,$secretaria,$usuario]);
        Permission::create(['name'=>'admin.pacientes.store'])->syncRoles([$admin,$secretaria, $usuario]);
        Permission::create(['name'=>'admin.pacientes.show'])->syncRoles([$admin,$secretaria, $usuario]);
        Permission::create(['name'=>'admin.pacientes.edit'])->syncRoles([$admin,$secretaria,$usuario]);
        Permission::create(['name'=>'admin.pacientes.update'])->syncRoles([$admin,$secretaria,$usuario]);
        Permission::create(['name'=>'admin.pacientes.confirmDelete'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pacientes.destroy'])->syncRoles([$admin,$secretaria]);

        ///// rutas para el admin - consultorios
        Permission::create(['name'=>'admin.consultorios.index'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.create'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.store'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.show'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.edit'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.update'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.confirmDelete'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.consultorios.destroy'])->syncRoles([$admin,$secretaria]);

        ///// rutas para el admin - doctores
        Permission::create(['name'=>'admin.doctores.index'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.create'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.store'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.show'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.edit'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.update'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.confirmDelete'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.destroy'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.reportes'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.doctores.pdf'])->syncRoles([$admin,$secretaria]);

        ///// rutas para el admin - horarios
        Permission::create(['name'=>'admin.horarios.index'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.create'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.store'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.show'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.edit'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.update'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.confirmDelete'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.horarios.destroy'])->syncRoles([$admin,$secretaria]);
        ////// ajax
        Permission::create(['name'=>'admin.horarios.cargar_datos_consultorios'])->syncRoles([$admin,$secretaria]);


        //// rutas para el usuario
        ///ajax
        Permission::create(['name'=>'cargar_datos_consultorios'])->syncRoles([$admin,$usuario]);
        Permission::create(['name'=>'cargar_reserva_doctores'])->syncRoles([$admin,$usuario]);
        Permission::create(['name'=>'ver_reservas'])->syncRoles([$admin,$usuario]);
        Permission::create(['name'=>'admin.eventos.create'])->syncRoles([$admin,$usuario]);
        Permission::create(['name'=>'admin.eventos.destroy'])->syncRoles([$admin,$usuario]);
        Permission::create(['name'=>'admin.eventos.list'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.eventos.view'])->syncRoles([$admin,$secretaria,$doctor]);

        // rutas para las reservas
        Permission::create(['name'=>'admin.reservas.reportes'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.reservas.pdf'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.reservas.pdf_fechas'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.reservas.index'])->syncRoles([$admin,$secretaria]);


        // rutas para el historial clinico
        Permission::create(['name'=>'admin.historial.index'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.create'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.store'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.pdf'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.show'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.edit'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.update'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.confirmDelete'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admisn.historial.destroy'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.buscar_paciente'])->syncRoles([$admin,$doctor]);
        Permission::create(['name'=>'admin.historial.imprimir_historial'])->syncRoles([$admin,$doctor]);

        // rutas para pagos
        Permission::create(['name'=>'admin.pagos.index'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.create'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.store'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.pdf'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.show'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.edit'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.update'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.confirmDelete'])->syncRoles([$admin,$secretaria]);
        Permission::create(['name'=>'admin.pagos.destroy'])->syncRoles([$admin,$secretaria]);
    }
}
