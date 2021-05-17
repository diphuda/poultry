<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('app.users.index');
		$users = User::with('role')->get();
		
		return view('admin.users.index', compact('users'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		Gate::authorize('app.users.create');
		$roles = Role::all();
		return view('admin.users.form', compact('roles'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		Gate::authorize('app.users.create');
		$this->validate($request, [
			'name'     => 'required|string|max:255',
			'email'    => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'role'     => 'required',
		]);
		$user = User::create([
			'role_id'  => $request->role,
			'name'     => $request->name,
			'email'    => $request->email,
			'password' => Hash::make($request->password)
		]);
		alert()->success('Done!','New user created successfully');
		return redirect()->route('users.index');
	}
	
	/**
	 * Display the specified resource.
	 */
	public function show(User $user)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user)
	{
		Gate::authorize('app.users.edit');
		$roles = Role::all();
		return view('admin.users.form', compact('roles', 'user'));
	}
	
	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, User $user)
	{
		Gate::authorize('app.users.edit');
		$this->validate($request, [
			'name'     => 'required|string|max:255',
			'email'    => 'required|email|max:255|unique:users,email,'. $user->id,
			'password' => 'nullable|confirmed|min:6',
			'role'     => 'required',
		]);
		$user->update([
			'role_id'  => $request->role,
			'name'     => $request->name,
			'email'    => $request->email,
			'password' => isset($request->password) ? Hash::make($request->password) : $user->password
		]);
		alert()->success('Done!','User info updated successfully');
		return redirect()->route('users.index');
	}
	
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		Gate::authorize('app.users.destroy');
		$user->delete();
		toast('User Deleted', 'success');
		
		return back();
	}
}
