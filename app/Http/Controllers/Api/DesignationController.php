<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        try {
            $designations = Designation::all();
            return ResponseFormatter::success($designations, 'Designation found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Designation not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $user = $request->user();

            $designation = new Designation();
            $designation->company_id = 1;
            $designation->created_by = $user->id;
            $designation->name = $request->name;
            $designation->description = $request->description;
            $designation->save();

            return ResponseFormatter::success($designation, 'Designation created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $designation = Designation::find($id);
            if (!$designation) {
                return ResponseFormatter::error('Designation not found', 404);
            }
            return ResponseFormatter::success($designation, 'Designation found');
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

            $designation = Designation::find($id);
            if (!$designation) {
                return ResponseFormatter::error('Designation not found', 404);
            }

            $designation->name = $request->name;
            $designation->description = $request->description;
            $designation->save();

            return ResponseFormatter::success($designation, 'Designation updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $designation = Designation::find($id);
            if (!$designation) {
                return ResponseFormatter::error('Designation not found', 404);
            }

            $designation->delete();

            return ResponseFormatter::success($designation, 'Designation deleted');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
