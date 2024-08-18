<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $departments = Department::all();
            return ResponseFormatter::success($departments, 'Departments found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Departments not found', 404);
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $user = $request->user();

            $department = new Department();
            $department->company_id = 1;
            $department->created_by = $user->id;
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            return ResponseFormatter::success($department, 'Department created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                return ResponseFormatter::error('Department not found', 404);
            }
            return ResponseFormatter::success($department, 'Department found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $department = Department::find($id);
            if (!$department) {
                return ResponseFormatter::error('Department not found', 404);
            }

            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            return ResponseFormatter::success($department, 'Department updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                return ResponseFormatter::error('Department not found', 404);
            }

            $department->delete();

            return ResponseFormatter::success($department, 'Department deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
