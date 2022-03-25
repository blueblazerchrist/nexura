<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->char('gender', 1);
            $table->unsignedBigInteger('department_id');
            $table->integer('newsletter');
            $table->text('description');
            $table->timestamps();
        });

        $employees = [
            [
                'id' => 3,
                'name' => 'Pedro Pérez',
                'email' => 'pperez@example.co',
                'gender' => 'M',
                'department_id' => '5',
                'newsletter' => '1',
                'description' => 'Hola mundo',
            ],
            [
                'id' => 4,
                'name' => 'Amalia Bayona',
                'email' => 'abayona@example.co',
                'gender' => 'F',
                'department_id' => '8',
                'newsletter' => '0',
                'description' => 'Para contactar a Amalia Bayona, puede escribir al correo electrónico abayona@example.co',
            ]
        ];

        foreach ($employees as $employee) {
            \Illuminate\Support\Facades\DB::table('employees')->insert([
                'id' => $employee['id'],
                'name' => $employee['name'],
                'email' => $employee['email'],
                'gender' => $employee['gender'],
                'department_id' => $employee['department_id'],
                'newsletter' => $employee['newsletter'],
                'description' => $employee['description'],
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
        Schema::dropIfExists('employees');
    }
}
