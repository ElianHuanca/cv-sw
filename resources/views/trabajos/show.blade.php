@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Cargo: </strong>{{ $trabajo->cargo }}</div>
                    <div class="card-body">
                        <p><strong>Responsabilidades:</strong>
                            @php
                                $responsabilidades = $trabajo->responsabilidades;
                                // Reemplazar llaves por corchetes

                                $responsabilidades = str_replace('{', '[', $responsabilidades);
                                $responsabilidades = str_replace('}', ']', $responsabilidades);
                                // Decodificar la cadena JSON
                                $responsabilidades = json_decode($responsabilidades);

                            @endphp
                        <ul>
                            @foreach ($responsabilidades as $responsabilidad)
                                <li class="text-md font-weight-bold mb-0">{{ $responsabilidad }}</li>
                            @endforeach
                        </ul>
                        </p>
                        <p><strong>Requisitos:</strong>@php
                            $requisitos = $trabajo->requisitos;
                            // Reemplazar llaves por corchetes

                            $requisitos = str_replace('{', '[', $requisitos);
                            $requisitos = str_replace('}', ']', $requisitos);
                            // Decodificar la cadena JSON
                            $requisitos = json_decode($requisitos);

                        @endphp
                        <ul>
                            @foreach ($requisitos as $requisito)
                                <li class="text-md font-weight-bold mb-0">{{ $requisito }}</li>
                            @endforeach
                        </ul>
                        </p>
                        <p><strong>Salario:</strong> {{ $trabajo->salario }}</p>
                        <p><strong>Vacancia:</strong> {{ $trabajo->vacancia }}</p>
                        <p><strong>Fecha de inicio:</strong> {{ $trabajo->fecha }}</p>
                        <p><strong>Fecha de fin:</strong> {{ $trabajo->fechafin }}</p>
                        <p><strong>Area De Trabajo:</strong> {{ $trabajo->area->nombre }}</p>
                        {{-- <p><strong>Empresa:</strong> {{ $trabajo->empresa->razon }}</p> --}}
                        <p><strong>Reclutador:</strong> {{ $trabajo->user->name }}</p>
                        <p><strong>Sucursal:</strong> {{ $trabajo->sucursal->direccion }}</p>
                        <p><strong>Ciudad:</strong> {{ $trabajo->sucursal->ciudad }}</p>

                        {{-- Agregar el botón de "Postular" --}}
                        @if (Auth::user()->rol == 'Postulante')                        
                        <form action="{{ route('postulaciones.store', ['idtrabajo' => $trabajo->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn bg-gray-900 text-white">Postular</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
