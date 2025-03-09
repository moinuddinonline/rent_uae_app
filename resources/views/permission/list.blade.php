@extends('layout.app')

@section('title', 'Permission')

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
                        <li class="breadcrumb-item active" aria-current="page">Permissions</li>
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
                                @permission('permission_create')
                                    <a href="{{ route('permission.create') }}" class="btn btn-inverse-success">Add
                                        Permission</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Dispaly Name</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $e)
                                        <tr>
                                            <td>{{ $e->display_name }}</td>
                                            <td>{{ $e->name }}</td>
                                            <td>{{ $e->description }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    @permission('permission_update')
                                                        <a href="{{ route('permission.edit', $e->id) }}"
                                                            class="btn btn-inverse-success btn-sm">
                                                            <i class="material-icons-outlined">edit</i>
                                                        </a>
                                                    @endpermission
                                                    @permission('permission_delete')
                                                        <a href="{{ route('permission.destroy', $e->id) }}"
                                                            class="btn btn-inverse-danger btn-sm deleteRow"
                                                            data-id="{{ $e->id }}" data-method="DELETE">
                                                            <i class="material-icons-outlined">delete</i>
                                                        </a>
                                                    @endpermission
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
    @include('permission.permisssion_script')
@endsection
