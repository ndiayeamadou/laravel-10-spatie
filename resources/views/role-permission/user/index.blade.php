@extends('layouts.app')

@section('content')
    @include('role-permission.nav-links')

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-12">
                @if(session('success'))
                <div class="col-md-6 offet-3 my-3 alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Users
                            <a href="{{ url('users/create') }}" class="btn btn-primary float-end">Add User</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>ID</th><th>Name</th><th>Email</th><th>Role(s)</th><th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label for="" class="badge bg-warning mx-1">{{ $rolename }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @role('super-admin')
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-info btn-sm">edit</a>
                                        <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-danger btn-sm">delete</a>
                                        @endrole
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection