<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private Role $role;
    private Permission $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->role->latest('id')->paginate(3);
        return view('admins.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionGroups = $this->permission->all()->groupBy('group');
        return view('admins.pages.roles.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = new Role();
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->group = $request->group;
            $role->guard_name = 'web';
            $role->save();
            $role->permissions()->attach($request->permission_ids ?? []);
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Create role successfully!');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
        }
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
        $role = $this->role->findById($id);
        $permissionGroups = $this->permission->all()->groupBy('group');
        $roleHasPermissions = $role->permissions()->pluck('id')->toArray();

        return view('admins.pages.roles.edit', compact('role', 'permissionGroups', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->findOrFail($id);
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->group = $request->group;
            $role->guard_name = 'web';
            $role->save();
            $role->permissions()->sync($request->permission_ids);
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Update role successfully!');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->role->destroy($id);
        return redirect()->route('admin.roles.index')->with('success', 'Delete role successfully!');
    }
}
