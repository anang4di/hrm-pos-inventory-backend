<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        try {
            $holidays = Holiday::all();
            return ResponseFormatter::success($holidays, 'Holidays found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Holidays not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'month' => 'required',
                'year' => 'required',
                'date' => 'required',
                'is_weekend' => 'required',
            ]);

            $holiday = new Holiday();
            $holiday->company_id = 1;
            $holiday->name = $request->name;
            $holiday->month = $request->month;
            $holiday->year = $request->year;
            $holiday->date = $request->date;
            $holiday->is_weekend = $request->is_weekend;
            $holiday->save();

            return ResponseFormatter::success($holiday, 'Holiday created', 201);
        } catch (\Exception $e) {

            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $holiday = Holiday::find($id);
            if (!$holiday) {
                return ResponseFormatter::error('Holiday not found', 404);
            }

            return ResponseFormatter::success($holiday, 'Holiday found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'month' => 'required',
                'year' => 'required',
                'date' => 'required',
                'is_weekend' => 'required',
            ]);

            $holiday = Holiday::find($id);
            if (!$holiday) {
                return ResponseFormatter::error('Holiday not found', 404);
            }

            $holiday->name = $request->name;
            $holiday->month = $request->month;
            $holiday->year = $request->year;
            $holiday->date = $request->date;
            $holiday->is_weekend = $request->is_weekend;
            $holiday->save();

            return ResponseFormatter::success($holiday, 'Holiday updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $holiday = Holiday::find($id);
            if (!$holiday) {
                return ResponseFormatter::error('Holiday not found', 404);
            }

            $holiday->delete();

            return ResponseFormatter::success($holiday, 'Holiday deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
