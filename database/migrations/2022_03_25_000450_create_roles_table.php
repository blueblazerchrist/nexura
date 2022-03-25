<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('roles_has_employees', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('employee_id');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');

            $table->primary(['role_id', 'employee_id'], 'role_has_employee_role_id_employee_id_primary');
        });

        $roles = [
            'Desarrollador',
            'Analista',
            'Tester',
            'Diseñador',
            'Profesional PMO',
            'Profesional de servicios',
            'Auxiliar administrativo',
            'Codirector',
        ];

        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('roles')->insert([
                'name' => $role
            ]);
        }

        $roles_has_employees = [
            [
                'employee_id' => '3',
                'role_id' => '4',
            ],
            [
                'employee_id' => '3',
                'role_id' => '7',
            ],
            [
                'employee_id' => '3',
                'role_id' => '2',
            ],
            [
                'employee_id' => '4',
                'role_id' => '1',
            ],
            [
                'employee_id' => '4',
                'role_id' => '2',
            ]
        ];
        foreach ($roles_has_employees as $roles_has_employee) {
            \Illuminate\Support\Facades\DB::table('roles_has_employees')->insert([
                'employee_id' => $roles_has_employee['employee_id'],
                'role_id' => $roles_has_employee['role_id'],
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('roles_has_employees');
    }
}
