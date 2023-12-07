@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Crear Nueva Sucursal</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <form action="{{ route('sucursales.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion" class="form-control-label">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        value="{{ old('direccion') }}" required>
                                    @error('direccion')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ciudad" class="form-control-label">Ciudad</label>
                                    <select class="form-control" id="ciudad" name="ciudad" required>
                                        <option value="Santa Cruz" {{ old('ciudad') == 'Santa Cruz' ? 'selected' : '' }}>
                                            Santa Cruz</option>
                                        <option value="La Paz" {{ old('ciudad') == 'La Paz' ? 'selected' : '' }}>La Paz
                                        </option>
                                        <option value="Cochabamba" {{ old('ciudad') == 'Cochabamba' ? 'selected' : '' }}>
                                            Cochabamba</option>
                                    </select>
                                    @error('ciudad')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitud" class="form-control-label">Latitud</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud"
                                        value="{{ old('latitud') }}" required readonly>
                                    @error('latitud')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitud" class="form-control-label">Longitud</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud"
                                        value="{{ old('longitud') }}" required readonly>
                                    @error('longitud')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn bg-gray-900 text-white">Registrar Sucursal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="map" class="col-md-12 mx-auto rounded" style="height: 400px; width: 100%;"></div>
    </div>
    <script>
        var map;
        var marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -16.9545025,
                    lng: -65.5671333
                },
                zoom: 8, // Set the initial zoom level
                clickableIcons: false // Disable clickable icons for better click handling
            });

            // Add a click event listener to capture the latitude and longitude
            map.addListener('click', function(event) {
                document.getElementById('latitud').value = event.latLng.lat();
                document.getElementById('longitud').value = event.latLng.lng();

                if (marker) {
                    marker.setMap(null);
                }

                // Add a new marker at the clicked location
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    title: 'Selected Location'
                });

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'location': event.latLng
                }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            // Display the formatted address in an element (adjust as needed)
                            document.getElementById('direccion').value = results[0].formatted_address;
                            var direccion = results[0].formatted_address;

                            if (direccion.includes("Santa Cruz")) {
                                document.getElementById('ciudad').value = "Santa Cruz";
                            } else if (direccion.includes("La Paz")) {
                                document.getElementById('ciudad').value = "La Paz";
                            } else if (direccion.includes("Cochabamba")) {
                                document.getElementById('ciudad').value = "Cochabamba";
                            }
                        } else {
                            console.log('No results found');
                        }
                    } else {
                        console.log('Geocoder failed due to: ' + status);
                    }
                });
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7OuuczmOUALvosZeUooXv421gnVX1zzI&libraries=places&callback=initMap">
    </script>
@endsection
