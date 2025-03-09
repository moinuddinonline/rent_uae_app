@extends('layout.app')

@section('title', 'Roles')

@section('pagestyle')

@endsection

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-header container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <form class="d-flex" action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" placeholder="Search ...." name="keyword"
                                            value="{{ isset($request->keyword) ? $request->keyword : null }}">
                                        <button class="btn btn-outline-primary d-flex" type="submit">
                                            <i class="material-icons-outlined">search</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3 text-end">
                                @permission('role_create')
                                    <a href="{{ route('role.create') }}" class="btn btn-inverse-success">Create Role</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Display Name</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Portal</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" class="text-center">Access</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $e)
                                    <tr>
                                        <td>{{ $e->display_name }}</td>
                                        <td>{{ $e->name }}</td>
                                        <td>{{ $e->portal }}</td>
                                        <td>{{ $e->description }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-inverse-success m-b-xs"
                                                data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                                                data-bs-content="@foreach ($e->permissions as $p) {{ ucfirst(str_replace('_', ' ', $p->name)) }} | @endforeach">
                                                Access
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                @permission('permission_update')
                                                    <a href="{{ route('role.edit', $e->id) }}"
                                                        class="btn btn-inverse-success btn-sm">
                                                        <i class="material-icons-outlined">edit</i>
                                                    </a>
                                                @endpermission
                                                @permission('permission_delete')
                                                    <a href="{{ route('role.destroy', $e->id) }}"
                                                        class="btn btn-sm btn-inverse-danger deleteRow"
                                                        data-id="{{ $e->id }}" data-method="DELETE">
                                                        <i class="material-icons-outlined">delete</i>
                                                    </a>
                                                @endpermission
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">No Data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $data->appends(Request::except('page'))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagescript')
    <script>
        $(function() {
            $('[data-bs-toggle="popover"]').popover();
        })
    </script>
    @include('role.role_script')
@endsection
