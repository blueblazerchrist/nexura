<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $departments = [
            'Administrativa y Financiera',
            'Ingeniería',
            'Desarrollo de Negocio',
            'Proyectos',
            'Servicios',
            'Calidad',
        ];

        foreach ($departments as $department) {
            \Illuminate\Support\Facades\DB::table('departments')->insert([
                'name' => $department
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
