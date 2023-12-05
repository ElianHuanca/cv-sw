@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Postulantes</h5>
                        </div>
               

                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        motivo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        id Usuario
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        estado
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($postulaciones as $postulacion)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $postulacion->motivo }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $postulacion->iduser }}</p>
                                    </td>
                                    <td class="text-center" style="background-color: {{ $postulacion->estado == 1 ? 'green' : 'red' }}; color: {{ $postulacion->estado == 1 ? 'white' : 'black' }}">
                                        <p class="text-xs font-weight-bold mb-0">{{ $postulacion->estado == 1 ? 'Aprobado' : 'Rechazado' }}</p>
                                    </td>
                                    <td class="text-center d-flex justify-content-center">
                                    <i class="fas fa-user-edit text-secondary"></i>
                                    <i class="cursor-pointer fas fa-trash text-secondary"> </i>
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
