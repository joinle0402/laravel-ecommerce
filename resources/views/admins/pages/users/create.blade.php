@extends('admins.layout.app')

@section('title')
    Create role
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row mb-3">
                <div class="col-sm">
                    <h2>Create user form</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.users.store') }}" enctype='multipart/form-data'>
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="name">Name:</label>
                            <input type="text" value="{{ old('name') }}" @class([
                                'form-control px-2',
                                'is-invalid border-danger' => $errors->has('name'),
                                'is-valid border-success' => !$errors->has('name') && old('name'),
                            ])
                                style="border: 1px solid #000;" id="name" name="name">
                            @error('name')
                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="email">Email:</label>
                            <input type="email" value="{{ old('email') }}" @class([
                                'form-control px-2',
                                'is-invalid border-danger text-danger' => $errors->has('email'),
                                'is-valid border-success' => !$errors->has('email') && old('email'),
                            ])
                                style="border: 1px solid #000;" id="email" name="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="phone">Phone:</label>
                            <input type="text" value="{{ old('phone') }}" @class([
                                'form-control px-2',
                                'is-invalid border-danger' => $errors->has('phone'),
                                'is-valid border-success' => !$errors->has('phone') && old('phone'),
                            ])
                                style="border: 1px solid #000;" id="phone" name="phone">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="gender">Gender:</label>
                            <select name="gender" class="form-select px-2 border border-dark text-dark"
                                aria-label="Default select example">
                                <option value="male" @selected(old('gender') == 'Male')>Male</option>
                                <option value="female" @selected(old('gender') == 'Female')>Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="address">Address:</label>
                            <textarea type="text" value="{{ old('address') }}" @class([
                                'form-control px-2',
                                'is-invalid border-danger' => $errors->has('address'),
                                'is-valid border-success' => !$errors->has('address') && old('address'),
                            ]) style="border: 1px solid #000;"
                                id="address" name="address" rows="5">{{ old('name') }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark text-bold" for="image">Image:</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="file" name="image" id="image-file"
                                        class="form-control form-control-sm px-2 border border-dark text-dark">
                                </div>
                                <div class="col-6">
                                    <img src="{{ asset('uploads/users/default.jpg') }}" id="image-preview" width="100"
                                        height="100" alt="default.jpg">
                                </div>
                            </div>
                        </div>

                        <div class="input-group input-group-outline my-3">
                            @foreach ($roleGroups as $roleGroupName => $roleGroup)
                                <div class="col-6">
                                    <h6> {{ str()->title($roleGroupName) }} </h6>

                                    <div>
                                        @foreach ($roleGroup as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="role_ids[]"
                                                    value="{{ $role->id }}" id="{{ 'checkbox-' . $role->id }}"
                                                    @checked(is_array(old('role_ids')) && in_array($role->id, old('role_ids')))>
                                                <label class="custom-control-label"
                                                    for="{{ 'checkbox-' . $role->id }}">{{ $role->display_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#image-preview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(input.files[0])
                }
            }

            $('#image-file').on('change', function() {
                previewImage(this);
            });
        });
    </script>
@endsection
