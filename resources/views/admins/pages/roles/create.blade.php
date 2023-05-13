@extends('admins.layout.app')

@section('title')
    Create role
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row mb-3">
                <div class="col-sm">
                    <h2>Create role form</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.roles.store') }}" autocomplete="off">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="name">Name:</label>
                            <input type="text" value="{{ old('name') }}"
                                class="form-control px-2 border border-dark text-dark" id="name" name="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="display_name">Display Name:</label>
                            <input type="text" value="{{ old('display_name') }}"
                                class="form-control px-2 border border-dark text-dark" id="display_name"
                                name="display_name">
                            @error('display_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="display_name">Group Name:</label>
                            <select name="group" class="form-select px-2 border border-dark text-dark"
                                aria-label="Default select example">
                                <option value="system" @selected(old('group') == 'system')>System</option>
                                <option value="user" @selected(old('group') == 'user')>User</option>
                            </select>
                        </div>

                        <div class="input-group input-group-outline my-3">
                            @foreach ($permissionGroups as $permissionGroupName => $permissionGroup)
                                <div class="col-6">
                                    <h6> {{ str()->title($permissionGroupName) }} </h6>

                                    <div>
                                        @foreach ($permissionGroup as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission_ids[]"
                                                    value="{{ $permission->id }}" id="{{ 'checkbox-' . $permission->id }}"
                                                    @checked(is_array(old('permission_ids')) && in_array($permission->id, old('permission_ids')))>
                                                <label class="custom-control-label"
                                                    for="{{ 'checkbox-' . $permission->id }}">{{ $permission->display_name }}</label>
                                            </div>
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
