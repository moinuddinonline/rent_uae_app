@extends('layout.app')

@section('title', 'Permission')

@section('pagestyle')
    <style>
        #curd_option_box {
            display: none;
        }
    </style>
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
                        <form name="createFrm" id="createFrm" action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input permission_type" type="radio"
                                                name="permission_type" value="basic" checked id="basic">
                                            <label class="form-check-label" for="basic">Basic Permission</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input permission_type" type="radio"
                                                name="permission_type" id="curd" value="curd">
                                            <label class="form-check-label" for="curd">CRUD Permission</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="basic_option_box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="display_name">Diplay Name <span
                                                    class="required">*</span>
                                            </label>
                                            <input type="text" autocomplete="off" name="display_name" id="display_name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description <span
                                                    class="required">*</span>
                                            </label>
                                            <input type="text" autocomplete="off" name="description" id="description"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="curd_option_box">
                                <div class="mb-3">
                                    <label class="form-label" for="resource">Resource <span class="required">*</span>
                                    </label>
                                    <input type="text" autocomplete="off" name="resource" id="resource"
                                        class="form-control">
                                </div>
                                <div class="mb-3 mt-3">
                                    <div class="row ml-1 curd_selected_box">
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input curd_selected"
                                                    id="checkbox-custom-inline-create" name="curd_selected[]"
                                                    value="create">
                                                <label class="form-check-label"
                                                    for="checkbox-custom-inline-create">Create</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input curd_selected"
                                                    id="checkbox-custom-inline-update" name="curd_selected[]"
                                                    value="update">
                                                <label class="form-check-label"
                                                    for="checkbox-custom-inline-update">Update</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input curd_selected"
                                                    id="checkbox-custom-inline-read" name="curd_selected[]"
                                                    value="read">
                                                <label class="form-check-label"
                                                    for="checkbox-custom-inline-read">Read</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input curd_selected"
                                                    id="checkbox-custom-inline-delete" name="curd_selected[]"
                                                    value="delete">
                                                <label class="form-check-label"
                                                    for="checkbox-custom-inline-delete">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-inverse-primary">Save</button>
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
