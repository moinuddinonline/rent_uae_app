@extends('layout.app')

@section('title', 'Rent Payment Details')

@section('pagestyle')
    <style>
        .detail-row {
            display: flex;
        }

        .left-leble,
        .right-leble {
            flex: 1;
        }

        .imge-preview {
            max-height: 300px;
            overflow: hidden;
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="javascript:;">
                                Rent Payment
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
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
                                <h6 class="mb-0 text-uppercase">Rent Payment Details</h6>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('rents.list') }}" class="btn btn-inverse-success">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Payment Details</h5>
                                    <hr>
                                </div>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>User Name:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->user->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>User Mobile:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->user->mobile_prefix }} {{ $data->user->mobile }}
                                    </div>
                                </div>
                                <hr>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Payment Name:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->payment_title }}
                                    </div>
                                </div>
                                <hr>

                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Rent Amount:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->amount }}
                                    </div>
                                </div>
                                <hr>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Rent Type:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->vendor->rentType->name  }}

                                    </div>
                                </div>
                                <hr>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Payment Status:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->payment_status }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Vendor Details</h5>
                                    <hr>
                                </div>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Vendor Name:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->vendor->vendor_name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Vendor Email:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->vendor->email }}
                                    </div>
                                </div>
                                <hr>
                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Vendor Phone:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->vendor->mobile }}
                                    </div>
                                </div>
                                <hr>

                                <div class="detail-row">
                                    <div class="left-leble">
                                        <strong>Vendor IBN Number:</strong>
                                    </div>
                                    <div class="right-leble">
                                        {{ $data->vendor->iban_number }}
                                    </div>
                                </div>
                                <hr>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Update Rent Status</h5>
                                    <hr>
                                </div>
                                <form name="updateFrm" id="updateFrm" action="{{ route('rents.rent-update', $data->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>
                                                PENDING
                                            </option>
                                            <option value="Initiated" {{ $data->status == 'Initiated' ? 'selected' : '' }}>
                                                INITIATED
                                            </option>
                                            <option value="In-Progress"
                                                {{ $data->status == 'In-Progress' ? 'selected' : '' }}>
                                                IN-PROGRESS
                                            </option>
                                            <option value="Settled" {{ $data->status == 'Settled' ? 'selected' : '' }}>
                                                SETTLED
                                            </option>
                                            <option value="Cancelled" {{ $data->status == 'Cancelled' ? 'selected' : '' }}>
                                                CANCELLED
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagescript')
    <script>
        $(document).ready(function() {
       
            $("#updateFrm").on("submit", function(e) {
                e.preventDefault(); 

                let formData = new FormData(this);

             
                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    contentType: false, 
                    processData: false, 
                    dataType: "json", 
                    success: function(response) {
                        if (response.data.status === "validation_error") {
                           
                            printError(response.data.message); 
                        } else if (response.data.status === "error") {
                            toastr.error(response.data.message);
                        } else {
                            toastr.success(response.data.message);
                            window.location.href ="{{ route('rents.list') }}"; 
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        toastr.error("Something went wrong! Please try again.");
                    },
                });
            });
        });
    </script>
@endsection
