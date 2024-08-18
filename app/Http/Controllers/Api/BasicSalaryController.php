<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BasicSalary;
use Illuminate\Http\Request;

class BasicSalaryController extends Controller
{
    public function index()
    {
        try {
            $basicSalaries = BasicSalary::all();
            return ResponseFormatter::success($basicSalaries, 'BasicSalary found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('BasicSalary not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'basic_salary' => 'required',
                'user_id' => 'required',
            ]);

            $basicSalary = new BasicSalary();
            $basicSalary->company_id = 1;
            $basicSalary->user_id = $request->user_id;
            $basicSalary->basic_salary = $request->basic_salary;
            $basicSalary->save();

            return ResponseFormatter::success($basicSalary, 'Basic Salary created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $basicSalary = BasicSalary::find($id);
            if (!$basicSalary) {
                return ResponseFormatter::error('Basic Salary not found', 404);
            }
            return ResponseFormatter::success($basicSalary, 'Basic Salary found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'basic_salary' => 'required',
                'user_id' => 'required',
            ]);

            $basicSalary = BasicSalary::find($id);
            if (!$basicSalary) {
                return ResponseFormatter::error('Basic Salary not found', 404);
            }

            $basicSalary->basic_salary = $request->basic_salary;
            $basicSalary->user_id = $request->user_id;
            $basicSalary->save();

            return ResponseFormatter::success($basicSalary, 'Basic Salary updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $basicSalary = BasicSalary::find($id);
            if (!$basicSalary) {
                return ResponseFormatter::error('Basic Salary not found', 404);
            }

            $basicSalary->delete();

            return ResponseFormatter::success($basicSalary, 'Basic Salary deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
