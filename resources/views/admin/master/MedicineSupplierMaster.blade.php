@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary">Medicine Supplier Master</h3>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('medicineSupplierMaster.store') }}" class="medicine_search">
                    @csrf
                    <div class="row row-gap-3 justify-content-center">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('supplier') is-invalid @enderror" name="supplier" id="supplier"
                                    placeholder="Supplier Name" value="{{old('supplier')}}">
                                <label for="supplier">Supplier Name</label>
                                @error('supplier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                    placeholder="Mobile Number" value="{{old('phone')}}" max="9999999999"
                                    pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                <label for="phone">Mobile Number</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('gst') is-invalid @enderror" id="gst" name="gst"
                                    placeholder="GST Number" value="{{old('gst')}}">
                                <label for="gst">GST Number</label>
                                @error('gst')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="address" id="address" rows="5" placeholder="Address"
                                    class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                                <label for="address">Address</label>
                                @error('address')
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
                <h5 class="px-4">All Suppliers</h5>
            </div>
            <div class="card-body question_master_table">

                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Supplier&nbsp;Name</th>
                                <th scope="col">Mobile&nbsp;No</th>
                                <th scope="col">GST&nbsp;No</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicineSuppliers as $medicineSupplier)
                            <tr>
                                <th scope="row">{{ $medicineSupplier->id }}</th>
                                <td>{{ ucwords($medicineSupplier->supplier) }}</td>
                                <td>{{ $medicineSupplier->phone }}</td>
                                <td>{{ strtoupper($medicineSupplier->gst) }}</td>
                                <td><button type="button" class="modifyMedicineSupplier" modifyId="{{ $medicineSupplier->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                                <td><button type="button" class="deleteMedicineSupplier" deleteId="{{ $medicineSupplier->id }}">
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
<div class="modal fade delete_modal" id="deleteMedicineSupplierModal" tabindex="-1">
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
                <form method="POST" action="{{ route('medicineSupplierMaster.destroy') }}">
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

<div class="modal fade" id="modifyMedicineSupplierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('medicineSupplierMaster.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modifiedSupplier" id="modifiedSupplier"
                                    placeholder="Supplier Name">
                                <label for="modifiedSupplier">Supplier Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="modifiedPhone" name="modifiedPhone"
                                    placeholder="Mobile Number" max="9999999999"
                                    pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                <label for="modifiedPhone">Mobile Number</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="modifiedGst" name="modifiedGst"
                                    placeholder="GST Number">
                                <label for="modifiedGst">GST Number</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="modifiedAddress" id="modifiedAddress" rows="5" placeholder="Address"
                                    class="form-control"></textarea>
                                <label for="modifiedAddress">Address</label>
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
<script>
    modifyMedicineSupplier = document.getElementsByClassName('modifyMedicineSupplier');
    Array.from(modifyMedicineSupplier).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('medicineSupplierMaster.edit', '') }}/" + modifyId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modifiedSupplier').val(response.data.supplier);
                        $('#modifiedAddress').val(response.data.address);
                        $('#modifiedPhone').val(response.data.phone);
                        $('#modifiedGst').val(response.data.gst);
                    }
                }
            });
            $('#modifyMedicineSupplierModal').modal('show');
        });
    });

    deleteMedicineSupplier = document.getElementsByClassName('deleteMedicineSupplier');
    Array.from(deleteMedicineSupplier).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteMedicineSupplierModal').modal('show');
        });
    });
</script>
@endsection
