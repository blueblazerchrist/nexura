<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department\Department;
use App\Models\Employee\Employee;
use App\Models\Role\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('employee.create', compact('roles', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $requestEmployee = $request->all();
        $employee = Employee::create($requestEmployee);
        $employee->roles()->sync($requestEmployee['roles']);
        return  redirect()->route('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
