<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        try {
            $shifts = Shift::all();
            return ResponseFormatter::success($shifts, 'Roles found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Shifts not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'clock_in_time' => 'required',
                'clock_out_time' => 'required',
            ]);

            $user = $request->user();

            $shift = new Shift();
            $shift->company_id = 1;
            $shift->created_by = $user->id;
            $shift->name = $request->name;
            $shift->clock_in_time = $request->clock_in_time;
            $shift->clock_out_time = $request->clock_out_time;
            $shift->late_mark_after = $request->late_mark_after;
            $shift->early_clock_in_time = $request->early_clock_in_time;
            $shift->allow_clock_out_till = $request->allow_clock_out_till;
            $shift->save();

            return ResponseFormatter::success($shift, 'Shift created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    //show
    public function show($id)
    {
        try {
            $shift = Shift::find($id);
            if (!$shift) {
                return ResponseFormatter::error('Shift not found', 404);
            }

            return ResponseFormatter::success($shift, 'Shift found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'clock_in_time' => 'required',
                'clock_out_time' => 'required',
            ]);

            $shift = Shift::find($id);
            if (!$shift) {
                return ResponseFormatter::error('Shift not found', 404);
            }

            $shift->name = $request->name;
            $shift->clock_in_time = $request->clock_in_time;
            $shift->clock_out_time = $request->clock_out_time;
            $shift->late_mark_after = $request->late_mark_after;
            $shift->early_clock_in_time = $request->early_clock_in_time;
            $shift->allow_clock_out_till = $request->allow_clock_out_till;
            $shift->save();

            return ResponseFormatter::success($shift, 'Shift updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $shift = Shift::find($id);
            if (!$shift) {
                return ResponseFormatter::error('Shift not found', 404);
            }

            $shift->delete();

            return ResponseFormatter::success($shift, 'Shift deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
