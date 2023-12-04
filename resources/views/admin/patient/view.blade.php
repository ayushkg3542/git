@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<main id="main" class="main leaves-bg">
    <div class="pagetitle">
        <div class="patient-detailss">
            <div class="d-flex align-items-center gap-md-4 gap-2">
                <img src="{{ asset('uploads/PatientPhotos/' . $patient->photo) }}" alt="Patient Photo">
                <div>
                    <h6 class="patient-name">
                        {{ strtoupper($patient->first_name ." ". $patient->last_name) }}
                    </h6>
                    <span class="patient-id">ID : <span>{{ strtoupper($patient->file_number) }}</span></span>
                </div>
            </div>
            <div>
                <a href="{{ route('patient.edit', ['patientId'=>$patient->id]) }}"
                    class="btn btn-primary">Modify</a>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body pt-3 px-4">
                <!-- Bordered Tabs -->
                <ul class="nav personal_tabs nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#PERSONALDETAILS">PERSONAL
                            DETAILS</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#MEDICALDETAILS">MEDICAL
                            DETAILS</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#RXMedicine">RX Medicine</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#COURIERDETAILS">COURIER
                            DETAILS</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#PAYMENT">PAYMENT</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview patient_data" id="PERSONALDETAILS">
                        <div class="row row-gap-4 pt-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>First Name</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->first_name) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Last Name</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->last_name) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Date Of Birth</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ Carbon\Carbon::parse($patient->date_of_birth)->format('d-M-Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Gender</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->gender) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Father’s name</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->father_name) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Mather’s name</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->mother_name) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Nationality</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->nationality) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Passport No</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->passport) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-primary py-4"> CONTACT DETAILS</h6>
                        <div class="row row-gap-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <h6>Address</h6>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        <span>{{ strtoupper($patient->contactDetail->address) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Country</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->ContactDetail->country) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>State</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->ContactDetail->state) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>City</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ strtoupper($patient->ContactDetail->city) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Pin Code</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->ContactDetail->pincode }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Email ID</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->ContactDetail->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Phone No</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->ContactDetail->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade profile-edit pt-3" id="MEDICALDETAILS">

                        <!-- Profile Edit Form -->
                        <div class="row row-gap-4 pt-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Height</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->MedicalDetail ? $patient->MedicalDetail->height : "" }} CM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Weight</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->MedicalDetail ? $patient->MedicalDetail->weight : "" }} KG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Blood Group</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->MedicalDetail ? $patient->MedicalDetail->blood_group : "" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Blood Pressure</h6>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ $patient->MedicalDetail ? $patient->MedicalDetail->blood_pressure : "" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Present Disease</h6>
                                    </div>
                                    <div class="col-9">
                                        <span>{{ $patient->MedicalDetail ? strtoupper($patient->MedicalDetail->present_disease) : "" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Past History</h6>
                                    </div>
                                    <div class="col-9">
                                        <span>{{ $patient->MedicalDetail ? strtoupper($patient->MedicalDetail->past_history) : "" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Family History</h6>
                                    </div>
                                    <div class="col-9">
                                        <span>{{ $patient->MedicalDetail ? strtoupper($patient->MedicalDetail->family_history) : "" }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row question_box row-gap-3">
                            @foreach($patient->DoctorQuestion as $doctorQuestion)
                                <div class="col-12">
                                    <div class="question">
                                        <p>Q{{ $doctorQuestion->id }}</p>
                                        <div>
                                            <h6>{{ strtoupper($doctorQuestion->QuestionMaster->question) }}</h6>
                                            <span>{{ strtoupper($doctorQuestion->answer) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="RXMedicine">

                        <!-- Settings Form -->

                        <div class="card">
                            <h3>New Prescription</h3>
                            <form method="POST"
                                action="{{ route('patient.prescription.store', $patient->id) }}"
                                class="row row-gap-3">
                                @csrf
                                <div class="col-12">
                                    <textarea class="form-control" name="prescription" id="prescription"
                                        rows="5"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3 next-visit">
                                        <input type="number" class="form-control w-25" name="next_visit" id="next_visit"
                                            placeholder="Next Visit" oninput="handleVisit()">
                                        <h5 id="handleVisit" class="mb-0">After _ Days</h5>
                                    </div>
                                </div>
                                <div class="add_button text-end">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive previous_medicine">
                            <h4 class="pb-2">Previous Medicine</h4>
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="th-bg">ID</th>
                                        <th scope="col" class="th-bg">Date</th>
                                        <th scope="col" class="th-bg">Medicine</th>
                                        <th scope="col" class="th-bg">Next&nbsp;Visit</th>
                                        <th scope="col" class="th-bg">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->Prescription->sortByDesc('id') as $prescription)
                                        <tr>
                                            <th scope="row">{{ $prescription->id }}</th>
                                            <td>{{ Carbon\Carbon::parse($prescription->created_at)->format('d-M-Y') }}
                                            </td>
                                            <td class="medi_data">{{ ucwords($prescription->prescription) }}</td>
                                            <td>{{ Carbon\Carbon::parse($prescription->created_at)->addDays($prescription->next_visit)->format('d-M-Y') }}
                                            </td>
                                            <td class="p-0">
                                                <div class="actions">
                                                    <button type="button" class="viewPrescription"
                                                        viewId="{{ $prescription->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button type="button" class="modifyPrescription"
                                                        modifyPrescriptionId="{{ $prescription->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button type="button" class="repeatPrescription"
                                                        repeatPrescriptionId="{{ $prescription->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect width="24" height="24" fill="url(#pattern0)" />
                                                            <defs>
                                                                <pattern id="pattern0"
                                                                    patternContentUnits="objectBoundingBox" width="1"
                                                                    height="1">
                                                                    <use xlink:href="#image0_19_2059"
                                                                        transform="scale(0.025)" />
                                                                </pattern>
                                                                <image id="image0_19_2059" width="40" height="40"
                                                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqNJREFUeNrsWNtN60AQjVcUYDowHSRS/nEqIOkgVEBcAZcKCBUkVABUEPMfKe4Al+AO7p25Oo6GYf3cteIPRlo5D3t9ds7Z2ZkJJo52PB6ndAlpxOLngkZGI5/P57nL/EEPQAxmSeMO1yZjgCmNTwK7HwwggD0DVNjTIezZFxpbAlt4A0jgNnR5dABm82pCIN+dAMJrb0pfpbHGPkBfpj2CZ/m5W3g9ssyxp+fuewGE+N8sEzOgJ5o47ajdGCzElvlWVZQHNeAOitLWtPSQC7OxYJD0P+t8A73OTA2teoKZKzg2mmPLYDBnaeyQHT6vcf0vEWOZY6doPa/O0wZhkJkF5BLe+8aaUd5bqtjmHRze8wcsfYDK0jaVGgS1X2IFBWjNPYNjOk8qNlaFr2ujdCBvfPINTmw2aWGNFAqjVnKmFmL2bpDLQr2v6tSZGCXcFXsOEwxmiKE3NOqiQtYrWfBtpMk1znhNdUoLWZhLA0SGo0POT4ovDJI1P+MsR/z8OhmjcbhDyPu1XxudOCMeY8NlRHbBicIXPo8LIOqG0h4J5Gks3jQik5mozOaEY+iiFoDivzX38IF+7ztpte0BpPupLMjaACxzuBUynkFOD5Us35S5qEE52GQRqryhTFd5odZgbdLYlPk6ei9WtUgqmbpqeHGOwuYWPRXf4MrmgLREfrmy7OC9qE3L/4ao7CKUuNJBW61zY2lDJJai+uAzLorOxVT1aRJbHHwXWnsVRU02RFxE6+NgaQ4kXZtHoWWVLs2jNXZrZCmOFp2aRwrks9Ck3kDs/U/svMKisSk22LpiM25ttLYGqFoiuxahpmgZjnKcTo0sdG0Bs34eHGIiA3vp0hQIegqdKeMmetwC7FkKfdp3gad4FoneTi76L5lr/PwnwACuTCE7VESqMQAAAABJRU5ErkJggg==" />
                                                            </defs>
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="deletePrescription"
                                                        deletePrescriptionId="{{ $prescription->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End settings Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="COURIERDETAILS">
                        <!-- Change Password Form -->
                        <form method="POST"
                            action="{{ route('patient.courier.store', $patient->id) }}"
                            class="row row-gap-3">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-select" name="company" id="company"
                                        aria-label="Default select example" oninput="calculatePrice()">
                                        <option selected="">Select Company</option>
                                        @foreach($courierMaster as $courier)
                                            <option value="{{ $courier->id }}">{{ $courier->company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="weight" id="weight"
                                        placeholder="Weight In Kg" oninput="calculatePrice()">
                                    <label for="weight">Weight In Kg</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" id="price" name="price"
                                        placeholder="Price" readonly>
                                    <label for="price">Price</label>
                                </div>
                            </div>
                            <div class="col-md-6 d-md-block d-none">
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="d-flex align-items-center justify-content-end h-100">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- ......data-table...... -->
                        <div class="table-responsive previous_medicine pt-4">
                            <h4 class="pb-2">Previous Courier Details</h4>
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="th-bg">I'D</th>
                                        <th scope="col" class="th-bg">Dispatch&nbsp;Date</th>
                                        <th scope="col" class="th-bg">Courier&nbsp;Company</th>
                                        <th scope="col" class="th-bg">Price</th>
                                        <th scope="col" class="th-bg">Status</th>
                                        <th scope="col" class="th-bg">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->CourierDetail->sortByDesc('id') as $courierDetail)
                                        <tr>
                                            <th scope="row">{{ $courierDetail->id }}</th>
                                            <td>{{ Carbon\Carbon::parse($courierDetail->created_at)->format('d-M-Y') }}
                                            </td>
                                            <td>{{ ucwords($courierDetail->CourierMaster->company) }}</td>
                                            <td>{{ $courierDetail->price }}</td>
                                            <td>{{ $courierDetail->CourierStatus->status }}</td>
                                            <td class="p-0">
                                                <div class="actions">
                                                    <button type="button" class="modifyStatus"
                                                        statusId="{{ $courierDetail->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect width="24" height="24" fill="url(#pattern0)" />
                                                            <defs>
                                                                <pattern id="pattern0"
                                                                    patternContentUnits="objectBoundingBox" width="1"
                                                                    height="1">
                                                                    <use xlink:href="#image0_19_2059"
                                                                        transform="scale(0.025)" />
                                                                </pattern>
                                                                <image id="image0_19_2059" width="40" height="40"
                                                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqNJREFUeNrsWNtN60AQjVcUYDowHSRS/nEqIOkgVEBcAZcKCBUkVABUEPMfKe4Al+AO7p25Oo6GYf3cteIPRlo5D3t9ds7Z2ZkJJo52PB6ndAlpxOLngkZGI5/P57nL/EEPQAxmSeMO1yZjgCmNTwK7HwwggD0DVNjTIezZFxpbAlt4A0jgNnR5dABm82pCIN+dAMJrb0pfpbHGPkBfpj2CZ/m5W3g9ssyxp+fuewGE+N8sEzOgJ5o47ajdGCzElvlWVZQHNeAOitLWtPSQC7OxYJD0P+t8A73OTA2teoKZKzg2mmPLYDBnaeyQHT6vcf0vEWOZY6doPa/O0wZhkJkF5BLe+8aaUd5bqtjmHRze8wcsfYDK0jaVGgS1X2IFBWjNPYNjOk8qNlaFr2ujdCBvfPINTmw2aWGNFAqjVnKmFmL2bpDLQr2v6tSZGCXcFXsOEwxmiKE3NOqiQtYrWfBtpMk1znhNdUoLWZhLA0SGo0POT4ovDJI1P+MsR/z8OhmjcbhDyPu1XxudOCMeY8NlRHbBicIXPo8LIOqG0h4J5Gks3jQik5mozOaEY+iiFoDivzX38IF+7ztpte0BpPupLMjaACxzuBUynkFOD5Us35S5qEE52GQRqryhTFd5odZgbdLYlPk6ei9WtUgqmbpqeHGOwuYWPRXf4MrmgLREfrmy7OC9qE3L/4ao7CKUuNJBW61zY2lDJJai+uAzLorOxVT1aRJbHHwXWnsVRU02RFxE6+NgaQ4kXZtHoWWVLs2jNXZrZCmOFp2aRwrks9Ck3kDs/U/svMKisSk22LpiM25ttLYGqFoiuxahpmgZjnKcTo0sdG0Bs34eHGIiA3vp0hQIegqdKeMmetwC7FkKfdp3gad4FoneTi76L5lr/PwnwACuTCE7VESqMQAAAABJRU5ErkJggg==" />
                                                            </defs>
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="modifyCourier"
                                                        modifyCourierId="{{ $courierDetail->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button type="button" class="deleteCourier"
                                                        deleteCourierId="{{ $courierDetail->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Change Password Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="PAYMENT">
                        <!-- Change Password Form -->
                        <form method="POST"
                            action="{{ route('patient.payment.store', $patient->id) }}"
                            class="row row-gap-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="billing_date" id="billing_date"
                                        name="TotalAmt" placeholder="Billing Date" value="{{now()->format('Y-m-d')}}" max="{{now()->format('Y-m-d')}}">
                                    <label for="billing_date">Billing Date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="previous_amount"
                                        id="previous_amount" placeholder="Pending Amount"
                                        value="{{ $patient->PaymentDetail->count() > 0 ? $patient->PaymentDetail->last()->balance_amount : null }}"
                                        readonly>
                                    <label for="previous_amount">Previous Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="current_amount"
                                        id="current_amount" placeholder="Current Amount" oninput="calculateTotal()">
                                    <label for="current_amount">Current Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="total_amount"
                                        id="total_amount" readonly>
                                    <label for="total_amount">Total Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="received_amount"
                                        id="received_amount" placeholder="Received Amount"
                                        oninput="calculateBalance()">
                                    <label for="received_amount">Received Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="any" class="form-control" name="balance_amount"
                                        id="balance_amount" readonly>
                                    <label for="balance_amount">Balance Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="payment_method" id="payment_method"
                                        aria-label="Default select example">
                                        <option selected="">Payment Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="UPI">UPI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="reference_number"
                                        id="reference_number" placeholder="Reference Amount">
                                    <label for="reference_number">Reference Number</label>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- ......data-table...... -->
                        <div class="table-responsive previous_medicine">
                            <h4 class="pb-2">Previous Payment Details</h4>
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="th-bg">ID</th>
                                        <th scope="col" class="th-bg">DATE</th>
                                        <th scope="col" class="th-bg">Current&nbsp;Amount</th>
                                        <th scope="col" class="th-bg">Total&nbsp;Amount</th>
                                        <th scope="col" class="th-bg">Amount&nbsp;Paid</th>
                                        <th scope="col" class="th-bg">Balance&nbsp;Amount</th>
                                        <th scope="col" class="th-bg">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->PaymentDetail->sortByDesc('id') as $paymentDetail)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ Carbon\Carbon::parse($paymentDetail->billing_date)->format('d-M-Y') }}
                                            </td>
                                            <td>{{ $paymentDetail->current_amount }}</td>
                                            <td>{{ $paymentDetail->total_amount }}</td>
                                            <td>{{ $paymentDetail->received_amount }}</td>
                                            <td>{{ $paymentDetail->balance_amount }}</td>
                                            <td class="p-0">
                                                <div class="actionss">
                                                    <button type="button" class="modifyPayment"
                                                        modifyPaymentId="{{ $paymentDetail->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button type="button" class="deletePayment"
                                                        deletePaymentId="{{ $paymentDetail->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Change Password Form -->

                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </section>
    @include('admin.layouts.footer')
</main><!-- End #main -->

<!-- ...........Courier_Modals.......... -->
<div class="modal fade delete_modal" id="deleteCourierModal" tabindex="-1">
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
                <form method="POST"
                    action="{{ route('patient.courier.destroy', $patient->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteCourierId" name="deleteId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade delete_modal" id="modifyStatusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to change the Status?
            </div>
            <div class="modal-footer">
                <form method="POST"
                    action="{{ route('patient.courier.updateStatus', $patient->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="statusId" name="statusId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modifyCourierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('patient.courier.update', $patient->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="modifyCourierId" name="modifyId">
                    <div class="row row-gap-3 justify-content-center">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" name="modified_company" id="modified_company"
                                    aria-label="Default select example" oninput="calculateModifiedPrice()">
                                    <option value="">Select Company</option>
                                    @foreach($courierMaster as $courier)
                                        <option value="{{ $courier->id }}">{{ $courier->company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control" name="modified_weight"
                                    id="modified_weight" placeholder="Weight" oninput="calculateModifiedPrice()">
                                <label for="modified_weight">Weight</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control" id="modified_price"
                                    name="modified_price" placeholder="Price" oninput="calculateModifiedPrice()" readonly>
                                <label for="modified_price">Price</label>
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

<!-- ...........Rx_Modals.......... -->
<div class="modal fade delete_modal" id="deletePrescriptionModal" tabindex="-1">
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
                <form method="POST"
                    action="{{ route('patient.prescription.destroy', $patient->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deletePrescriptionId" name="deleteId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade delete_modal" id="viewPrescriptionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p id="view_prescription"></p>
                <h6 class="mb-0">Next Visit:<span class="fs-6 ps-2" id="view_next_visit"></span></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modifyPrescriptionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('patient.prescription.update', $patient->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="modifyPrescriptionId" name="modifyId">
                    <div class="row row-gap-3">
                        <div class="col-12">
                            <textarea class="form-control" name="modified_prescription" id="modified_prescription"
                                rows="5"></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="modified_next_visit"
                                    id="modified_next_visit" placeholder="Next Visit Date">
                                <label for="modified_next_visit">Next Visit</label>
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
<div class="modal fade" id="repeatPrescriptionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Repeat Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('patient.prescription.repeat', $patient->id) }}">
                    @csrf
                    <input type="hidden" id="repeatPrescriptionId" name="repeatId">
                    <div class="row row-gap-3">
                        <div class="col-12">
                            <textarea class="form-control" name="repeat_prescription" id="repeat_prescription"
                                rows="5"></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="repeat_next_visit"
                                    id="repeat_next_visit" placeholder="Next Visit Date">
                                <label for="repeat_next_visit">Next Visit</label>
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


<!-- ...........Payement_Modals.......... -->
<div class="modal fade delete_modal" id="deletePaymentModal" tabindex="-1">
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
                <form method="POST"
                    action="{{ route('patient.payment.destroy', $patient->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deletePaymentId" name="deleteId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modifyPaymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('patient.payment.update', $patient->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="modifyPaymentId" name="modifyId">
                    <div class="row row-gap-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="modified_billing_date"
                                    id="modified_billing_date" placeholder="Billing Date">
                                <label for="modified_billing_date">Billing Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_previous_amount"
                                    id="modified_previous_amount" placeholder="Pending Amount" readonly>
                                <label for="modified_previous_amount">Pending Amount</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_current_amount"
                                    id="modified_current_amount" placeholder="Current Amount"
                                    oninput="calculateModifiedTotal()">
                                <label for="modified_current_amount">Current Amount</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_total_amount"
                                    id="modified_total_amount" placeholder="Total Amount" readonly>
                                <label for="modified_total_amount">Total Amount</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_received_amount"
                                    id="modified_received_amount" placeholder="Received Amount"
                                    oninput="calculateModifiedBalance()">
                                <label for="modified_received_amount">Received Amount</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_balance_amount"
                                    id="modified_balance_amount" placeholder="Balance Amount" readonly>
                                <label for="modified_balance_amount">Balance Amount</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="modified_payment_method" id="modified_payment_method"
                                    aria-label="Default select example">
                                    <option selected="">Payment Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="UPI">UPI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="modified_reference_number"
                                    id="modified_reference_number" placeholder="Reference Amount">
                                <label for="modified_reference_number">Reference Number</label>
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
    // JavaScript code to handle scroll position
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve scroll position from sessionStorage
        var scrollPosition = sessionStorage.getItem('scrollPosition');

        // Scroll to the stored position
        if (scrollPosition !== null) {
            window.scrollTo(0, scrollPosition);
            sessionStorage.removeItem('scrollPosition'); // Clear the stored position
        }

        // Add an event listener to store the scroll position on page unload
        window.addEventListener('beforeunload', function () {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    });
</script>

<script>
    function handleVisit() {
        var days = $('#next_visit').val();
        if (days) {
            $('#handleVisit').html('After ' + days + ' Days');
        } else {
            $('#handleVisit').html('After _ Days');
        }
    }
    function calculatePrice() {
        var companyId = $('#company').val();
        var weight = $('#weight').val();
        weight = Math.ceil(weight);
        $.ajax({
            url: "{{ route('patient.courier.getPrice', '') }}/" + companyId,
            type: "GET",
            success: function (response) {
                if (response['status'] == true) {
                    var rate = response.data.price;
                    var price = weight * rate;
                    $('#price').val(price);
                }
            }
        });
    }
    function calculateModifiedPrice() {
        var companyId = $('#modified_company').val();
        var weight = $('#modified_weight').val();
        weight = Math.ceil(weight);
        $.ajax({
            url: "{{ route('patient.courier.getPrice', '') }}/" + companyId,
            type: "GET",
            success: function (response) {
                if (response['status'] == true) {
                    var rate = response.data.price;
                    var price = weight * rate;
                    $('#modified_price').val(price);
                }
            }
        });
    }
</script>

<!-- Custom Javascript To Handle Rx/Medicine Modals -->
<script>
    viewPrescription = document.getElementsByClassName('viewPrescription');
    Array.from(viewPrescription).forEach((element) => {
        element.addEventListener('click', (event) => {
            var viewId = element.getAttribute("viewId");
            $('#viewId').val(viewId)
            $.ajax({
                url: "{{ route('patient.prescription.edit', '') }}/" +
                    viewId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {

                        var created_at = response.data.created_at;
                        var next_visit = response.data.next_visit;

                        var createdAtDate = new Date(created_at);
                        var nextVisitDate = new Date(createdAtDate);
                        nextVisitDate.setDate(createdAtDate.getDate() + next_visit);
                        var formattedDate = moment(nextVisitDate).format('DD-MMM-YYYY');

                        $('#view_prescription').html(response.data.prescription);
                        $('#view_next_visit').html(formattedDate);
                    }
                }
            });
            $('#viewPrescriptionModal').modal('show');
        });
    });
    modifyPrescription = document.getElementsByClassName('modifyPrescription');
    Array.from(modifyPrescription).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyPrescriptionId = element.getAttribute("modifyPrescriptionId");
            $('#modifyPrescriptionId').val(modifyPrescriptionId)
            $.ajax({
                url: "{{ route('patient.prescription.edit', '') }}/" +
                    modifyPrescriptionId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modified_prescription').val(response.data.prescription);
                        $('#modified_next_visit').val(response.data.next_visit);
                    }
                }
            });
            $('#modifyPrescriptionModal').modal('show');
        });
    });
    repeatPrescription = document.getElementsByClassName('repeatPrescription');
    Array.from(repeatPrescription).forEach((element) => {
        element.addEventListener('click', (event) => {
            var repeatPrescriptionId = element.getAttribute("repeatPrescriptionId");
            $('#repeatPrescriptionId').val(repeatPrescriptionId)
            $.ajax({
                url: "{{ route('patient.prescription.edit', '') }}/" +
                    repeatPrescriptionId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#repeat_prescription').val(response.data.prescription);
                        $('#repeat_next_visit').val(response.data.next_visit);
                    }
                }
            });
            $('#repeatPrescriptionModal').modal('show');
        });
    });
    deletePrescription = document.getElementsByClassName('deletePrescription');
    Array.from(deletePrescription).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deletePrescriptionId = element.getAttribute("deletePrescriptionId");
            $('#deletePrescriptionId').val(deletePrescriptionId);
            $('#deletePrescriptionModal').modal('show');
        });
    });

