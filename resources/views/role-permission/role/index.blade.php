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
                        <h4>Roles
                            <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>ID</th><th>Name</th><th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('update role')
                                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-info btn-sm">edit</a>
                                        @endcan
                                        @role('super-admin')
                                        <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger btn-sm">delete</a>
                                        @endrole
                                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning btn-sm">Add / Edit Role Permission</a>
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