@extends('admin.layouts.app')

@section('content')

<main class="login_page patient-register">
    <div class="container-fluid">

        <section class="section register d-flex flex-column align-items-center justify-content-center pb-0">
            <div class="container-fluid px-0 h-100">
                <div class="row h-100">
                    <div class="col-lg-7 d-sm-block d-none px-0">
                        <div class="banner_image">
                            <div class="doctor-logo">
                                <img src="{{ asset('admin/assets/img/logo.png')}}" alt="">
                            </div>
                            <div class="banner-text">
                                <h1>Your Health <br>is Our Priority.</h1>
                                <p>
                                Homeopathy is a highly developed health practice that uses a systematic approach to the totality of a person’s health. Anyone seeking a fuller understanding of health and healing will find homeopathy extremely important and applicable.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 px-0 d-flex flex-column align-items-center justify-content-center position-relative">

                        <div class="card">

                            <div class="card-body form_main">
                                <div class="form_inner">
                                    <div class="doctor-logo text-center pb-5 d-sm-none d-block">
                                        <img src="{{asset('admin/assets/img/logo2.png')}}" alt="">
                                    </div>
                                    <div>
                                        <div class="pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4 text-primary">Login to Your
                                                Account</h5>
                                            <p class="text-center small">Enter your username & password to login</p>
                                        </div>
                                        <form method="POST" action="{{route('admin.login')}}" class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            <div class="col-12">
                                                <label for="email" class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                                    <input type="email" name="email" class="form-control rounded-5 @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" autofocus autocomplete="username">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control rounded-5 @error('password') is-invalid @enderror" id="password" autocomplete="current-password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        value="true" id="remember_me">
                                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary rounded-5 w-100"
                                                    type="submit">Login</button>
                                            </div>
                                            <div class="col-12 text-center">
                                                <p class="small mb-0">New Patient<a class="text-primary" href="{{route('registerPatient.create')}}"> Registeration</a></p>
                                            </div>
                                        </form>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="credits-login">
                            <span class="credits-inner">Design &amp; Developed by <a href="">Beta Byte Technologies</a></span><br>
                            <span class="credits-inner-2">Copyright © 2023 | Gupta Clinic - All Rights Reserved</span>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

@endsection

@section('customJS')

@endsection
