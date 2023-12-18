@extends('layouts.user_type.auth')

@section('content')

    <div>
        {{-- <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ __('Alec Thompson') }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ __(' CEO / Co-Founder') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                    role="tab" aria-controls="overview" aria-selected="true">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2319.000000, -291.000000)"
                                                fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity"
                                                    transform="translate(1716.000000, 291.000000)">
                                                    <g id="box-3d-50" transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z" id="Path"></path>
                                                        <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" id="Path" opacity="0.7"></path>
                                                        <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" id="Path" opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="ms-1">{{ __('Overview') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-controls="teams" aria-selected="false">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>document</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="document" transform="translate(154.000000, 300.000000)">
                                                        <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                                                        <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="ms-1">{{ __('Teams') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-controls="dashboard" aria-selected="false">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>settings</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="settings" transform="translate(304.000000, 151.000000)">
                                                        <polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                        </polygon>
                                                        <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path>
                                                        <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="ms-1">{{ __('Projects') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información Del Perfil

                    </h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="/user-profile" method="POST" role="form text-left">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Nombre Completo') }}</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ auth()->user()->name }}" type="text"
                                            placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ auth()->user()->email }}" type="email"
                                            placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.celular" class="form-control-label">{{ __('Celular') }}</label>
                                    <div class="@error('user.celular')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="tel" placeholder="40770888444" id="number"
                                            name="celular" value="{{ auth()->user()->celular }}">
                                        @error('celular')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.location" class="form-control-label">Rol</label>
                                    <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="{{ auth()->user()->rol }}"
                                            id="name" name="location" value="{{ auth()->user()->rol }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->rol == 'Postulante')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user.cv" class="form-control-label">{{ __('CV:') }}</label>
                                        <div class="@error('user.cv')border border-danger rounded-3 @enderror">
                                            @if (auth()->user()->url)
                                                <a href="{{ auth()->user()->url }}" download target="_blank">
                                                    <img width="80px" height="100px" src="data:image/jpeg;base64,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" alt="CV Icon">
                                                </a>
                                            @else
                                                <p>No hay CV disponible</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-danger btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
