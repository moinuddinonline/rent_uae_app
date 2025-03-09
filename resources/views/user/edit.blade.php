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
                                <h6 class="mb-0 text-uppercase">User Update</h6>
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
                        <form id="editFrom" name="editFrom" class="m-t-25" action="{{ route('user.update', $user->id) }}"
                            method="POST" novalidate>
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Full Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Full Name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="mobile">Mobile Number</label>
                                        <input type="text" id="mobile" name="mobile" class="form-control"
                                            placeholder="Mobile Number" value="{{ $user->mobile }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Password">
                                        <div id="passwordHelp" class="form-text">Leave blank to keep current password.</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Re-type Password</label>
                                        <input type="text" id="password_confirmation" name="password_confirmation"
                                            class="form-control" placeholder="Re-type Password">
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
                                            @forelse ($roles as $role)
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input role"
                                                            id="flexCheckChecked{{ $role->id }}" name="roles[]"
                                                            value="{{ $role->id }}"
                                                            {{ is_array($user->roles->pluck('id')->toArray()) && in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="flexCheckChecked{{ $role->id }}">{{ ucfirst($role->display_name) }}</label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
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
    @include('user.user_script')
@endsection
