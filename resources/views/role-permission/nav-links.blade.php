<div class="text-center">
    <a href="{{ url('roles') }}" class="btn btn-primary">Roles</a>
    <a href="{{ url('permissions') }}" class="btn btn-info mx-2">Permissions</a>
    {{-- @role('super-admin') --}}
    <a href="{{ url('users') }}" class="btn btn-secondary">Users</a>
    {{-- @endrole --}}
</div>
