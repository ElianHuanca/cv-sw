@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Entrevistas</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Entrevistador
                                    </th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Postulante
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Fecha
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Hora
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        estado
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        motivo
                                    </th>
                                    @if (Auth::user()->rol == 'Personal')
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Acciones
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entrevistas as $entrevista)
                                    <tr>
                                        {{-- <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $entrevista->admin->name}}</p>
                                        </td> --}}
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $entrevista->postulacion->usuario->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $entrevista->fecha }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $entrevista->hora }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if (!$entrevista->resultado)
                                                <p class="text-xs font-weight-bold mb-0" style="color:orange">Sin
                                                    Entrevistar
                                                </p>
                                            @elseif($entrevista->estado == true)
                                                <p class="text-xs font-weight-bold mb-0" style="color:green">Contratado</p>
                                            @else
                                                <p class="text-xs font-weight-bold mb-0" style="color:red">Rechazado</p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($entrevista->resultado)
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $entrevista->resultado }}</p>
                                            @else
                                                <p class="text-xs font-weight-bold mb-0" style="color:orange">Todavia No Se
                                                    Realizo La Entrevista</p>
                                            @endif
                                        </td>
                                        @if (!$entrevista->resultado && Auth::user()->rol == 'Personal')
                                            <td class="text-center d-flex justify-content-center">
                                                <a href="{{ route('entrevistas.edit', ['id' => $entrevista->id]) }}"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Dar Un Resultado">
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
                {{ $entrevistas->links() }}
            </div>
        </div>
    </div>
@endsection
