@extends('layout.app')

@section('title', 'Rent Vendors')

@section('pagestyle')
@endsection

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Rent Vendors</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-header container-fluid">
                        <div class="row align-items-center">
                            <!-- Search -->
                            <div class="col-md-4">
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
                         
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">IBAN Number</th>
                                        <th scope="col">Rent Type</th>
                                        <th scope="col">User Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $e)
                                        <tr>
                                            <td>{{ $e->vendor_name }}</td>
                                            <td>{{ $e->email }}</td>
                                            <td>{{ $e->mobile }}</td>
                                            <td>{{ $e->iban_number }}</td>
                                            <td>{{ $e->rentType->name }}</td>
                                            <td>{{ $e->user->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Record Found</td>
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

