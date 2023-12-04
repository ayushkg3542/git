@extends("admin.layouts.app")

@section("content")
<!-- ======= Header ======= -->
@include("admin.layouts.header")

<!-- ======= Sidebar ======= -->
@include("admin.layouts.sidebar")

<main id="main" class="main leaves-bg leaves-bg2">
    <!-- <div class="pagetitle">
        <h1>Blank Page</h1>
    </div> -->
    <!-- End Page Title -->

    <section class="section button-section w-75 mx-auto">
        <div class="row align-items-center row-gap-4">
            <div class="col-md-4 text-center">
                <a href="{{ route('patient.create') }}">
                    <button class="button-36 patient-btn" role="button">
                        <span class="text">New Patient</span>
                    </button>
                </a>
            </div>

            <div class="col-md-4 text-center">
                <a href="{{ route('medicineSale.index') }}">
                    <button class="button-36 medicine-btn text-center" role="button">
                        <span class="text">medicine Sale</span>
                    </button>
                </a>
            </div>

            <div class="col-md-4 text-center">
                <a href="{{ route('medicinePurchase.index') }}">
                    <button class="button-36 stock-btn" role="button">
                        <span class="text">Add STOCK</span>
                    </button>
                </a>
            </div>
        </div>
    </section>
<!-- ======= Footer ======= -->
@include("admin.layouts.footer")
</main><!-- End #main -->
<!-- End #main -->


@endsection

@section("customJS")

@endsection