</script>

<!-- Custom Javascript To Handle Courier Modals -->
<script>
    modifyStatus = document.getElementsByClassName('modifyStatus');
    Array.from(modifyStatus).forEach((element) => {
        element.addEventListener('click', (event) => {
            var statusId = element.getAttribute("statusId");
            $('#statusId').val(statusId)
            $('#modifyStatusModal').modal('show');
        });
    });
    modifyCourier = document.getElementsByClassName('modifyCourier');
    Array.from(modifyCourier).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyCourierId = element.getAttribute("modifyCourierId");
            $('#modifyCourierId').val(modifyCourierId)
            $.ajax({
                url: "{{ route('patient.courier.edit', '') }}/" +
                    modifyCourierId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modified_company').val(response.data.courier_company);
                        $('#modified_weight').val(response.data.weight);
                        $('#modified_price').val(response.data.price);
                    }
                }
            });
            $('#modifyCourierModal').modal('show');
        });
    });
    deleteCourier = document.getElementsByClassName('deleteCourier');
    Array.from(deleteCourier).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deleteCourierId = element.getAttribute("deleteCourierId");
            $('#deleteCourierId').val(deleteCourierId);
            $('#deleteCourierModal').modal('show');
        });
    });

</script>

<!-- Custom Javascript To Handle Payment Form -->
<script>
    function calculateTotal() {
        var previousAmount = $('#previous_amount').val() || 0;
        var currentAmount = $('#current_amount').val() || 0;
        previousAmount = parseFloat(previousAmount);
        currentAmount = parseFloat(currentAmount);
        var totalAmount = previousAmount + currentAmount;
        $('#total_amount').val(totalAmount);
    }

    function calculateBalance() {
        var totalAmount = $('#total_amount').val();
        var receivedAmount = $('#received_amount').val();
        totalAmount = parseFloat(totalAmount);
        receivedAmount = parseFloat(receivedAmount);
        var balanceAmount = totalAmount - receivedAmount;
        $('#balance_amount').val(balanceAmount);
    }

    function calculateModifiedTotal() {
        var modifiedPreviousAmount = $('#modified_previous_amount').val() || 0;
        var modifiedCurrentAmount = $('#modified_current_amount').val() || 0;
        modifiedPreviousAmount = parseFloat(modifiedPreviousAmount);
        modifiedCurrentAmount = parseFloat(modifiedCurrentAmount);
        var modifiedTotalAmount = modifiedPreviousAmount + modifiedCurrentAmount;
        $('#modified_total_amount').val(modifiedTotalAmount);
    }

    function calculateModifiedBalance() {
        var modifiedTotalAmount = $('#modified_total_amount').val();
        var modifiedReceivedAmount = $('#modified_received_amount').val();
        modifiedTotalAmount = parseFloat(modifiedTotalAmount);
        modifiedReceivedAmount = parseFloat(modifiedReceivedAmount);
        var modifiedBalanceAmount = modifiedTotalAmount - modifiedReceivedAmount;
        $('#modified_balance_amount').val(modifiedBalanceAmount);
    }

    modifyPayment = document.getElementsByClassName('modifyPayment');
    Array.from(modifyPayment).forEach((element) => {
        element.addEventListener('click', (event) => {
            var modifyPaymentId = element.getAttribute("modifyPaymentId");
            $('#modifyPaymentId').val(modifyPaymentId);
            $.ajax({
                url: "{{ route('patient.payment.edit', '') }}/" +
                    modifyPaymentId,
                type: "GET",
                data: "",
                dataType: "",
                success: function (response) {
                    if (response['status'] == true) {
                        $('#modified_billing_date').val(response.data.billing_date);
                        $('#modified_previous_amount').val(response.data.previous_amount);
                        $('#modified_current_amount').val(response.data.current_amount);
                        $('#modified_total_amount').val(response.data.total_amount);
                        $('#modified_received_amount').val(response.data.received_amount);
                        $('#modified_balance_amount').val(response.data.balance_amount);
                        $('#modified_payment_method').val(response.data.payment_method);
                        $('#modified_reference_number').val(response.data.reference_number);
                    }
                }
            });
            $('#modifyPaymentModal').modal('show');
        });
    });
    deletePayment = document.getElementsByClassName('deletePayment');
    Array.from(deletePayment).forEach((element) => {
        element.addEventListener('click', (event) => {
            var deletePaymentId = element.getAttribute("deletePaymentId");
            $('#deletePaymentId').val(deletePaymentId);
            $('#deletePaymentModal').modal('show');
        });
    });

</script>
@endsection
