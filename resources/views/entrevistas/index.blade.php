@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Mis Postulaciones</h5>
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
                                        estado
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        motivo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulaciones as $postulacion)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $postulacion->trabajo->cargo }} -
                                                {{ $postulacion->trabajo->empresa->razon }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $postulacion->usuario->name }}</p>
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
