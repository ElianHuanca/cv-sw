@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Trabajos</h5>
                        </div>
                        @if (Auth::user()->rol != 'Postulante')
                            <a href="{{ route('trabajos.create') }}" class="btn bg-gradient-danger btn-sm mb-0"
                                type="button">+&nbsp;
                                Crear Nuevo Trabajo</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Area De Trabajo
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Lugar
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Cargo
                                    </th>
                                    @if (Auth::user()->rol != 'Postulante')
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Estado
                                        </th>
                                    @endif
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Responsabilidades
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Requisitos
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Salario
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Vacancia
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha Finalizacion
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="listaTrabajo">
                                @foreach ($trabajos as $trabajo)
                                    <tr class="trabajo" data-area="{{ $trabajo->idarea }}">
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $trabajo->area->nombre }}</p>
                                        </td>
                                        <td class="trabajo-direccion text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $trabajo->sucursal->direccion }} -
                                                {{ $trabajo->sucursal->ciudad }}</p>
                                        </td>
                                        <td class="trabajo-cargo text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $trabajo->cargo }}</p>
                                        </td>
                                        @if (Auth::user()->rol != 'Postulante')
                                            <td class="text-center">
                                                @if ($trabajo->estado)
                                                    <p class="text-xs font-weight-bold mb-0" style="color:green">Disponible
                                                    </p>
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0" style="color:red">Finalizado
                                                    </p>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="trabajo-responsabilidades text-center">
                                            @php
                                                $responsabilidades = $trabajo->responsabilidades;
                                                // Reemplazar llaves por corchetes

                                                $responsabilidades = str_replace('{', '[', $responsabilidades);
                                                $responsabilidades = str_replace('}', ']', $responsabilidades);
                                                // Decodificar la cadena JSON
                                                $responsabilidades = json_decode($responsabilidades);

                                            @endphp

                                            <p class="text-xs font-weight-bold mb-0">{{ $responsabilidades[0] }}</p>
                                        </td>

                                        <td class="trabajo-requisitos text-center">
                                            @php
                                                $requisitos = $trabajo->requisitos;
                                                // Reemplazar llaves por corchetes

                                                $requisitos = str_replace('{', '[', $requisitos);
                                                $requisitos = str_replace('}', ']', $requisitos);
                                                // Decodificar la cadena JSON
                                                $requisitos = json_decode($requisitos);

                                            @endphp

                                            <p class="text-xs font-weight-bold mb-0">{{ $requisitos[0] }}</p>
                                        </td>
                                        <td class="trabajo-salario text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $trabajo->salario }}Bs</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $trabajo->vacancia }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $trabajo->fechafin }}</p>
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            @if(Auth::user()->rol == 'Postulante')
                                            <a href="{{ route('trabajos.show', $trabajo->id) }}" class="mx-3"
                                                data-bs-toggle="tooltip" data-bs-original-title="Ver Detalle">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            @endif
                                            @if ($trabajo->estado && Auth::user()->rol != 'Postulante')
                                                <a href="{{ route('postulaciones.show', $trabajo->id) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Postulaciones">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <form action="{{ route('eliminarEmpresa', $trabajo->id) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este este trabajo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <i class="cursor-pointer fas fa-trash text-secondary"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Finalizar Trabajo"
                                                        onclick="this.closest('form').submit(); return false;"></i>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $trabajos->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

    <script src="..\js\area.js"></script>
@endsection
