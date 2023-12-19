@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Dar Resultado De Entrevista</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <form action="{{ route('entrevistas.update',$entrevista->id) }}" method="POST">                        
                        @csrf   
                        @method('PUT')                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha" class="form-control-label">Fecha</label>
                                    <input type="date" class="form-control" id="cargo" name="fecha"
                                        value="{{ $entrevista->fecha }}" readonly>
                                    @error('fecha')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hora" class="form-control-label">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora"
                                        value="{{ $entrevista->hora }}" readonly>
                                    @error('hora')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postulante" class="form-control-label">Postulante</label>
                                    <input type="text" class="form-control" name='postulante'
                                        value="{{ $entrevista->postulacion->usuario->name }}" readonly>
                                    @error('postulante')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado" class="form-control-label">Contratado:</label>
                                    <input type="checkbox" class="form-control-checkbox" name="estado" value="1">
                                    <span class="ml-2">Contratado</span>
                                    @error('estado')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="resultado" class="form-control-label">Conclusion:</label>
                                    <input type="text" class="form-control" name='resultado'
                                        value="{{ old('resultado') }}" required>
                                    @error('resultado')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn bg-gradient-danger">Guardar Entrevista</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
