@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Historial de Llamadas del Usuario</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('history') }}">
                        @csrf
                        <div class="form-group">
                            <label>Número de Contrato:</label>
                            <input type="text" class="form-control" name="account" placeholder="Ingresa el número de contrato del usuario..." required>
                        </div>
                        <button class="btn btn-info btn-block">Buscar</button>
                    </form>                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection