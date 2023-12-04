@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary">Courier Master</h3>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action={{ route('courierMaster.store') }} class="medicine_search">
                    @csrf
                    <div class="row row-gap-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" id="company"
                                    placeholder="Company Name" value="{{old('company')}}">
                                <label for="company">Company Name</label>
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                    placeholder="Contact Number" value="{{old('phone')}}" max="9999999999"
                                    pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                <label for="phone">Contact Number</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="address" id="address" rows="5" placeholder="Company Address"
                                    class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                                <label for="address">Company Address</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select @error('country') is-invalid @enderror" name="country"
                                        id="country" aria-label="Country">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            @if (old('country') == $country->country_name)
                                                <option selected value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                            @else
                                                <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="country">Country</label>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $auth_token }}" name="auth_token" id="auth_token">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('state') is-invalid @enderror" name="state" id="state"
                                    aria-label="State" value="{{old('state')}}">
                                    <option value="" selected>Select State</option>
                                </select>
                                <label for="state">State</label>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Price Per Kg" value="{{old('price')}}">
                                <label for="price">Price Per Kg</label>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control @error('effective_from') is-invalid @enderror" name="effective_from" id="effective_from" placeholder="Date Effective From" value="{{old('effective_from') ? old('effective_from') : now()->format('Y-m-d')}}" max="{{now()->format('Y-m-d')}}">
                                <label for="effective_from">Date Effective From</label>
                                @error('effective_from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary rounded-3" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="patient-details-inner">
                <h5 class="px-4">All Vendors</h5>
            </div>
            <div class="card-body question_master_table">

                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Company&nbsp;Name</th>
                                <th scope="col">Mobile&nbsp;No</th>
                                <th scope="col">Country</th>
                                <th scope="col">State</th>
                                <th scope="col">Price</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($couriers as $courier)
                                <tr>
                                    <th scope="row">{{ $courier->id }}</th>
                                    <td>{{ ucwords($courier->company) }}</td>
                                    <td>{{ $courier->phone }}</td>
                                    <td>{{ ucwords($courier->country) }}</td>
                                    <td>{{ ucwords($courier->state) }}</td>
                                    <td>{{ $courier->price }}</td>
                                    <td><button type="button" class="modifyCourier" modifyId="{{ $courier->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button></td>
                                    <td><button type="button" class="deleteCourier" deleteId="{{ $courier->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- End Table with stripped rows -->

            </div>
        </div>
    </section>
    @include('admin.layouts.footer')
</main><!-- End #main -->

<!-- ...........Modals.......... -->
<div class="modal fade delete_modal" id="deleteCourierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('courierMaster.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteId" name="deleteId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modifyCourierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('courierMaster.update') }}">
                    @csrf
                    @method("PUT")
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modifiedCompany" id="modifiedCompany"
                                    placeholder="Company Name">
                                <label for="modifiedCompany">Company Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="modifiedPhone" name="modifiedPhone"
                                    placeholder="Contact Number" max="9999999999"
                                    pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                <label for="modifiedPhone">Contact Number</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="modifiedAddress" id="modifiedAddress" rows="5" placeholder="Company Address"
                                    class="form-control"></textarea>
                                <label for="modifiedAddress">Company Address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="modifiedCountry" id="modifiedCountry" placeholder="Country">
                                    <label for="modifiedCountry">Country</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="modifiedState" id="modifiedState" placeholder="State">
                                    <label for="modifiedState">State</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="modifiedPrice" id="modifiedPrice" placeholder="Price Per Kg">
                                <label for="modifiedPrice">Price Per Kg</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="modifiedEffectiveFrom" id="modifiedEffectiveFrom" placeholder="DOB" max="{{now()->format('Y-m-d')}}">
                                <label for="modifiedEffectiveFrom">Date Effective From</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customJS')
<!-- Javascript For Universal API Integration -->
<script>
    $(document).ready(function () {
        $("#country").change(function () {
            var country = $(this).val();
            if (country == "") {
                country = "null";
            }
            var data = {
                auth_token: $("#auth_token").val(),
                country: country
            }
            $.ajax({
                url: "{{ route('getStates') }}",
                type: "GET",
                data: data,
                success: function (response) {
                    var states = JSON.parse(response);
                    var html = '<option value="">Select State</option>';
                    if (states.length > 0) {
                        for (let i = 0; i < states.length; i++) {
                            var state = states[i]['state_name'];
                            html += '<option value="' + state + '">' + state + '</option>';
                        }
                    }
                    $("#state").html(html);
                }
            });
        });
    });

    modifyCourier = document.getElementsByClassName('modifyCourier');
    Array.from(modifyCourier).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('courierMaster.edit', '') }}/" + modifyId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modifiedCompany').val(response.data.company);
                        $('#modifiedAddress').val(response.data.address);
                        $('#modifiedPhone').val(response.data.phone);
                        $('#modifiedCountry').val(response.data.country);
                        $('#modifiedState').val(response.data.state);
                        $('#modifiedPrice').val(response.data.price);
                        $('#modifiedEffectiveFrom').val(response.data.effective_from);
                    }
                }
            });
            $('#modifyCourierModal').modal('show');
        });
    });

    deleteCourier = document.getElementsByClassName('deleteCourier');
    Array.from(deleteCourier).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteCourierModal').modal('show');
        });
    });
</script>
@endsection
