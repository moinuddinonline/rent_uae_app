@extends('layout.app')

@section('title', 'Rents')

@section('pagestyle')


@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Rents</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-header container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <form class="d-flex" action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...." name="keyword"
                                            value="{{ isset($request->keyword) ? $request->keyword : null }}">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="material-icons-outlined">search</i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            @permission('export_rent')
                                <div class="col-lg-8 col-md-6 col-sm-12 mt-3 mt-md-0">
                                    <form action="{{ route('rents.export') }}" method="POST">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col-md-4 col-sm-12">
                                                <input type="date" class="form-control" name="from_date"
                                                    value="{{ isset($request->from_date) ? $request->from_date : null }}">
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="date" class="form-control" name="to_date"
                                                    value="{{ isset($request->to_date) ? $request->to_date : null }}">
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <button class="btn btn-outline-secondary w-100" type="submit">
                                                    Export
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endpermission
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">User Name</th>
                                        <th scope="col">User Mobile</th>
                                        <th scope="col">Payment Title</th>
                                        <th scope="col">Vendor Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $e)
                                        <tr>
                                            <td>{{ $e->user->name }}</td>
                                            <td>{{ $e->user->mobile_prefix }}-{{ $e->user->mobile }}</td>
                                            <td>{{ $e->payment_title }}</td>
                                            <td>{{ $e->vendor->vendor_name }}</td>
                                            <td>{{ $e->amount }}</td>
                                            <td class="text-center">{{ $e->payment_status }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('rents.rent-view', $e->id) }}" class="btn btn-inverse-success btn-sm">
                                                        <i class="material-icons-outlined">settings</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">No Data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-5">
                        {{ $data->appends(Request::except('page'))->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
