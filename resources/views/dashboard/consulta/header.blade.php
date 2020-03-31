@extends('layouts.app')

@section('content')
    <div class="row pb-1">
        <div class="col">
            <form method="POST" class="form-inline" action="{{ route('consulta') }}">
                @csrf
                <div class="form-group ml-3 mb-3">
                    <label class="mr-1" for="account">#Contrato:</label>
                    <input type="text" class="form-control" id="account" name="account">
                </div>
                <div class="form-group ml-3 mb-3">
                    <label class="mr-1" for="canal">Canal:</label>
                    <select class="form-control" id="canal" name="canal">
                        <option></option>
                        <option>Web</option>
                        <option>Facebook</option>
                        <option>Whatsapp</option>
                        <option>Telegram</option>
                    </select>
                </div>
                <div class="form-group ml-3 mb-3">
                    <label class="mr-1" for="action">Tema:</label>
                    <select class="form-control" id="action" name="action">
                        <option></option>
                        <option>Saldo</option>
                        <option>Plan</option>
                        <option>Paquete</option>
                        <option>Factura</option>
                        <option>Promoción</option>
                    </select>
                </div>
                <div class="form-group ml-3 mb-3">
                    <label class="mr-1" for="to">De:</label>
                    <input type="date" class="form-control" id="to" name="to">
                </div>
                <div class="form-group ml-3 mb-3">
                    <label class="mr-1" for="from">A:</label>
                    <input type="date" class="form-control" id="from" name="from">
                </div>
                <button type="submit" name="excel" value="excel" class="btn btn-primary ml-3 mb-3" style="border-color:#217346; background-color:#217346;">
                <i class="fas fa-file-excel mr-2"></i>Excel</button>
                <button type="submit" name="pdf" value="pdf" class="btn btn-primary ml-3 mb-3" style="border-color:#ff0000; background-color:#ff0000;">
                <i class="fas fa-file-pdf mr-2"></i>PDF</button>
                <button type="submit" class="btn btn-primary ml-3 mb-3"><i class="fas fa-search mr-2"></i>Buscar</button>                
            </form>
        </div>
    </div>
    @include('dashboard.consulta.table')
@endsection