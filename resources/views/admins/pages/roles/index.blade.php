@extends('admins.layout.app')

@section('title')
    Role list
@endsection

@section('content')
    <div class="card">
        <div class="container bg-white shadow p-3">
            <div class="row">
                @if (session('message'))
                    <h4 class="text-success">{{ session('message') }}</h6>
                @endif

                <div class="col-sm">
                    <h2>Role list</h2>
                </div>
                <div class="col-sm d-flex justify-content-end">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-info active" role="button" aria-pressed="true">
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
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this role?')) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
