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
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                Roles
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
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
                                <h6 class="mb-0 text-uppercase">Role Create</h6>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3 text-end">
                                @permission('role_read')
                                    <a href="{{ route('role.list') }}" class="btn btn-inverse-success">All Role</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form name="roleCreateFrm" id="roleCreateFrm" action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="display_name">Display Name</label>
                                        <input type="text" autocomplete="off" class="form-control" id="display_name"
                                            name="display_name" placeholder="Display Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <input type="text" autocomplete="off" class="form-control" id="description"
                                            name="description">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <h5>Select Permissions List</h5>
                                    </div>
                                    <div class="mb-3 permissionsBox">
                                        <div class="row">
                                            @forelse ($permissions as $e)
                                                <div class="col-md-3 mb-1">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input permissions"
                                                            id="flexCheckChecked{{ $e->id }}" name="permissions[]"
                                                            value="{{ $e->id }}">
                                                        <label class="form-check-label"
                                                            for="flexCheckChecked{{ $e->id }}">{{ ucfirst(str_replace('_', ' ', $e->name)) }}</label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-inverse-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagescript')
    @include('role.role_script')
@endsection
