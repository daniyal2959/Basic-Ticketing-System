<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate(7);
        return view('Dashboard.Departments.all', compact('departments'));
    }

    public function create()
    {
        return view('Dashboard.Departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->save();

        return back();
    }

    public function delete(Request $request)
    {
        $department = Department::find($request->_id);
        $department->delete();

        return back();
    }

    public function edit(Department $department)
    {
        return view('Dashboard.Departments.create', compact('department'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $department = Department::find($request->_id);
        $department->name = $request->name;
        $department->save();

        return redirect()->route('allDepartments');
    }
}
