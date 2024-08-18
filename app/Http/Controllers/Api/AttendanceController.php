<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        try {
            $attendance = Attendance::all();
            return ResponseFormatter::success($attendance, 'Attendance found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Attendance not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required',
                'user_id' => 'required',
                'is_holiday' => 'nullable',
                'is_leave' => 'nullable',
                'leave_id' => 'nullable',
                'holiday_id' => 'nullable',
                'clock_in_date_time' => 'required',
                'clock_out_date_time' => 'nullable',
                'total_duration' => 'nullable',
                'is_late' => 'nullable',
                'is_half_day' => 'nullable',
                'is_paid' => 'nullable',
                'status' => 'nullable',
                'reason' => 'nullable',
            ]);

            $attendance = new Attendance();
            $attendance->company_id = 1;
            $attendance->user_id = $request->user_id;
            $attendance->date = $request->date;
            $attendance->is_holiday = $request->is_holiday;
            $attendance->is_leave = $request->is_leave;
            $attendance->leave_id = $request->leave_id;
            $attendance->holiday_id = $request->holiday_id;
            $attendance->clock_in_date_time = $request->clock_in_date_time;
            $attendance->clock_out_date_time = $request->clock_out_date_time;
            $attendance->total_duration = $request->total_duration;
            $attendance->is_late = $request->is_late;
            $attendance->is_half_day = $request->is_half_day;
            $attendance->is_paid = $request->is_paid;
            $attendance->status = $request->status;
            $attendance->reason = $request->reason;
            $attendance->save();

            return ResponseFormatter::success($attendance, 'Attendance created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $attendance = Attendance::find($id);
            if (!$attendance) {
                return ResponseFormatter::error('Attendance not found', 404);
            }
            return ResponseFormatter::success($attendance, 'Attendance found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'date' => 'required',
                'user_id' => 'required',
                'is_holiday' => 'nullable',
                'is_leave' => 'nullable',
                'leave_id' => 'nullable',
                'holiday_id' => 'nullable',
                'clock_in_date_time' => 'required',
                'clock_out_date_time' => 'nullable',
                'total_duration' => 'nullable',
                'is_late' => 'nullable',
                'is_half_day' => 'nullable',
                'is_paid' => 'nullable',
                'status' => 'nullable',
                'reason' => 'nullable',
            ]);

            $attendance = Attendance::find($id);
            if (!$attendance) {
                return ResponseFormatter::error('Attendance not found', 404);
            }

            $attendance->company_id = 1;
            $attendance->user_id = $request->user_id;
            $attendance->date = $request->date;
            $attendance->is_holiday = $request->is_holiday;
            $attendance->is_leave = $request->is_leave;
            $attendance->leave_id = $request->leave_id;
            $attendance->holiday_id = $request->holiday_id;
            $attendance->clock_in_date_time = $request->clock_in_date_time;
            $attendance->clock_out_date_time = $request->clock_out_date_time;
            $attendance->total_duration = $request->total_duration;
            $attendance->is_late = $request->is_late;
            $attendance->is_half_day = $request->is_half_day;
            $attendance->is_paid = $request->is_paid;
            $attendance->status = $request->status;
            $attendance->reason = $request->reason;
            $attendance->save();

            return ResponseFormatter::success($attendance, 'Attendance updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $attendance = Attendance::find($id);
            if (!$attendance) {
                return ResponseFormatter::error('Attendance not found', 404);
            }

            $attendance->delete();

            return ResponseFormatter::success($attendance, 'Attendance deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
