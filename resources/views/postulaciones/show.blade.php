@extends('layouts.user_type.auth')

@section('content')
    <div class="container my-4">
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
                            <h5 class="mb-0">Lista de Postulaciones</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Trabajo
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Postulante
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        CV
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        estado
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        motivo
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulaciones as $postulacion)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $postulacion->trabajo->cargo }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $postulacion->usuario->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ $postulacion->usuario->url }}" download target="_blank">
                                                <p class="text-xs font-weight-bold mb-0"> Ver CV</p>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if (!$postulacion->motivo)
                                                <p class="text-xs font-weight-bold mb-0" style="color:orange">Sin Analizar
                                                </p>
                                            @elseif($postulacion->estado == true)
                                                <p class="text-xs font-weight-bold mb-0" style="color:green">Aprobado</p>
                                            @else
                                                <p class="text-xs font-weight-bold mb-0" style="color:red">Rechazado</p>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($postulacion->motivo)
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $postulacion->motivo }}</p>
                                            @else
                                                <p class="text-xs font-weight-bold mb-0" style="color:orange">Todavia No
                                                    Analizamos Su Postulacion</p>
                                            @endif
                                        </td>
                                        @if ($postulacion->estado == true)
                                            <td class="text-center">
                                                <a href="{{ route('entrevistas.create', $postulacion->id) }}"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Realizar Entrevista">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                            </td>
                                        @endif
                                        @if (!$postulacion->motivo)
                                            <td class="text-center">
                                                <a href="{{ route('postulaciones.edit', $postulacion->id) }}"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Analizar CV Con La IA">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $postulaciones->links() }}
            </div>
        </div>
    </div>
@endsection
