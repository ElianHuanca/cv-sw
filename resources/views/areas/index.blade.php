@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Lista de Areas De Trabajo</h5>
                        </div>   
                        <a href="{{ route('areas.create') }}" class="btn bg-gradient-danger text-white btn-sm mb-0"
                            type="button">+&nbsp; Agregar Area De Trabajo </a>                                             
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>                                    
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Area De Trabajo
                                    </th>                                    
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="listaarea">
                                @foreach ($areas as $area)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $area->id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $area->nombre }}</p>
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            {{-- <a href="{{ route('areas.edit', $area->id) }}" class="mx-3"
                                                data-bs-toggle="tooltip" data-bs-original-title="Editar Area De Trabajo">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a> --}}
                                            <form action="{{ route('areas.destroy', $area->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este esta Area De Trabajo?')">
                                                @csrf
                                                @method('DELETE')
                                                <i class="cursor-pointer fas fa-trash text-secondary" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Finalizar Area De Trabajo"
                                                    onclick="this.closest('form').submit(); return false;"></i>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $areas->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
