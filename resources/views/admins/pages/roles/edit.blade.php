@extends('admins.layout.app')

@section('title')
    Update role
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row mb-3">
                <div class="col-sm">
                    <h2>Update role form</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="NameInput">Name:</label>
                            <input type="text" value="{{ old('name') ?? $role->name }}"
                                class="form-control px-2 border border-dark text-dark" id="NameInput" name="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="display_name">Display Name:</label>
                            <input type="text" value="{{ old('display_name') ?? $role->display_name }}"
                                class="form-control px-2 border border-dark text-dark" id="display_name"
                                placeholder="name@example.com" name="display_name">
                            @error('display_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="display_name">Group Name:</label>
                            <select name="group" class="form-select px-2 border border-dark text-dark"
                                aria-label="Default select example">
                                @if (old('group'))
                                    <option value="system" @selected(old('group') == 'system')>System</option>
                                    <option value="user" @selected(old('group') == 'user')>User</option>
                                @else
                                    <option value="system" @selected($role->group == 'system')>System</option>
                                    <option value="user" @selected($role->group == 'user')>User</option>
                                @endif
                            </select>
                        </div>

                        <div class="input-group input-group-outline my-3">
                            @foreach ($permissionGroups as $permissionGroupName => $permissionGroup)
                                <div class="col-6">
                                    <h6> {{ str()->title($permissionGroupName) }} </h6>

                                    <div>
                                        @foreach ($permissionGroup as $permission)
                                            @if (old('permission_ids'))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permission_ids[]"
                                                        value="{{ $permission->id }}"
                                                        id="{{ 'checkbox-' . $permission->id }}"
                                                        @checked(is_array(old('permission_ids')) && in_array($permission->id, old('permission_ids')))>
                                                    <label class="custom-control-label"
                                                        for="{{ 'checkbox-' . $permission->id }}">{{ $permission->display_name }}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permission_ids[]"
                                                        value="{{ $permission->id }}"
                                                        id="{{ 'checkbox-' . $permission->id }}"
                                                        @checked(in_array($permission->id, $roleHasPermissions))>
                                                    <label class="custom-control-label"
                                                        for="{{ 'checkbox-' . $permission->id }}">
                                                        {{ $permission->display_name }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
