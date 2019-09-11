<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the n
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "admin";
        //$role->description = "Administrador";
        $role->save();

        $role1 = new Role();
        $role1->name = "student";
        //$role1->description = "Estudiante";
        $role1->save();

        $role2 = new Role();
        $role2->name = "profesor";
        //$role2->description = "Profesor";
        $role2->save();
    }
}
