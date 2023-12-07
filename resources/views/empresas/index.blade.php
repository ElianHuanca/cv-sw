@extends('layouts.user_type.auth')
@section('content')
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información De la Empresa</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST" role="form text-left">
                        @csrf
                        @method('PUT')
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
                                    <label for="user-razon" class="form-control-label">{{ __('Razon Social') }}</label>
                                    <div class="@error('user.razon')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $empresa->razon }}" type="text"
                                            placeholder="Razon Social" id="user-razon" name="razon">
                                        @error('razon')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo-empresa"
                                        class="form-control-label">{{ __('Tamaño De La Empresa') }}</label>
                                    <div class="@error('tipo') border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="tipo-empresa" name="tipo">
                                            <option value="Pequena" {{ $empresa->tipo == 'Pequena' ? 'selected' : '' }}>
                                                Pequeña</option>
                                            <option value="Mediana" {{ $empresa->tipo == 'Mediana' ? 'selected' : '' }}>
                                                Mediana</option>
                                            <option value="Grande" {{ $empresa->tipo == 'Grande' ? 'selected' : '' }}>Grande
                                            </option>
                                        </select>
                                        @error('tipo')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Guardar Cambios' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Personal RRHH</h5>
                        </div>
                        {{-- Puedes ajustar la URL según tus necesidades --}}
                        <a href="{{ route('personal.create') }}" class="btn bg-gray-900 text-white btn-sm mb-0"
                            type="button">+&nbsp; Agregar Personal RRHH </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nombre
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Celular
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Rol
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @isset($user->celular)
                                                    {{ $user->celular }}
                                                @endisset
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->rol }}</p>
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            {{-- <a href="{{ route('personal.edit', $user->id) }}" class="btn bg-gradient-info btn-sm mb-0"
                                            type="button">Editar</a> --}}
                                            <form action="{{ route('personal.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn bg-gradient-danger btn-sm mb-0"
                                                    type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Sucursales</h5>
                        </div>
                        <a href="{{ route('sucursales.create') }}" class="btn bg-gray-900 text-white btn-sm mb-0"
                            type="button">+&nbsp; Agregar Sucursal </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Direccion
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ciudad
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Latitud
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Longitud
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sucursales as $sucursal)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sucursal->direccion }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $sucursal->ciudad }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $sucursal->latitud }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $sucursal->longitud }}
                                            </p>
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            {{-- <a href="{{ route('personal.edit', $user->id) }}" class="btn bg-gradient-info btn-sm mb-0"
                                            type="button">Editar</a> --}}
                                            <form action="{{ route('sucursales.destroy', $sucursal->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn bg-gradient-danger btn-sm mb-0"
                                                    type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="map" class="col-md-12 mx-auto rounded" style="height: 400px; width: 100%;"
            data-sucursales="{{ json_encode($sucursales) }}"></div>

    </div>    
    <script>
        function initMap() {
            // Obtener la información de sucursales desde el atributo data-sucursales
            var sucursalesData = JSON.parse(document.getElementById('map').getAttribute('data-sucursales'));

            // Crear un nuevo mapa en el contenedor con ID 'map'
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -16.9545025,
                    lng: -65.5671333
                },
                zoom: 8
            });
            //var markers = [];

            // Iterar sobre las sucursales y agregar marcadores
            sucursalesData.forEach(function(sucursal) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(sucursal.longitud),
                        lng: parseFloat(sucursal.latitud)
                    },
                    map: map,
                    title: sucursal
                        .direccion // Puedes personalizar el título del marcador según tus necesidades
                });

                var infowindow = new google.maps.InfoWindow({
                    content: sucursal.direccion
                });
                infowindow.open(map, marker);

                marker.addListener('click', function() {
                    // Mostrar la información del marcador (título) en una ventana de información
                    var infowindow = new google.maps.InfoWindow({
                        content: sucursal.direccion
                    });
                    infowindow.open(map, marker);

                    
                });

                
            });
        }
    </script>

    <!-- Llama a la función initMap después de cargar la API de Google Maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7OuuczmOUALvosZeUooXv421gnVX1zzI&callback=initMap"></script>    
@endsection
