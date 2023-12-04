@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary">Ledger Sub Groups</h3>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('ledgerSubGroupMaster.store')}}" class="medicine_search py-3">
                    @csrf
                    <div class="row justify-content-center row-gap-3">
                        <div class="col-md-10">
                            <div class="L-creation d-flex align-items-center">
                                <label for="group_id" class="fs-4 fw-semibold">Group Name</label>
                                <select class="form-select @error('group_id') is-invalid @enderror" aria-label="Default select example" name="group_id" id="group_id">
                                    <option selected value="">Select Group Name</option>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{ucwords($group->group_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="L-creation d-flex align-items-center">
                                <label for="sub_group_name" class="fs-4 fw-semibold">Sub Group Name</label>
                                <input type="text" class="form-control sub_group_input @error('sub_group_name') is-invalid @enderror" name="sub_group_name" id="sub_group_name">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="L-creationn d-flex align-items-center">
                                <label for="opening_balance" class="fs-4 fw-semibold">Opening Balance</label>
                                <div class="L-creationn-inner">
                                    <input type="text" class="form-control @error('opening_balance') is-invalid @enderror" name="opening_balance" id="opening_balance">
                                    <select class="form-select @error('balance_type') is-invalid @enderror" aria-label="Default select example" name="balance_type" id="balance_type">
                                        <option selected value="">Select Type</option>
                                        <option value="Debit">Debit</option>
                                        <option value="Credit">Credit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="patient-details-inner">
                <h5 class="px-4">All Sub Groups</h5>
            </div>
            <div class="card-body question_master_table">
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Group</th>
                                <th scope="col">Sub Group</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Type</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subGroups as $subGroup)
                            <tr>
                                <th scope="row">{{ $subGroup->id }}</th>
                                <td>{{ $subGroup->Group->group_name }}</td>
                                <td>{{ $subGroup->sub_group_name }}</td>
                                <td>{{ $subGroup->opening_balance }}</td>
                                <td>{{ $subGroup->balance_type }}</td>
                                @if ($subGroup->id <= 4)
                                    <td><button type="button" class="modifySubGroup" modifyId="{{ $subGroup->id }}" disabled>
                                        <i class="bi bi-pencil-square"></i>
                                    </button></td>
                                    <td><button type="button" class="deleteSubGroup" deleteId="{{ $subGroup->id }}" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button></td>
                                @else
                                    <td><button type="button" class="modifySubGroup" modifyId="{{ $subGroup->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button></td>
                                    <td><button type="button" class="deleteSubGroup" deleteId="{{ $subGroup->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button></td>
                                @endif
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
</main>
<!-- End #main -->

<!-- ...........Modals.......... -->
<div class="modal fade delete_modal" id="deleteSubGroupModal" tabindex="-1">
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
                <form method="POST" action="{{ route('ledgerSubGroupMaster.destroy') }}">
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

<div class="modal fade" id="modifySubGroupModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ledgerSubGroupMaster.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example" name="modified_group_id" id="modified_group_id">
                                    <option selected value="">Select Group Name</option>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>
                                    @endforeach
                                </select>
                                <label for="modified_group_id">Group Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_sub_group_name" id="modified_sub_group_name">
                                <label for="modified_sub_group_name">Sub Group Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_opening_balance" id="modified_opening_balance">
                                <label for="modified_opening_balance">Opening Balance</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Default select example" name="modified_balance_type" id="modified_balance_type">
                                        <option selected value="">Select Type</option>
                                        <option value="Debit">Debit</option>
                                        <option value="Credit">Credit</option>
                                    </select>
                                    <label for="modified_balance_type">Balance Type</label>
                                </div>
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
    modifySubGroup = document.getElementsByClassName('modifySubGroup');
    Array.from(modifySubGroup).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('ledgerSubGroupMaster.edit', '') }}/" +
                    modifyId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modified_group_id').val(response.data.group_id);
                        $('#modified_sub_group_name').val(response.data.sub_group_name);
                        $('#modified_opening_balance').val(response.data.opening_balance);
                        $('#modified_balance_type').val(response.data.balance_type);
                    }
                }
            });
            $('#modifySubGroupModal').modal('show');
        });
    });

    deleteSubGroup = document.getElementsByClassName('deleteSubGroup');
    Array.from(deleteSubGroup).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteSubGroupModal').modal('show');
        });
    });

</script>

@endsection
