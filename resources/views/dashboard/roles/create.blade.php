@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Role</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin') }}">
                    @csrf                    
                        <div class="form-group">
                            <label class="mr-1" for="Nombre">Nombre:</label>
                            <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                        </div>
                        <label>Vistas:</label>
                        <div class="ml-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Dashboard" id="Dashboard" name="Dashboard">
                                <label class="form-check-label" for="Dashboard">Dashboard</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TecAdvisors" id="TecAdvisors" name="TecAdvisors">
                                <label class="form-check-label" for="TecAdvisors">TecAdvisors</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Log" id="Log" name="Log">
                                <label class="form-check-label" for="Log">Log</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Historial" id="Historial" name="Historial">
                                <label class="form-check-label" for="Historial">Historial</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Consulta" id="Consulta" name="Consulta">
                                <label class="form-check-label" for="Consulta">Consulta</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Administración" id="Administración" name="Administración">
                                <label class="form-check-label" for="Administración">Administración</label>
                            </div>
                        </div>
                        <div class="row mt-4 justify-content-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection