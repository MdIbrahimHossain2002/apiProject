<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeApiController extends Controller
{
    public function index()
    {
        return response()->json(Employee::all());
    }

    public function New(){
        return 'This is Employee New API';
    }

    public function store(Request $request)
    {
        $emp = Employee::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Employee created',
            'data' => $emp
        ]);
    }

    public function update(Request $request)
    {
        $emp = Employee::find($request->id);

        if (!$emp) {
            return response()->json(['success' => false, 'message' => 'Employee not found']);
        }

        $emp->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Employee updated',
            'data' => $emp
        ]);
    }

    public function delete(Request $request)
    {
        $emp = Employee::find($request->id);

        if (!$emp) {
            return response()->json(['success' => false, 'message' => 'Employee not found']);
        }

        $emp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted'
        ]);
    }
}
