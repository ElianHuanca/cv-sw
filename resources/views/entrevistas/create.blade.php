@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Crear Entrevista Trabajo</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <form action="{{ route('entrevistas.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha" class="form-control-label">Fecha</label>
                                    <input type="date" class="form-control" id="cargo" name="fecha"
                                        value="{{ old('fecha') }}" required min="{{ now()->toDateString() }}">
                                    @error('fecha')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hora" class="form-control-label">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora"
                                        value="{{ old('hora') }}" required>
                                    @error('hora')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha" class="form-control-label">Fecha</label>
                                    <input type="text" name='idpostulacion' value="{{$postulacion->id}}" hidden>
                                    @error('fecha')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>                  
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Guardar Entrevista</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
