@extends('layout.app')

@section('title', 'Dashboard')

@section('pagestyle')
@endsection

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Welcome To Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="mb-0">Welcome To Dashboard</h3>
            </div>
        </div>
    </div>
@endsection

@section('pagescript')
@endsection
