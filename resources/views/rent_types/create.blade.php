@extends('layout.app')

@section('title', 'Add Rent Type')

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
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('rent_types.list') }}">Rent Types</a>
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
                        <div class="col-md-9">
                            <h6 class="mb-0 text-uppercase">Add Rent Type</h6>
                        </div>
                        <div class="col-md-3 text-end">
                            @permission('rent_type_read')
                                <a href="{{ route('rent_types.list') }}" class="btn btn-success">All Rent Types</a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="createFrm" action="{{ route('rent_types.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter rent type name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Image<span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="sort_order">Sort Order</label>
                                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagescript')
@include('rent_types.rent_type_script')
@endsection
