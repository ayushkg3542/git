@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <h1 class="text-primary">Medicine Stock</h1>
        <a href="{{route('medicinePurchase.index')}}" class="add-patient">
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
            </svg>Add Stock</a>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="patient-details pt-4">
            <div class="patient-details-inner">
                <h5 class="px-4">Available Stock</h5>
                <div class="px-4">
                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Medicine</th>
                                        <th scope="col">Reorder level</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Updated On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicineStocks as $medicineStock)
                                    <tr>
                                        <th scope="row">{{$medicineStock->id}}</th>
                                        <td>{{$medicineStock->Medicine->medicine}}</td>
                                        <td>{{$medicineStock->Medicine->reorder_level}}</td>
                                        <td>{{$medicineStock->stock}}</td>
                                        <td>{{ Carbon\Carbon::parse($medicineStock->updated_at)->format('d-M-Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('admin.layouts.footer')

@endsection

@section('customJS')

@endsection
