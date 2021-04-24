<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Psy\Util\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    
    public function index()
    {
        // notify("Quick notification");
	    Gate::authorize('app.roles.index');
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

   
    public function create()
    {
	    Gate::authorize('app.roles.create');
        $modules = Module::all();

        return view('admin.roles.form', compact('modules'));
    }

    public function store(Request $request)
    {
	    Gate::authorize('app.roles.create');
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required|array',
            'permissions.*' => 'integer'
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ])->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role Created Successfully');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
	    Gate::authorize('app.roles.edit');
        $modules = Module::all();
        return view('admin.roles.form', compact('modules', 'role'));
    }

    public function update(Request $request, Role $role)
    {
	    Gate::authorize('app.roles.create');
        $role->update([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);
        $role->permissions()->sync($request->input('permissions'));
        return redirect()->route('roles.index')->with('success', 'Role Updated Successfully');
    }


    public function destroy(Role $role)
    {
	    Gate::authorize('app.roles.destroy');
        $role->delete();
        return back();
    }
}
