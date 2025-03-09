@extends('layout.app')

@section('title', 'Rent Types')

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
                        <li class="breadcrumb-item active" aria-current="page">Rent Types</li>
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
                                <a href="{{ route('rent_types.list', 'active') }}" class="btn btn-sm btn-primary">Active
                                </a>
                                <a href="{{ route('rent_types.list', 'archived') }}"
                                    class="btn btn-sm btn-inverse-danger">In-Active</a>
                            </div>
                            <!-- Add Button -->
                            <div class="col-md-2 text-end">
                                @permission('rent_type_create')
                                    <a href="{{ route('rent_types.create') }}" class="btn btn-inverse-success">Add Rent Type</a>
                                @endpermission
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
                                        <th scope="col">Slug</th>
                                        <th scope="col">Rent Category</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $e)
                                        <tr>
                                            <td>{{ $e->name }}</td>
                                            <td>{{ $e->slug }}</td>
                                            <td>{{ $e->category }}</td>
                                            <td class="text-center">
                                                @if ($e->image)
                                                    <img src="{{ $e->image_url }}" alt="Image"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($e->status === 1)
                                                    <a href="{{ route('rent_types.archive', $e->id) }}"
                                                        class="btn btn-sm btn-success blockData"
                                                        data-id="{{ $e->id }}" data-method="PUT">Active
                                                    </a>
                                                @else
                                                    <a href="{{ route('rent_types.restore', $e->id) }}"
                                                        class="btn btn-sm btn-inverse-danger activeData"
                                                        data-id="{{ $e->id }}" data-method="PUT">Inactive
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    @permission('rent_type_update')
                                                        <a href="{{ route('rent_types.edit', $e->id) }}"
                                                            class="btn btn-inverse-success btn-sm">
                                                            <i class="material-icons-outlined">edit</i>
                                                        </a>
                                                    @endpermission
                                                    @permission('rent_type_delete')
                                                        <a href="{{ route('rent_types.destroy', $e->id) }}"
                                                            class="btn btn-inverse-danger btn-sm deleteRow"
                                                            data-id="{{ $e->id }}" data-method="DELETE">
                                                            <i class="material-icons-outlined">delete</i>
                                                        </a>
                                                    @endpermission
                                                </div>
                                            </td>
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

@section('pagescript')
    @include('rent_types.rent_type_script')
@endsection
