@extends('layouts.user_type.guest')

@section('content')
    <style>
        /* Add your custom styles here */
        .btn-outline-light {
            background-color: #fff;
            border-color: #fff;
            color: #000;
            /* Adjust text color as needed */
        }

        .btn-outline-light:hover {
            background-color: #f0f0f0;
        }

        /* Adjust radio button styles */
        input[type="radio"] {
            margin-right: 5px;
        }

        /* Adjust icon size */
        .fa-3x {
            font-size: 2rem;
        }

        .price {
            font-size: 1rem;
            margin-left: 8px;
        }
    </style>
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                            project for free.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register</h5>
                        </div>

                        <div class="row px-xl-5 px-sm-4 px-3">
                            <div class="col-3 ms-auto px-1">
                                <label class="btn btn-outline-light w-120">
                                    <input type="radio" name="tipo" value="Pequena">
                                    <i class="fas fa-store fa-3x"></i>
                                    <span class="price">$10</span>
                                </label>
                            </div>
                            <div class="col-3 px-1">
                                <label class="btn btn-outline-light w-120">
                                    <input type="radio" name="tipo" value="Mediana">
                                    <i class="fas fa-building fa-3x"></i>
                                    <span class="price">$25</span>
                                </label>
                            </div>
                            <div class="col-3 me-auto px-1">
                                <label class="btn btn-outline-light w-120">
                                    <input type="radio" name="tipo" value="Grande">
                                    <i class="fas fa-industry fa-3x"></i>
                                    <span class="price">$50</span>
                                </label>
                            </div>

                        </div>


                        <div class="card-body">
                            <form role="form text-left" method="POST" action="/register">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Razon Social" name="razon"
                                        id="razon" aria-label="Razon" aria-describedby="razon"
                                        value="{{ old('razon social') }}">
                                    @error('razon')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name" aria-label="Name" aria-describedby="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        id="email" aria-label="Email" aria-describedby="email-addon"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault"
                                        checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                                            Conditions</a>
                                    </label>
                                    @error('agreement')
                                        <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try
                                            register again.</p>
                                    @enderror
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Eres una Empresa <a href="register-empresa"
                                        class="text-dark font-weight-bolder">Ingresa</a></p>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="login"
                                        class="text-dark font-weight-bolder">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
