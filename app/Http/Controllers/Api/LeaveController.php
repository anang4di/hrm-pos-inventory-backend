<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        try {
            $leaves = Leave::all();
            return ResponseFormatter::success($leaves, 'Leaves found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Leaves not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'leave_type_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'is_half_day' => 'required',
                'total_days' => 'required',
                'is_paid' => 'required',
                'reason' => 'required',

            ]);

            $leave = new Leave();
            $leave->user_id = $request->user_id;
            $leave->leave_type_id = $request->leave_type_id;
            $leave->start_date = $request->start_date;
            $leave->end_date = $request->end_date;
            $leave->is_half_day = $request->is_half_day;
            $leave->total_days = $request->total_days;
            $leave->is_paid = $request->is_paid;
            $leave->reason = $request->reason;
            $leave->status = 'pending';
            $leave->save();

            return ResponseFormatter::success($leave, 'Leave created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $leave = Leave::find($id);
            if (!$leave) {
                return ResponseFormatter::error('Leave not found', 404);
            }

            return ResponseFormatter::success($leave, 'Leave found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'leave_type_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'is_half_day' => 'required',
                'total_days' => 'required',
                'is_paid' => 'required',
                'reason' => 'required',
                'status' => 'required',
            ]);

            $leave = Leave::find($id);
            if (!$leave) {
                return ResponseFormatter::error('Leave not found', 404);
            }

            $leave->user_id = $request->user_id;
            $leave->leave_type_id = $request->leave_type_id;
            $leave->start_date = $request->start_date;
            $leave->end_date = $request->end_date;
            $leave->is_half_day = $request->is_half_day;
            $leave->total_days = $request->total_days;
            $leave->is_paid = $request->is_paid;
            $leave->reason = $request->reason;
            $leave->status = $request->status;
            $leave->save();

            return ResponseFormatter::success($leave, 'Leave updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $leave = Leave::find($id);
            if (!$leave) {
                return ResponseFormatter::error('Leave not found', 404);
            }

            $leave->delete();

            return ResponseFormatter::success($leave, 'Leave deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
