@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Crear Nuevo Trabajo</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <form action="{{ route('trabajos.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cargo" class="form-control-label">Cargo</label>
                                    <input type="text" class="form-control" id="cargo" name="cargo"
                                        value="{{ old('cargo') }}" required >
                                    @error('cargo')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salario" class="form-control-label">salario(Bs)</label>
                                    <input type="text" class="form-control" id="salario" name="salario"
                                        value="{{ old('salario') }}" required>
                                    @error('salario')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fechafin" class="form-control-label">Fecha Finalizacion</label>
                                    <input type="date" class="form-control" id="fechafin" name="fechafin"
                                        value="{{ old('fechafin') }}" required min="{{ now()->toDateString() }}">
                                    @error('fechafin')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vacancia" class="form-control-label">vacancia</label>
                                    <input type="number" class="form-control" id="vacancia" name="vacancia"
                                        value="{{ old('vacancia') }}" required>
                                    @error('vacancia')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="responsabilidades">Responsabilidades:</label>
                                    <textarea class="form-control" id="responsabilidades" name="responsabilidades" required>{{ old('responsabilidades') }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="requisitos">requisitos:</label>
                                    <textarea class="form-control" id="requisitos" name="requisitos" required>{{ old('requisitos') }} </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idsucursal">Sucursal:</label>
                                    <select name="idsucursal" class="form-control" required>
                                        @foreach ($sucursales as $sucursal)
                                            <option value="{{ $sucursal->id }}">{{ $sucursal->direccion }} -
                                                {{ $sucursal->ciudad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idarea">Area:</label>
                                    <select name="idarea" class="form-control" required>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn bg-gradient-danger">Guardar Trabajo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
