<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate(7);
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.Departments.all', compact('departments', 'ticketStatuses'));
    }

    public function create()
    {
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.Departments.create', compact('ticketStatuses'));
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
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.Departments.create', compact('department', 'ticketStatuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $department = Department::find($request->_id);
        $department->name = $request->name;
        $department->save();

        return redirect()->route('dashboard.departments.allDepartments');
    }
}
