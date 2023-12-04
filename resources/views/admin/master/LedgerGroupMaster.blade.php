@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary">Ledger Groups</h3>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('ledgerGroupMaster.store') }}" class="medicine_search">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <label for="group_name" class="fs-4 fw-semibold">Group Name</label>
                            <input type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name" id="group_name" value="{{old('group_name')}}">
                            @error('group_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="text-end">
                                <button class="btn btn-primary rounded-3" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="patient-details-inner">
                <h5 class="px-4">All Groups</h5>
            </div>
            <div class="card-body question_master_table">
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr>
                                <th scope="row">{{ $group->id }}</th>
                                <td>{{ ucwords($group->group_name) }}</td>
                                @if ($group->id <= 5)
                                <td><button type="button" class="modifyGroup" modifyId="{{ $group->id }}" disabled>
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                                <td><button type="button" class="deleteGroup" deleteId="{{ $group->id }}" disabled>
                                    <i class="bi bi-trash"></i>
                                </button></td>
                                @else
                                <td><button type="button" class="modifyGroup" modifyId="{{ $group->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                                <td><button type="button" class="deleteGroup" deleteId="{{ $group->id }}">
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
<div class="modal fade delete_modal" id="deleteGroupModal" tabindex="-1">
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
                <form method="POST" action="{{ route('ledgerGroupMaster.destroy') }}">
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

<div class="modal fade" id="modifyGroupModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ledgerGroupMaster.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-12">
                            <input class="form-control" name="modifiedGroupName" id="modifiedGroupName">
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
    modifyGroup = document.getElementsByClassName('modifyGroup');
    Array.from(modifyGroup).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('ledgerGroupMaster.edit', '') }}/" + modifyId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modifiedGroupName').val(response.data.group_name);
                    }
                }
            });
            $('#modifyGroupModal').modal('show');
        });
    });

    deleteGroup = document.getElementsByClassName('deleteGroup');
    Array.from(deleteGroup).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteGroupModal').modal('show');
        });
    });
</script>

@endsection
