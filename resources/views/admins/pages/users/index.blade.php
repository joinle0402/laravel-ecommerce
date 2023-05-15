@extends('admins.layout.app')

@section('title')
    User list
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
                    <h2>User list</h2>
                </div>
                <div class="col-sm d-flex justify-content-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-info active" role="button"
                        aria-pressed="true">
                        Add User
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
                                        <th class="text-center text-uppercase text-secondary text-xs font-bold opacity-7">
                                            #
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-bold opacity-7 ps-2">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-bold opacity-7 ps-2">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-bold opacity-7 ps-2">
                                            Email
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-bold opacity-7 ps-2">
                                            Phone
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-bold opacity-7 ps-2">
                                            Gender
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-bold opacity-7 ps-2">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->total())
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td class="text-bold text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">
                                                    <img class="rounded-circle"
                                                        src="{{ asset($user->images()->first()->url) }}" width="50"
                                                        height="50" />
                                                </td>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->phone }}</td>
                                                <td class="text-center">{{ str()->title($user->gender) }}</td>
                                                <td class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-warning" role="button"
                                                        aria-pressed="true">Update</a>
                                                    <form method="POST"
                                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                                        id="delete-form-{{ $user->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $user->id }})">Delete</button>
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
                            <div class="px-3">
                                {{ $users->links() }}
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
