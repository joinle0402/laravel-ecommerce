@extends('admins.layout.app')

@section('title')
    Create category
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row mb-3">
                <div class="col-sm">
                    <h2>Create category form</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.categories.store') }}" autocomplete="off">
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
                            <label class="form-label text-dark text-bold" for="display_name">Parent:</label>
                            <select name="parent_id" @class([
                                'form-select px-2 text-dark',
                                'is-invalid border-danger' => $errors->has('parent_id'),
                                'is-valid border-success' => !$errors->has('parent_id') && old('parent_id'),
                            ]) aria-label="Default select example">
                                <option value="0" selected>Chọn danh mục cha</option>
                                @foreach ($categoryTree as $categoryTreeItem)
                                    <option value="{{ $categoryTreeItem['id'] }}" @selected(old('parent_id') == $categoryTreeItem['id'])>
                                        {{ $categoryTreeItem['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
