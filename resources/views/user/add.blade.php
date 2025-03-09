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
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                Admin Users
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
                                <h6 class="mb-0 text-uppercase">User Create</h6>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3 text-end">
                                @permission('user_read')
                                    <a href="{{ route('user.list') }}" class="btn btn-inverse-success">All Users</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form name="createFrom" id="createFrom" action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Full Name</label>
                                        <input type="text" autocomplete="off" class="form-control" id="name"
                                            name="name" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" autocomplete="off" class="form-control" id="email"
                                            name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="mobile">Mobile Number</label>
                                        <input type="text" autocomplete="off" class="form-control" id="mobile"
                                            name="mobile" placeholder="Mobile Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" autocomplete="off" class="form-control" id="password"
                                            name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Re-type Password</label>
                                        <input type="text" autocomplete="off" class="form-control"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Re-type Password">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <h5>Select Roles</h5>
                                    </div>
                                    <div class="mb-3 roleBox">
                                        <div class="row">
                                            @forelse ($roles as $e)
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input role"
                                                            id="flexCheckChecked{{ $e->id }}" name="roles[]"
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
    @include('user.user_script')
@endsection
