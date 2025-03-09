@extends('layout.app')

@section('title', 'Users')

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
                        <li class="breadcrumb-item active" aria-current="page">Admin Users</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-header container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <form class="d-flex" action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...." name="keyword"
                                            value="{{ isset($request->keyword) ? $request->keyword : null }}">
                                        <button class="btn btn-outline-primary d-flex" type="submit">
                                            <i class="material-icons-outlined">search</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('user.list', 'active') }}" class="btn btn-sm btn-primary">Active
                                    Users</a>
                                <a href="{{ route('user.list', 'archived') }}" class="btn btn-sm btn-inverse-danger">Archive
                                    Users</a>
                            </div>
                            <div class="col-md-2 text-end">
                                @permission('user_create')
                                    <a href="{{ route('user.create') }}" class="btn btn-inverse-success">Create User</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $e)
                                    <tr>
                                        <td>{{ $e->name }}</td>
                                        <td>{{ $e->mobile_prefix }} - {{ $e->mobile }}</td>
                                        <td>{{ $e->email }}</td>
                                        <td class="text-center" id="userStatus-{{ $e->id }}">
                                            @if ($e->status === 1)
                                                <a href="{{ route('user.archive', $e->id) }}"
                                                    class="btn btn-sm btn-success blockUser" data-id="{{ $e->id }}"
                                                    data-method="PUT">Active
                                                </a>
                                            @else
                                                <a href="{{ route('user.restore', $e->id) }}"
                                                    class="btn btn-sm btn-inverse-danger activeUser"
                                                    data-id="{{ $e->id }}" data-method="PUT">Blocked
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('user.edit', $e->id) }}"
                                                    class="btn btn-inverse-success btn-sm">
                                                    <i class="material-icons-outlined">edit</i>
                                                </a>
                                                <a href="{{ route('user.show', $e->id) }}"
                                                    class="btn btn-sm btn-inverse-danger deleteRow"
                                                    data-id="{{ $e->id }}" data-method="DELETE">
                                                    <i class="material-icons-outlined">delete</i>
                                                </a>
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
    @include('user.user_script')
@endsection
