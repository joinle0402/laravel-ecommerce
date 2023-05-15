<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private User $user;
    private Role $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->latest('id')->paginate(5);
        return view('admins.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleGroups = $this->role->all()->groupBy('group');
        return view('admins.pages.users.create', compact('roleGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->password = Hash::make(1);
            $user->save();

            $uploadImage = $this->user->baseDir('uploads/users')->saveImage($request) ?? 'uploads/users/default.jpg';

            $user->images()->create(['url' => $uploadImage]);
            $user->roles()->attach($request->role_ids);
            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'Create user successfully!');
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
        $user = $this->user->findOrFail($id);
        $roleGroups = $this->role->all()->groupBy('group');
        $userHasRoles = $user->roles()->pluck('id')->toArray();
        $image = $user->images()->first()->url ?? 'uploads/users/default.jpg';

        return view('admins.pages.users.edit', compact('user', 'roleGroups', 'userHasRoles', 'image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->password = Hash::make(1);
            $user->save();

            if ($request->file('image'))
            {

                $userImage = $user->images()->first()->url;
                $uploadImage = ($userImage == 'uploads/users/default.jpg') ?
                    $this->user->baseDir('uploads/users')->saveImage($request) :
                    $this->user->baseDir('uploads/users')->updateImage($request, $userImage);
                $user->images()->update(['url' => $uploadImage]);
            }

            if ($request->role_ids)
            {
                $user->roles()->sync($request->role_ids);
            }

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'Update user successfully!');
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
        try {
            DB::beginTransaction();
            $userToDelete = User::findOrFail($id);
            $userToDelete->images()->delete();
            $userToDelete->delete();
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Delete user successfully!');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
        }
    }
}
