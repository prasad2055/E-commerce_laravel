<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Admin::where('type', 'staff')->paginate(10);

        return view('back.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|max:30',
            'address' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        flash('Staff Created.')->success();

        return redirect()->route('back.staffs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $staff)
    {
        return view('back.staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|max:30',
            'address' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $staff->update($validated);

        flash('Staff Updated.')->success();

        return redirect()->route('back.staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $staff)
    {
        $staff->delete();

        flash('Staff Removed.')->success();

        return redirect()->route('back.staffs.index');
    }
}
