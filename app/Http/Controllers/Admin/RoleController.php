<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(3);
        return view('admins.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionGroups = Permission::all()->groupBy('group');
        return view('admins.pages.roles.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $roleData = [];
        $roleData['name'] = $request->name;
        $roleData['display_name'] = $request->display_name;
        $roleData['group'] = $request->group;
        $roleData['guard_name'] = 'web';

        $role = Role::create($roleData);
        if ($request->has('permission_ids'))
        {
            $role->permissions()->attach($request->permission_ids);
        }

        return to_route('admin.roles.index')->with(['message' => 'Create role successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findById($id);
        $permissionGroups = Permission::all()->groupBy('group');
        $roleHasPermissions = $role->permissions()->pluck('id')->toArray();

        return view('admins.pages.roles.edit', compact('role', 'permissionGroups', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->group = $request->group;
        $role->guard_name = 'web';
        $role->save();
        $role->permissions()->sync($request->permission_ids);

        return to_route('admin.roles.index')->with(['message' => 'Update role successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return to_route('admin.roles.index')->with(['message' => 'Delete role successfully!']);
    }
}
