@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary">Medicine Master</h3>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('medicineMaster.store') }}" class="medicine_search">
                    @csrf
                    <div class="row row-gap-3 justify-content-center">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('medicine') is-invalid @enderror" name="medicine" id="medicine"
                                    placeholder="Medicine" value={{old('medicine')}}>
                                <label for="medicine">Medicine</label>
                                @error('medicine')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control @error('reorder_level') is-invalid @enderror" id="reorder_level" name="reorder_level"
                                    placeholder="Reorder Level" value={{old('reorder_level')}}>
                                <label for="reorder_level">Reorder Level</label>
                                @error('reorder_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" placeholder="Unit" value={{old('unit')}}>
                                <label for="unit">Unit</label>
                                @error('unit')
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
                <h5 class="px-4">All Medicines</h5>
            </div>
            <div class="card-body question_master_table">

                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Medicine</th>
                                <th scope="col">Reorder&nbsp;Level</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicines as $medicine)
                            <tr>
                                <th scope="row">{{ $medicine->id }}</th>
                                <td>{{ ucwords($medicine->medicine) }}</td>
                                <td>{{ $medicine->reorder_level }}</td>
                                <td>{{ ucwords($medicine->unit) }}</td>
                                <td><button type="button" class="modifyMedicine" modifyId="{{ $medicine->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                                <td><button type="button" class="deleteMedicine" deleteId="{{ $medicine->id }}">
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
<div class="modal fade delete_modal" id="deleteMedicineModal" tabindex="-1">
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
                <form method="POST" action="{{ route('medicineMaster.destroy') }}">
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

<div class="modal fade" id="modifyMedicineModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('medicineMaster.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modifiedMedicine" id="modifiedMedicine"
                                    placeholder="Medicine">
                                <label for="modifiedMedicine">Medicine</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="modified_reorder_level" name="modified_reorder_level"
                                    placeholder="Reorder Level">
                                <label for="modified_reorder_level">Reorder Level</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="modifiedUnit" name="modifiedUnit" placeholder="Unit">
                                <label for="modifiedUnit">Unit</label>
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
    modifyMedicine = document.getElementsByClassName('modifyMedicine');
    Array.from(modifyMedicine).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('medicineMaster.edit', '') }}/" + modifyId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modifiedMedicine').val(response.data.medicine);
                        $('#modified_reorder_level').val(response.data.reorder_level);
                        $('#modifiedUnit').val(response.data.unit);
                    }
                }
            });
            $('#modifyMedicineModal').modal('show');
        });
    });

    deleteMedicine = document.getElementsByClassName('deleteMedicine');
    Array.from(deleteMedicine).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteMedicineModal').modal('show');
        });
    });
</script>
@endsection
