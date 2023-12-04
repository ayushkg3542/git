@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
      <div class="pagetitle d-flex align-items-center justify-content-between">
        <h1 class="text-primary">Patient Details</h1>
        <a href="{{route('patient.create')}}" class="add-patient">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <rect width="20" height="20" fill="url(#pattern0)"/>
            <defs>
            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_34_1074" transform="scale(0.05)"/>
            </pattern>
            <image id="image0_34_1074" width="20" height="20" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQZJREFUeNqcVNERwiAMLZ7/MkI3sCM4AiN0BDewG/ScADeoG7RO0DqBOoHdAIOX3uUoBOi7yxVC+kjCA1FEYIyp4VPidBJC3IstAKIK7GXWsL5qC9kXrQaTaDXxVzmEXegn3MyizyG0aJl1bQN8aztfBjh8Mnt+nNgwIZzihMMjQ3hwYqMlj3ia0rMmsb9jTg8V9tESl8Rfos9C5UrnTLQ3EiKDYs8ia7CsBT1aSzNOJdOERDFxfbRsQqYTtdpwAadUslTC5brJSJkh/EW+X7QFH9uPG4h1ZhK7gj1wfAEbyPztK1dl3vcmevUyMYd2k47ufOg8z9iq38J5ZbiSB+jvEEv5J8AAxwyUV9YxwzoAAAAASUVORK5CYII="/>
            </defs>
            </svg>Add New</a>
      </div><!-- End Page Title -->

      <section class="section">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="status-cards bg-white position-relative">
                    <h6 class="text-primary">All<br>Patients</h6>
                    <h5 class="mb-0">{{ $patients->count() }}</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="status-cards bg-white position-relative">
                    <h6 class="text-primary">Newly<br>Registered</h6>
                    <h5 class="mb-0">{{ $patients->where('status_id', 1)->count() }}</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="status-cards bg-white position-relative">
                    <h6 class="text-primary">Under<br>Diagonsis</h6>
                    <h5 class="mb-0">{{ $patients->where('status_id', 2)->count() }}</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="status-cards bg-white position-relative">
                    <h6 class="text-primary">Treatment<br>Completed</h6>
                    <h5 class="mb-0">{{ $patients->where('status_id', 3)->count() }}</h5>
                </div>
            </div>
        </div>
        <div class="patient-details pt-4">
            <div class="patient-details-inner">
                <h5 class="px-4">Patient Details</h5>
                <div class="px-4">
                    <div class="card">
                        <div class="card-body table-responsive">
                          
                          <!-- Table with stripped rows -->
                          <table class="table datatable profile_th">
                            <thead>
                              <tr>
                                <th scope="col">File&nbsp;No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile&nbsp;No</th>
                                <th scope="col">Status</th>
                                <th scope="col">Profile</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($patients as $patient)
                              <tr>
                                <th scope="row">{{ ucwords($patient->file_number) }}</th>
                                <td>{{ ucwords($patient->first_name ." ". $patient->last_name) }}</td>
                                <td>{{ $patient->ContactDetail ? $patient->ContactDetail->phone : ''}}</td>
                                <td>{{ $patient->PatientStatus->status }}</td>
                                <td><a href="{{ route('patient.view', $patient->id) }}" class="vieww"><i class="bi bi-eye"></i></a></td>
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
      @include('admin.layouts.footer')
  </main><!-- End #main -->

@endsection

@section('customJS')

@endsection