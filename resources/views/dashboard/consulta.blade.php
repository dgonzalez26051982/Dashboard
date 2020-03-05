@extends('layouts.app')

@section('content')
    <div class="row pl-5 pb-4">
        <div>
            <form method="POST" class="form-inline" action="{{ route('consulta') }}">
                @csrf
                <div class="form-group">
                    <label class="mr-1" for="account">#Contrato:</label>
                    <input type="text" class="form-control mr-3" id="account" name="account">
                </div>
                <div class="form-group">
                    <label class="mr-1" for="canal">Canal:</label>
                    <select class="form-control mr-3" id="canal" name="canal">
                        <option></option>
                        <option>Web</option>
                        <option>Facebook</option>
                        <option>Whatsapp</option>
                        <option>Telegram</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mr-1" for="action">Tema:</label>
                    <select class="form-control mr-3" id="action" name="action">
                        <option></option>
                        <option>Saldo</option>
                        <option>Plan</option>
                        <option>Paquete</option>
                        <option>Factura</option>
                        <option>Promoción</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mr-1" for="to">De:</label>
                    <input type="date" class="form-control mr-3" id="to" name="to">
                </div>
                <div class="form-group">
                    <label class="mr-1" for="from">A:</label>
                    <input type="date" class="form-control mr-3" id="from" name="from">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="table-responsive" style="height:825px">
            <div>
                <table class="table align-items-center">
                    <thead class="bg-primary text-secondary">
                        <tr>
                            <th>#</th>
                            <th>#Contrato</th>
                            <th>Fecha_Inicio</th>
                            <th>Fecha_Fin</th>
                            <th>Feedback</th>
                            <th>Observación</th>
                            <th>Efectividad</th>
                            <th>Canal</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $no=1; ?>
                        @foreach($calls as $item)
                        <tr>
                            <td>{{ $no }}</td>
                            @if ($item->customerData['account']=="emty")
                            <td class="text-wrap"></td>
                            @else
                            <td class="text-wrap">{{ $item->customerData['account'] }}</td>
                            @endif
                            <td class="text-wrap"></td>
                            <td class="text-wrap"></td>
                            <td class="text-wrap">{{ $item->queryResult['action'] }}</td>
                            <td class="text-wrap">Ninguna</td>
                            <td class="text-wrap">100%</td>
                            @if ($item['originalDetectIntentRequest']['source']['payload']==[])
                            <td class="text-wrap">web</td>
                            @else
                            <td class="text-wrap">{{$item['originalDetectIntentRequest']['source']['source']}}</td>
                            @endif
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection