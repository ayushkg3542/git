@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <h3 class="text-primary">Medicine Sale</h3>
        <a href="{{route('medicineSale.index')}}" class="add-patient">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                viewBox="0 0 20 20" fill="none">
                <rect width="20" height="20" fill="url(#pattern0)" />
                <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_34_1074" transform="scale(0.05)" />
                    </pattern>
                    <image id="image0_34_1074" width="20" height="20"
                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQZJREFUeNqcVNERwiAMLZ7/MkI3sCM4AiN0BDewG/ScADeoG7RO0DqBOoHdAIOX3uUoBOi7yxVC+kjCA1FEYIyp4VPidBJC3IstAKIK7GXWsL5qC9kXrQaTaDXxVzmEXegn3MyizyG0aJl1bQN8aztfBjh8Mnt+nNgwIZzihMMjQ3hwYqMlj3ia0rMmsb9jTg8V9tESl8Rfos9C5UrnTLQ3EiKDYs8ia7CsBT1aSzNOJdOERDFxfbRsQqYTtdpwAadUslTC5brJSJkh/EW+X7QFH9uPG4h1ZhK7gj1wfAEbyPztK1dl3vcmevUyMYd2k47ufOg8z9iq38J5ZbiSB+jvEEv5J8AAxwyUV9YxwzoAAAAASUVORK5CYII=" />
                </defs>
            </svg>New Invoice
        </a>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <form id="formData" method="POST" action="{{ route('medicineSale.store') }}">
            @csrf
            <div class="card bg-transparent">
                <div class="card-body">
                    <div class="row mb-3 bg-white py-3 rounded-3 justify-content-between">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <label for="invoice_number" class="fw-semibold">Invoice No</label>
                                <input type="text"
                                    class="form-control invoice_number @error('invoice_number') is-invalid @enderror"
                                    name="invoice_number" id="invoice_number" oninput="fetchData()"
                                    value="{{ Request::get('invoiceNo') ? Request::get('invoiceNo') : $invoiceNo}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-md-3 align-items-center">
                                <label for="invoice_date" class="fw-semibold">Dated</label>
                                <input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
                                    name="invoice_date" id="invoice_date" placeholder="Dated"
                                    value="{{ now()->format('Y-m-d') }}" max="{{now()->format('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="patient"
                                    class="fw-semibold w-auto pt-1 @error('patient') is-invalid @enderror">Patient
                                    ID</label>
                                <div class="purchase_party">
                                    <select class="form-select" aria-label="Default select example" name="patient"
                                        id="patient" onchange="getName(this.value)">
                                        <option value="">Select ID</option>
                                        @foreach($patients as $patient)
                                            @if (old('patient') == $patient->id)
                                                <option selected value="{{ $patient->id }}">
                                                    {{ $patient->file_number }}</option>
                                            @else
                                                <option value="{{ $patient->id }}">{{ $patient->file_number }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <h6 id="patient_name" class="mb-0 pt-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 bg-white py-3 rounded-3 justify-content-between">
                        <div class="col-md-4 pe-md-3">
                            <div class="d-flex gap-2 align-items-center">
                                <label for="payment_method" class="fw-semibold">By</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror"
                                    name="payment_method" id="payment_method" aria-label="Default select example"
                                    onchange="handleBank()">
                                    <option value="">Select Payment Method</option>
                                    <option @if(old('payment_method')=="Cash" ) selected @endif value="Cash">Cash
                                    </option>
                                    <option @if(old('payment_method')=="Bank" ) selected @endif value="Bank">Bank
                                        Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pe-md-3">
                            <div class="d-flex gap-2 align-items-center">
                                <label for="bank" class="fw-semibold @error('bank') is-invalid @enderror">Bank</label>
                                <select class="form-select w-50" aria-label="Default select example" name="bank"
                                    id="bank" disabled>
                                    <option value="">Select Bank</option>
                                    @foreach($banks as $bank)
                                        @if(old('bank') == $bank->id)
                                            <option selected value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @else
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pe-md-3">
                            <div class="d-flex gap-2 align-items-center">
                                <label for="narration" class="fw-semibold">Narration</label>
                                <input type="text" class="form-control" id="narration" name="narration"
                                    value={{ old('narration') }}>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 bg-white py-3 rounded-3 justify-content-between row-gap-3">
                        <div class="col-md-2">
                            <div>
                                <label for="medicine" class="fw-semibold">Medicine</label>
                                <select class="form-select" name="medicine" id="medicine"
                                    aria-label="Default select example" onchange="checkMedicine()">
                                    <option selected value="">Select Medicine</option>
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->medicine }}">
                                            {{ optional($medicine->Medicine)->medicine }} ({{ $medicine->stock }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label for="quantity" class="fw-semibold">Quantity</label>
                                <input type="number" step="any" class="form-control" id="quantity" name="quantity"
                                    oninput="checkStock()" disabled>    
                                <div id="invalid-stock" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label for="rate" class="fw-semibold">Rate</label>
                                <input type="number" step="any" class="form-control" id="rate" name="rate"
                                    oninput="calculateTotal()">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label for="total_amount" class="fw-semibold">Total Amount</label>
                                <input type="number" step="any" class="form-control" id="total_amount"
                                    name="total_amount" oninput="calculateNet()" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label for="tax" class="fw-semibold">Tax</label>
                                <input type="number" step="any" class="form-control" id="tax" name="tax"
                                    oninput="calculateNet()">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <div>
                                    <label for="net_amount" class="fw-semibold">Net</label>
                                    <input type="number" step="any" class="form-control" id="net_amount"
                                        name="net_amount" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mt-0 fs-6" type="button" onclick="storeData()">Add
                                    Medicine</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body question_master_table">
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm">
                            <thead class="medi_pur_thead">
                                <tr>
                                    <th scope="col" class="medi_pur_th">Sr No</th>
                                    <th scope="col" class="medi_pur_th">Medicine</th>
                                    <th scope="col" class="medi_pur_th">Quantity</th>
                                    <th scope="col" class="medi_pur_th">Rate</th>
                                    <th scope="col" class="medi_pur_th">Amount</th>
                                    <th scope="col" class="medi_pur_th">Tax</th>
                                    <th scope="col" class="medi_pur_th">Net</th>
                                    <th scope="col" class="medi_pur_th">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body question_master_table">
                    <div class="texes">
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="cgst" class="fw-semibold">CGST</label>
                                <input type="number" step="any" name="cgst" id="cgst" class="form-control"
                                    value="{{ old('cgst') }}" oninput="calculateGST()">
                            </div>
                        </div>
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="sgst" class="fw-semibold">SGST</label>
                                <input type="number" step="any" name="sgst" id="sgst" class="form-control"
                                    value="{{ old('sgst') }}" oninput="calculateGST()">
                            </div>
                        </div>
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="gst" class="fw-semibold">GST</label>
                                <input type="number" step="any" name="gst" id="gst" class="form-control"
                                    value="{{ old('gst') }}" oninput="calculateInvoiceNet()" readonly>
                            </div>
                        </div>
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="freight" class="fw-semibold">Freight</label>
                                <input type="number" step="any" name="freight" id="freight" class="form-control"
                                    value="{{ old('freight') }}" oninput="calculateInvoiceNet()">
                            </div>
                        </div>
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="labour" class="fw-semibold">Labour</label>
                                <input type="number" step="any" name="labour" id="labour" class="form-control"
                                    value="{{ old('labour') }}" oninput="calculateInvoiceNet()">
                            </div>
                        </div>
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="invoice_total"
                                    class="fw-semibold @error('invoice_total') is-invalid @enderror">Total</label>
                                <input type="number" step="any" name="invoice_total" id="invoice_total"
                                    class="form-control" value="{{ old('invoice_total') }}"
                                    oninput="calculateInvoiceNet()" readonly>
                            </div>
                        </div>
                        <div class="taxes-inner">
                            <div class="d-flex align-items-center gap-1">
                                <label for="invoice_net"
                                    class="fw-semibold @error('invoice_net') is-invalid @enderror">Net</label>
                                <input type="number" step="any" name="invoice_net" id="invoice_net" class="form-control"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button id="submitButton" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    @include('admin.layouts.footer');
</main><!-- End #main -->

<!-- ...........Modals.......... -->
<div class="modal fade delete_modal" id="deletePurchaseModal" tabindex="-1">
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
                <form id="deletedData">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteId" name="deleteId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="deleteData()">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modifyPurchaseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modifiedData">
                    @csrf
                    @method("PUT")
                    <div class="row row-gap-3 justify-content-center">
                        <input type="hidden" id="modifyId" name="modifyId">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="modifiedMedicine" id="modifiedMedicine"
                                    aria-label="Default select example">
                                    <option selected="">Select Medicine</option>
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->medicine }}">
                                            {{ $medicine->Medicine->medicine ." (". $medicine->stock .")" }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="modifiedMedicine">Medicine</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control" id="modifiedQuantity"
                                    name="modifiedQuantity" placeholder="Quantity" oninput="calculateModifiedTotal()">
                                <label for="modifiedQuantity">Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="modifiedRate"
                                        id="modifiedRate" placeholder="Rate" oninput="calculateModifiedTotal()">
                                    <label for="modifiedRate">Rate</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="modifiedTotalAmount"
                                        id="modifiedTotalAmount" placeholder="Total Amount"
                                        oninput="calculateModifiedNet()" readonly>
                                    <label for="modifiedTotalAmount">Total Amount</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="modifiedTax"
                                        id="modifiedTax" placeholder="Tax" oninput="calculateModifiedNet()">
                                    <label for="modifiedTax">Tax</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="modifiedNetAmount"
                                        id="modifiedNetAmount" placeholder="Net Amount" readonly>
                                    <label for="modifiedNetAmount">Net Amount</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="updateData()">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customJS')
<!-- Custom JS To Handle Purchase Calculations -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('invoice_number').dispatchEvent(new Event('input'));
    });

    function handleBank() {
        var paymentMethod = $('#payment_method').val();
        if (paymentMethod == "Cash") {
            document.getElementById("bank").disabled = true;
        } else {
            document.getElementById("bank").disabled = false;
        }
    }

    function getName(patientId) {
        $.ajax({
            url: "{{ route('medicineSale.patientName', '') }}/" + patientId,
            type: "GET",
            success: function (response) {
                if (response['status'] == true) {
                    $('#patient_name').html(response.data);
                }
            }
        });
    }

    function checkMedicine() {
        var medicine = $('#medicine').val();
        if (medicine=="") {
            document.getElementById("quantity").disabled = true;
        } else {
            document.getElementById("quantity").disabled = false;
        }
    }

    function checkStock() {
        console.log("checkStock");
        var medicine = $('#medicine').val();
        var quantity = $('#quantity').val();

        $.ajax({
            url: "{{ route('medicineSale.checkStock', ['medicine' => ':medicine', 'quantity' => ':quantity']) }}"
                .replace(':medicine', medicine)
                .replace(':quantity', quantity),
            type: "GET",
            success: function (response) {
                if (response.status) {
                    $('#quantity').removeClass("is-invalid");
                    $('#invalid-stock').html("");
                } else {
                    $('#quantity').addClass("is-invalid");
                    $('#invalid-stock').html("Please check your stock");
                }
            }
        });

    }

