<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        try {
            $leaveTypes = LeaveType::all();
            return ResponseFormatter::success($leaveTypes, 'Leave type found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Leave type not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'is_paid' => 'required',
                'total_leaves' => 'required',
                'max_leave_per_month' => 'nullable',
            ]);

            $leaveType = new LeaveType();
            $leaveType->company_id = 1;
            $leaveType->name = $request->name;
            $leaveType->is_paid = $request->is_paid;
            $leaveType->total_leaves = $request->total_leaves;
            $leaveType->max_leave_per_month = $request->max_leave_per_month;
            $leaveType->created_by = $request->user()->id;
            $leaveType->save();

            return ResponseFormatter::success($leaveType, 'Leave type created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $leaveType = LeaveType::find($id);
            if (!$leaveType) {
                return ResponseFormatter::error('Leave type not found', 404);
            }

            return ResponseFormatter::success($leaveType, 'Leave type found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'is_paid' => 'required',
                'total_leaves' => 'required',
                'max_leave_per_month' => 'nullable',
            ]);

            $leaveType = LeaveType::find($id);
            if (!$leaveType) {
                return ResponseFormatter::error('Leave type not found', 404);
            }

            $leaveType->name = $request->name;
            $leaveType->is_paid = $request->is_paid;
            $leaveType->total_leaves = $request->total_leaves;
            $leaveType->max_leave_per_month = $request->max_leave_per_month;
            $leaveType->save();

            return ResponseFormatter::success($leaveType, 'Leave type updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $leaveType = LeaveType::find($id);
            if (!$leaveType) {
                return ResponseFormatter::error('Leave type not found', 404);
            }

            $leaveType->delete();

            return ResponseFormatter::success($leaveType, 'Leave type deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
