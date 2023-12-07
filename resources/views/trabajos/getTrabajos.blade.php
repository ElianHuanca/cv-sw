@extends('layouts.user_type.auth')
@section('content')
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Lista de Trabajos</h5>
                </div>
                {{-- Puedes ajustar la URL según tus necesidades --}}
                <a href="{{ route('trabajos.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;
                    Nuevo Trabajo</a>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Empresa
                            </th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Lugar
                            </th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Cargo
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Responsabilidades
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Requisitos
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Salario
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Vacancia
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Estado
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Fecha Finalizacion
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                            <tr>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $trabajo->empresa->razon }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $trabajo->sucursal->direccion }} -
                                        {{ $trabajo->sucursal->ciudad }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $trabajo->cargo }}</p>
                                </td>
                                <td class="text-center">
                                    @php
                                        $responsabilidades = $trabajo->responsabilidades;
                                        // Reemplazar llaves por corchetes

                                        $responsabilidades = str_replace('{', '[', $responsabilidades);
                                        $responsabilidades = str_replace('}', ']', $responsabilidades);
                                        // Decodificar la cadena JSON
                                        $responsabilidades = json_decode($responsabilidades);

                                    @endphp
                                    {{-- <ul>
                                                @foreach ($responsabilidades as $responsabilidad)
                                                    <li class="text-xs font-weight-bold mb-0">{{ $responsabilidad }}</li>
                                                @endforeach
                                            </ul> --}}

                                    <p class="text-xs font-weight-bold mb-0">{{ $responsabilidades[0] }}</p>
                                </td>

                                <td class="text-center">
                                    @php
                                        $requisitos = $trabajo->requisitos;
                                        // Reemplazar llaves por corchetes

                                        $requisitos = str_replace('{', '[', $requisitos);
                                        $requisitos = str_replace('}', ']', $requisitos);
                                        // Decodificar la cadena JSON
                                        $requisitos = json_decode($requisitos);

                                    @endphp
                                    {{-- <ul>
                                                @foreach ($responsabilidades as $responsabilidad)
                                                    <li class="text-xs font-weight-bold mb-0">{{ $responsabilidad }}</li>
                                                @endforeach
                                            </ul> --}}

                                    <p class="text-xs font-weight-bold mb-0">{{ $requisitos[0] }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $trabajo->salario }}Bs</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $trabajo->vacancia }}</p>
                                </td>
                                <td class="text-center">
                                    @if ($trabajo->estado)
                                        <p class="text-xs font-weight-bold mb-0" style="color:green">Disponible</p>
                                    @else
                                        <p class="text-xs font-weight-bold mb-0" style="color:red">Finalizado</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $trabajo->fechafin }}</p>
                                </td>
                                <td class="text-center d-flex justify-content-center">

                                    <a href="{{ route('postulaciones.show', $trabajo->id) }}" class="mx-3"
                                        data-bs-toggle="tooltip" data-bs-original-title="Postulaciones">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    @if ($trabajo->estado)
                                        <form action="{{ route('eliminarEmpresa', $trabajo->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este este trabajo?')">
                                            @csrf
                                            @method('DELETE')
                                            <i class="cursor-pointer fas fa-trash text-secondary" data-bs-toggle="tooltip"
                                                data-bs-original-title="Finalizar Trabajo"
                                                onclick="this.closest('form').submit(); return false;"></i>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $trabajos->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>


@endsection