</script>
<script>
    function calculateTotal() {
        var quantity = $('#quantity').val() || 0;
        var rate = $('#rate').val() || 0;
        quantity = parseFloat(quantity);
        rate = parseFloat(rate);
        var totalAmount = quantity * rate;
        $('#total_amount').val(totalAmount);
        calculateNet();
    }

    function calculateNet() {
        var totalAmount = $('#total_amount').val() || 0;
        var tax = $('#tax').val() || 0;
        totalAmount = parseFloat(totalAmount);
        tax = parseFloat(tax);
        var netAmount = totalAmount + tax;
        $('#net_amount').val(netAmount);
    }

    function calculateGST() {
        var cgst = $('#cgst').val() || 0;
        var sgst = $('#sgst').val() || 0;
        cgst = parseFloat(cgst);
        sgst = parseFloat(sgst);
        var gst = cgst + sgst;
        $('#gst').val(gst);
        calculateInvoiceNet();
    }

    function calculateInvoiceNet() {
        var gst = $('#gst').val() || 0;
        var freight = $('#freight').val() || 0;
        var labour = $('#labour').val() || 0;
        var total = $('#invoice_total').val() || 0;
        gst = parseFloat(gst);
        freight = parseFloat(freight);
        labour = parseFloat(labour);
        total = parseFloat(total);
        var net = gst + freight + labour + total;
        $('#invoice_net').val(net);
    }

    function storeData() {
        var formData = $('#formData').serialize();
        $.ajax({
            type: 'POST',
            url: '{{ route('medicineSale.storeData') }}',
            data: formData,
            success: function (response) {
                if (response.status == true) {
                    fetchData();
                    $('#medicine').val('');
                    $('#quantity').val('');
                    $('#rate').val('');
                    $('#total_amount').val('');
                    $('#tax').val('');
                    $('#net_amount').val('');
                }
                alert(response.message);
            },
            error: function (error) {
                alert("Please Check All Inputs");
            }
        });
    }

    function fetchData() {
        var invoiceNumber = $('#invoice_number').val();
        $.ajax({
            type: 'GET',
            url: '{{ route('medicineSale.fetchData') }}',
            data: {
                invoiceNumber: invoiceNumber
            },
            success: function (response) {
                displayData(response.data);
                calculateInvoiceNet();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function displayData(data) {
        // Display Invoice Details
        if (data.invoiceDetail && data.invoiceDetail.length > 0) {
            var invoiceDetail = data.invoiceDetail[0];
            $('#invoice_number').val(invoiceDetail.invoice_number);
            $('#invoice_date').val(invoiceDetail.invoice_date);
            $('#patient').val(invoiceDetail.patient);
            $('#payment_method').val(invoiceDetail.payment_method);
            $('#bank').val(invoiceDetail.bank);
            $('#narration').val(invoiceDetail.narration);
        }

        // Display Purchase Details Table
        var tableBody = $('#dataTable tbody');
        var invoiceTotal = 0;
        tableBody.empty();
        data.purchaseDetail.forEach(function (item) {
            var row = `<tr>
                <td>${item.id}</td>
                <td>${item.medicine.medicine}</td>
                <td>${item.quantity} ${item.medicine.unit}</td>
                <td>${item.rate}</td>
                <td>${item.total_amount}</td>
                <td>${item.tax}</td>
                <td>${item.net_amount}</td>
                <td>
                    <div class="actionss">
                        <button type="button" class="modifyPurchase" modifyId="${item.id}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" class="deletePurchase" deleteId="${item.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
            tableBody.append(row);

            // Update Invoice Total
            invoiceTotal += parseFloat(item.net_amount);
        });
        // Display Invoice Total
        $('#invoice_total').val(invoiceTotal);
        $('#invoice_net').val(invoiceTotal);
    }

    $('#dataTable').on('click', '.deletePurchase', function () {
        var deleteId = $(this).attr('deleteId');
        $('#deleteId').val(deleteId);
        $('#deletePurchaseModal').modal('show');
    });

    function deleteData() {
        var deletedData = $('#deletedData').serialize();
        $.ajax({
            type: 'DELETE',
            url: '{{ route('medicineSale.deleteData') }}',
            data: deletedData,
            success: function (response) {
                fetchData();
                $('#deletePurchaseModal').modal('hide');
                alert(response.message);
            },
            error: function (error) {
                alert(error);
            }
        });
    }

    // Custom JS To Modify Purchase Data
    $('#dataTable').on('click', '.modifyPurchase', function () {
        var modifyId = $(this).attr('modifyId');
        $('#modifyId').val(modifyId);
        $.ajax({
            url: "{{ route('medicineSale.editData', '') }}/" +
                modifyId,
            type: "GET",
            data: "",
            dataType: "",
            success: function (response) {
                if (response['status'] == true) {
                    $('#modifiedMedicine').val(response.data.medicine);
                    $('#modifiedQuantity').val(response.data.quantity);
                    $('#modifiedRate').val(response.data.rate);
                    $('#modifiedTotalAmount').val(response.data.total_amount);
                    $('#modifiedTax').val(response.data.tax);
                    $('#modifiedNetAmount').val(response.data.net_amount);
                }
            }
        });
        $('#modifyPurchaseModal').modal('show');
    });

    function calculateModifiedTotal() {
        var modifiedQuantity = $('#modifiedQuantity').val() || 0;
        var modifiedRate = $('#modifiedRate').val() || 0;
        modifiedQuantity = parseFloat(modifiedQuantity);
        modifiedRate = parseFloat(modifiedRate);
        var modifiedTotalAmount = modifiedQuantity * modifiedRate;
        $('#modifiedTotalAmount').val(modifiedTotalAmount);
        calculateModifiedNet();
    }

    function calculateModifiedNet() {
        var modifiedTotalAmount = $('#modifiedTotalAmount').val() || 0;
        var modifiedTax = $('#modifiedTax').val() || 0;
        modifiedTotalAmount = parseFloat(modifiedTotalAmount);
        modifiedTax = parseFloat(modifiedTax);
        var modifiedNetAmount = modifiedTotalAmount + modifiedTax;
        $('#modifiedNetAmount').val(modifiedNetAmount);
    }

    function updateData() {
        var modifiedData = $('#modifiedData').serialize();
        $.ajax({
            type: 'PUT',
            url: '{{ route('medicineSale.updateData') }}',
            data: modifiedData,
            success: function (response) {
                fetchData();
                $('#modifyPurchaseModal').modal('hide');
                alert(response.message);
            },
            error: function (error) {
                alert(error);
            }
        });
    }

    

</script>
@endsection
