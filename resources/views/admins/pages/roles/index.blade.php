@extends('admins.layout.app')

@section('title')
    Role list
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-white text-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close d-flex items-center justify-center" data-bs-dismiss="alert"
                            aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <div class="col-sm">
                    <h2>Role list</h2>
                </div>
                <div class="col-sm d-flex justify-content-end">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-info active" role="button"
                        aria-pressed="true">
                        Add Role
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
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Display Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Group
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Active
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($roles)
                                        @foreach ($roles as $index => $role)
                                            <tr>
                                                <td class="text-bold text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">{{ $role->name }}</td>
                                                <td class="text-center">{{ $role->display_name }}</td>
                                                <td class="text-center">{{ $role->group }}</td>
                                                <td class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                        class="btn btn-warning" role="button"
                                                        aria-pressed="true">Update</a>
                                                    <form method="POST"
                                                        action="{{ route('admin.roles.destroy', $role->id) }}"
                                                        id="delete-form-{{ $role->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $role->id }})">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="px-3">
                                {{ $roles->links() }}
                            </div>
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
