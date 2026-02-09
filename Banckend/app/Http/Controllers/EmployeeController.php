<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class EmployeeController extends Controller
{
    // MAIN PAGE
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    // STORE NEW EMPLOYEE
    public function store(Request $request)
    {
        $employee = Employee::create($request->all());
        return response()->json(['success' => true, 'message' => 'Employee added successfully']);
    }

    // HANDLE EDIT / UPDATE / DELETE USING SAME ROUTE
    public function action(Request $request)
    {
        $type = $request->type;

        if ($type == 'edit') {
            return Employee::find($request->id);
        }

        if ($type == 'update') {
            $emp = Employee::find($request->id);
            $emp->update($request->all());
            return response()->json(['success' => true, 'message' => 'Employee updated']);
        }

        if ($type == 'delete') {
            Employee::find($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Employee deleted']);
        }
    }

    public function showNew($id)
    {
        $employee = Employee::findOrFail($id);
        $barcode = new DNS1D();
        $barcode2 = new DNS2D();
        return view('employees.show', compact('employee', 'barcode', 'barcode2'));
    }
}
