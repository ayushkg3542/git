@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <h3 class="text-primary"></h3>
    </div><!-- End Page Title -->
    <section class="section">
        <div id="printDiv" class="card pt-5 pb-4">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="address pb-4 w-50 mx-auto text-center">
                        <h2>GUPTA CLINIC</h2>
                        <h5>3229, Sec 27D Chandigarh 160019</h5>
                        <h5>Medicine Sale Report</h5>
                        <h5>{{Carbon\Carbon::parse(request('start_date'))->format('d-M-Y'). " To " .Carbon\Carbon::parse(request('end_date'))->format('d-M-Y')}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body question_master_table row">
                <!-- Table with stripped rows -->
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice&nbsp;No</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Billing&nbsp;Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                  $i = 1;
                                @endphp
                                @foreach($saleInvoices as $saleInvoice)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ Carbon\Carbon::parse($saleInvoice->invoice_date)->format('d-M-Y') }}
                                        </td>
                                        <td>{{ $saleInvoice->invoice_number }}</td>
                                        <td>{{ $saleInvoice->Patient->first_name }}</td>
                                        <td>{{ $saleInvoice->invoice_net }}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <th>Total</th>
                                        <th>{{ $saleInvoices->sum('invoice_net') }}</th>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        <button type="button" class="btn btn-primary px-4" id="printButton" onclick="printReport()">Print</button>
    </div>
    @include('admin.layouts.footer')
</main><!-- End #main -->

@endsection

@section('customJS')
<script>
  function printReport() {
    var printContents = document.getElementById('printDiv').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
  }
</script>
@endsection
