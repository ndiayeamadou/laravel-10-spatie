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
                        <h4>Permissions
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Add Permission</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>ID</th><th>Name</th><th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('edit permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-info btn-sm">edit</a>
                                        @endcan
                                        @can('delete permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger btn-sm">delete</a>
                                        @endcan
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
