@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary">Question Master</h3>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('questionMaster.store') }}" class="medicine_search">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <label for="question" class="fs-4 fw-semibold">Question</label>
                            <textarea class="form-control @error('question') is-invalid @enderror" name="question" id="question" style="height: 100px;">{{old('question')}}</textarea>
                            @error('question')
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
                <h5 class="px-4">All Questions</h5>
            </div>
            <div class="card-body question_master_table">
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Question</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            <tr>
                                <th scope="row">{{ $question->id }}</th>
                                <td class="text-left">{{ ucwords($question->question) }}</td>
                                <td><button  type="button" class="modifyQuestion" modifyId="{{ $question->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                                <td><button type="button" class="deleteQuestion" deleteId="{{ $question->id }}">
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
</main>
<!-- End #main -->

<!-- ...........Modals.......... -->
<div class="modal fade delete_modal" id="deleteQuestionModal" tabindex="-1">
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
                <form method="POST" action="{{ route('questionMaster.destroy') }}">
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

<div class="modal fade" id="modifyQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('questionMaster.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-12">
                            <textarea class="form-control @error('modifiedQuestion') is-invalid @enderror" name="modifiedQuestion" id="modifiedQuestion"
                                style="height: 100px;"></textarea>
                        </div>
                        @error('modifiedQuestion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
    modifyQuestion = document.getElementsByClassName('modifyQuestion');
    Array.from(modifyQuestion).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('questionMaster.edit', '') }}/" + modifyId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modifiedQuestion').val(response.data.question);
                    }
                }
            });
            $('#modifyQuestionModal').modal('show');
        });
    });

    deleteQuestion = document.getElementsByClassName('deleteQuestion');
    Array.from(deleteQuestion).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteQuestionModal').modal('show');
        });
    });
</script>

@endsection
