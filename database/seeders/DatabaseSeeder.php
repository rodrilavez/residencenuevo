<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Zona;
use App\Models\Propiedad;
use App\Models\Residente;
use App\Models\Guardia;
use App\Models\Horario;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $guardUser = User::create([
            'name' => 'Guardia 1',
            'email' => 'guardia1@example.com',
            'password' => Hash::make('password'),
            'role' => 'guard'
        ]);

        $residenteUser = User::create([
            'name' => 'Residente 1',
            'email' => 'residente1@example.com',
            'password' => Hash::make('password'),
            'role' => 'residente'
        ]);

        $zona1 = Zona::create(['nombre'=>'Zona A','descripcion'=>'Cluster principal']);
        $zona2 = Zona::create(['nombre'=>'Zona B','descripcion'=>'Cluster secundario']);

        $prop1 = Propiedad::create([
            'zona_id'=>$zona1->id,
            'nombre'=>'Casa 101',
            'descripcion'=>'Casa en zona A',
            'es_amenidad'=>false
        ]);

        $amenidad = Propiedad::create([
            'zona_id'=>$zona1->id,
            'nombre'=>'Piscina Comunitaria',
            'descripcion'=>'Piscina de la zona A',
            'es_amenidad'=>true
        ]);

        Residente::create([
            'user_id'=>$residenteUser->id,
            'propiedad_id'=>$prop1->id,
            'telefono'=>'555-1234'
        ]);

        $guardia1 = Guardia::create([
            'user_id'=>$guardUser->id,
            'zona_id'=>$zona1->id
        ]);

        Horario::create([
            'guardia_id'=>$guardia1->id,
            'inicio'=>now(),
            'fin'=>now()->addHours(8),
        ]);
    }
}
