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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

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
     * @param Employee $employee
     * @return Response
     */
    public function show(Employee $employee)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return Application|Factory|View
     */
    public function edit(Employee $employee)
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('employee.edit',compact('employee', 'roles', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        if ($request->has('name')) {
            $employee->name = $request->get('name');
        }

        if ($request->has('email')) {
            $employee->email = $request->get('email');
        }

        if ($request->has('gender')) {
            $employee->gender = $request->get('gender');
        }

        if ($request->has('department_id')) {
            $employee->department_id = $request->get('department_id');
        }

        if ($request->has('newsletter')) {
            $employee->newsletter = $request->get('newsletter');
        } else {
            $employee->newsletter = 0;
        }

        if ($request->has('description')) {
            $employee->description = $request->get('description');
        }

        $employee->roles()->sync($request->get('roles'));

        if ($employee->isClean()) {
            return redirect()->route('employees.edit',$employee->id);
        }

        $employee->save();
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['status'=> true]);
    }
}
