<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all();
            return ResponseFormatter::success($roles, 'Roles found');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Roles not found', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $role = new Role();
            $role->company_id = 1;
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();

            return ResponseFormatter::success($role, 'Role created', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return ResponseFormatter::error('Role not found', 404);
            }

            return ResponseFormatter::success($role, 'Role found');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'permission_ids' => 'required|array',
            ]);

            $role = Role::find($id);
            if (!$role) {
                return ResponseFormatter::error('Role not found', 404);
            }

            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();

            $role->permissions()->sync($request->permission_ids);

            return ResponseFormatter::success($role, 'Role updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
