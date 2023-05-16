@extends('admins.layout.app')

@section('title')
    Category list
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-white text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close d-flex items-center justify-center" data-bs-dismiss="alert"
                            aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-white text-center" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close d-flex items-center justify-center" data-bs-dismiss="alert"
                            aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <div class="col-sm">
                    <h2>Category list</h2>
                </div>
                <div class="col-sm d-flex justify-content-end">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-info active" role="button"
                        aria-pressed="true">
                        Add Category
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left px-3 text-uppercase text-secondary text-sm font-bold opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-sm font-bold opacity-7 ps-2">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($categoryTree))
                                        @foreach ($categoryTree as $index => $categoryTreeItem)
                                            <tr>
                                                <td class="text-left px-3">{{ $categoryTreeItem['name'] }}</td>
                                                <td class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('admin.categories.edit', $categoryTreeItem['id']) }}"
                                                        class="btn btn-warning" role="button"
                                                        aria-pressed="true">Update</a>
                                                    <form method="POST"
                                                        action="{{ route('admin.categories.destroy', $categoryTreeItem['id']) }}"
                                                        id="delete-form-{{ $categoryTreeItem['id'] }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $categoryTreeItem['id'] }})">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit();
                    Swal.fire(
                        'Deleted!',
                        'Delete successfully!',
                        'success'
                    )
                }
            })
        }
    </script>
@endsection
