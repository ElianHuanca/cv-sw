@extends('layouts.user_type.auth')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Registrar Nuevo Personal</h5>

                    </div>
                </div>
            </div>               
            <div class="card-body px-4 pt-2 pb-2">
                <form role="form text-left" method="POST" enctype="multipart/form-data" action="/registrarPersonalDirecto">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="">
                        @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <input type="number" class="form-control" placeholder="phone" name="phone" id="phone" aria-label="Email" aria-describedby="email-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="location" name="location" id="location" aria-label="Email" aria-describedby="email-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="about_me" name="about_me" id="about_me" aria-label="Email" aria-describedby="email-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="url" name="url" id="url" aria-label="Email" aria-describedby="email-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection