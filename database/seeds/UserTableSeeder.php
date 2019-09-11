<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the datnabase seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name','admin')->first();
        $role_estudiante = Role::where('name','estudiante')->first();
        $role_profe = Role::where('name','profe')->first();


        $admin = new User();
        $admin->rut = "19386";
        $admin->name = "admin";
        $admin->email = "admin@ucm.cl";
        $admin->password = bcrypt('admin');
        $admin->tipo = "admin";
        $admin->save();
        $admin->roles()->attach($role_admin);

        $estudiante = new User();
        $estudiante->rut = "19111";
        $estudiante->name = "estudiante1";
        $estudiante->email = "est1@ucm.cl";
        $estudiante->password = bcrypt('est1');
        $estudiante->tipo = "estudiante";
        $estudiante->save();
        $estudiante->roles()->attach($role_estudiante);

        $estudiante = new User();
        $estudiante->rut = "19222";
        $estudiante->name = "estudiante2";
        $estudiante->email = "est2@ucm.cl";
        $estudiante->password = bcrypt('est2');
        $estudiante->tipo = "estudiante";
        $estudiante->save();
        $estudiante->roles()->attach($role_estudiante);

        $profe = new User();
        $profe->rut = "20111";
        $profe->name = "profesor1";
        $profe->email = "prof1@ucm.cl";
        $profe->password = bcrypt('prof1');
        $profe->tipo = "profe";
        $profe->save();
        $profe->roles()->attach($role_profe);

        $profe = new User();
        $profe->rut = "20222";
        $profe->name = "profesor2";
        $profe->email = "prof2@ucm.cl";
        $profe->password = bcrypt('prof2');
        $profe->tipo = "profe";
        $profe->save();
        $profe->roles()->attach($role_profe);
    }
}
