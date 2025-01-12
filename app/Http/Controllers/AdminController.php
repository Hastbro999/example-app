<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return view('admin.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $value = User::findOrFail($id);
        return view('admin.edit', compact('value'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|max:255',
            'job' => 'required',
        ]);

        $value = User::findOrFail($id);
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'job' => $request->job,
        ]);

        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
    }
}
