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
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                Permissions
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                                <h6 class="mb-0 text-uppercase">Permission</h6>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3 text-end">
                                @permission('permission_read')
                                    <a href="{{ route('permission.list') }}" class="btn btn-inverse-success">All Permission</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form name="updateFrm" id="updateFrm" action="{{ route('permission.update', $permission->id) }}"
                            method="POST">
                            @method('patch')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="display_name">Display Name</label>
                                        <input type="text" autocomplete="off" class="form-control" id="display_name"
                                            name="display_name" placeholder="Name" value="{{ $permission->display_name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <input type="text" autocomplete="off" class="form-control" id="description"
                                            name="description" placeholder="Description"
                                            value="{{ $permission->description }}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <button id="btn-submit" type="submit" class="btn btn-inverse-primary">Save
                                            Permission</button>
                                    </div>
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
    @include('permission.permisssion_script')
@endsection
