<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function update(Request $request)
    {
        try {
            $company = Company::first();
            if ($request->has('name')) {
                $company->name = $request->name;
            }

            if ($request->has('email')) {
                $company->email = $request->email;
            }

            if ($request->hasFile('logo')) {
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $path = $request->file('logo')->store('logos', 'public');
                $company->logo = $path;
            }

            if ($request->has('website')) {
                $company->website = $request->website;
            }

            if ($request->has('phone')) {
                $company->phone = $request->phone;
            }

            if ($request->has('address')) {
                $company->address = $request->address;
            }

            if ($request->has('status')) {
                $company->status = $request->status;
            }

            if ($request->has('total_users')) {
                $company->total_users = $request->total_users;
            }

            if ($request->has('clock_in_time')) {
                $company->clock_in_time = $request->clock_in_time;
            }

            if ($request->has('clock_out_time')) {
                $company->clock_out_time = $request->clock_out_time;
            }

            if ($request->has('early_clock_in_time')) {
                $company->early_clock_in_time = $request->early_clock_in_time;
            }

            if ($request->has('allow_clock_out_till')) {
                $company->allow_clock_out_till = $request->allow_clock_out_till;
            }

            if ($request->has('self_clocking')) {
                $company->self_clocking = $request->self_clocking;
            }

            $company->save();

            return ResponseFormatter::success($company, 'Company updated successfully');

        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
