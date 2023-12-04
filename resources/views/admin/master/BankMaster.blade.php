@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
      <div class="pagetitle">
        <h3 class="text-primary">Bank Master</h3>
      </div><!-- End Page Title -->

      <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('bankMaster.store') }}" class="medicine_search">
                    @csrf
                    <div class="row row-gap-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Bank Name">
                                <label for="name">Bank Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                              <input type="text" class="form-control @error('ifsc') is-invalid @enderror" id="ifsc" name="ifsc" placeholder="IFSC Code">
                              <label for="ifsc">IFSC Code</label>
                                @error('ifsc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('account') is-invalid @enderror" name="account" id="account" placeholder="Account Number">
                                <label for="account">Account Number</label>
                                @error('account')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Contact No" max="9999999999"
                                    pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if( this.value.length == 10 ) return false;">
                                <label for="phone">Contact No.</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>                              
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                              <textarea name="address" id="address @error('address') is-invalid @enderror" rows="5" placeholder="Company Address" class="form-control"></textarea>
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
            <h5 class="px-4">All Banks</h5>
          </div>
            <div class="card-body question_master_table">
              
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable text-center">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Bank</th>
                        <th scope="col">IFSC</th>
                        <th scope="col">Acc&nbsp;No</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Modify</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                            <tr>
                                <th scope="row">{{$bank->id}}</th>
                                <td>{{ucwords($bank->name)}}</td>
                                <td>{{strtoupper($bank->ifsc)}}</td>
                                <td>{{$bank->account}}</td>
                                <td>{{ucwords($bank->address)}}</td>
                                <td>{{$bank->phone}}</td>
                                <td><button type="button" class="modifyBank" modifyId="{{ $bank->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button></td>
                                <td><button type="button" class="deleteBank" deleteId="{{ $bank->id }}">
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
<div class="modal fade delete_modal" id="deleteBankModal" tabindex="-1">
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
                <form method="POST" action="{{ route('bankMaster.destroy') }}">
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

  <div class="modal fade" id="modifyBankModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('bankMaster.update') }}">
            @csrf
            @method('PUT')
            <input type="hidden" id="modifyId" name="modifyId">
            <div class="row row-gap-3 justify-content-center">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="modifiedName" id="modifiedName" placeholder="Bank Name">
                        <label for="modifiedName">Bank Name</label>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="modifiedIfsc" name="modifiedIfsc" placeholder="IFSC Code">
                      <label for="modifiedIfsc">IFSC Code</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="modifiedAccount" id="modifiedAccount" placeholder="Account Number">
                        <label for="modifiedAccount">Account Number</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="modifiedPhone" name="modifiedPhone" pattern="\d*" placeholder="Contact No" required max="9999999999"
                                    pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if( this.value.length == 10 ) return false;">
                        <label for="modifiedPhone">Contact No.</label>
                    </div>                              
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <textarea name="modifiedAddress" id="modifiedAddress" rows="5" placeholder="Company Address" class="form-control"></textarea>
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
    modifyBank = document.getElementsByClassName('modifyBank');
    Array.from(modifyBank).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyId = element.getAttribute("modifyId");
            $('#modifyId').val(modifyId)
            $.ajax({
                url: "{{ route('bankMaster.edit', '') }}/" + modifyId,
                type: "GET",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modifiedName').val(response.data.name);
                        $('#modifiedIfsc').val(response.data.ifsc);
                        $('#modifiedAccount').val(response.data.account);
                        $('#modifiedPhone').val(response.data.phone);
                        $('#modifiedAddress').val(response.data.address);
                    }
                }
            });
            $('#modifyBankModal').modal('show');
        });
    });

    deleteBank = document.getElementsByClassName('deleteBank');
    Array.from(deleteBank).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteId = element.getAttribute("deleteId");
            $('#deleteId').val(deleteId);
            $('#deleteBankModal').modal('show');
        });
    });
</script>
@endsection
