<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $guard_name = 'web';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $roles = Role::where('name', 'like', '%' . $request->input('search') . '%')->get();
        } else {
            $roles = Role::all();
        }
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('faculty.roles.index')
            ->with('success_message', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $all_group_permissions = Permission::all()->pluck('group_name')->toArray();
        $all_group_permissions = array_unique($all_group_permissions);
        $permissions = Permission::all();
        return view('roles.show', [
            'role' => $role,
            'all_group_permissions' => $all_group_permissions,
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $all_group_permissions = Permission::all()->pluck('group_name')->toArray();
        $all_group_permissions = array_unique($all_group_permissions);
        $permissions = Permission::all();
        return view('roles.edit', [
            'role' => $role,
            'all_group_permissions' => $all_group_permissions,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if (($role->name == Role::ROLE_SUPER_ADMIN) && (!auth()->user()->hasRole(Role::ROLE_SUPER_ADMIN))) {
            return redirect()->route('faculty.roles.index')
                ->with('warning_message', 'Unauthorized Action');
        }

        $role->syncPermissions($request->input('permissions'));
        return redirect()->route('faculty.roles.index')
            ->with('success_message', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
