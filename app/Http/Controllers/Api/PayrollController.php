<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        try {
            $payrolls = Payroll::all();
            return ResponseFormatter::success($payrolls, 'Payroll found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Leaves not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'salary' => 'required',
                'month' => 'required',
                'year' => 'required',
                'status' => 'required',
            ]);

            $payroll = new Payroll();
            $payroll->company_id = 1;
            $payroll->user_id = $request->user_id;
            $payroll->salary = $request->salary;
            $payroll->month = $request->month;
            $payroll->year = $request->year;
            $payroll->status = $request->status;
            $payroll->save();

            return ResponseFormatter::success($payroll, 'Payroll created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $payroll = Payroll::find($id);
            if (!$payroll) {
                return ResponseFormatter::error('Payroll not found', 404);
            }

            return ResponseFormatter::success($payroll, 'Payroll found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payroll = Payroll::find($id);
            if (!$payroll) {
                return ResponseFormatter::error('Payroll not found', 404);
            }

            $request->validate([
                'user_id' => 'required',
                'salary' => 'required',
                'month' => 'required',
                'year' => 'required',
                'status' => 'required',
            ]);

            $payroll->user_id = $request->user_id;
            $payroll->salary = $request->salary;
            $payroll->month = $request->month;
            $payroll->year = $request->year;
            $payroll->status = $request->status;
            $payroll->save();

            return ResponseFormatter::success($payroll, 'Payroll updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $payroll = Payroll::find($id);
            if (!$payroll) {
                return ResponseFormatter::error('Payroll not found', 404);
            }

            $payroll->delete();

            return ResponseFormatter::success($payroll, 'Payroll deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
