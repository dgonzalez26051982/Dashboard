@extends('layouts.app') 

@section('content')
<div class="col-xs-12">
    <form method="POST" action="{{ route('consulta1') }}" class="container">
        @csrf
        <div class="form-group row">
            <div class="input-group input-group-sm mb-3 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Axion:</span>
                </div>
                <input type="text" class="form-control col-5" name="axion" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Canal:</span>
                </div>
                <input type="text" class="form-control col-5" name="canal" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Palabra:</span>
                </div>
                <input type="text" class="form-control col-5" name="palabra" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                
                <div class="input-group-append">
                    <button class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
    </form>
    
    <div class="table-responsive" style="height:825px">
        <div>
            <table class="table align-items-center">
                <thead class="bg-primary text-secondary">
                    <tr>
                        <th>#</th>
                        <th>QueryText</th>
                        <th>FulfillmentText</th>
                        <th>Action</th>
                        <th>Session</th>
                        <th>Created_At</th>
                        <th>Canal</th>
                    </tr>
                </thead>

                <tbody class="list">
                    <?php $no=1; ?>
                    @foreach($calls as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td class="text-wrap">{{ $item->queryResult['queryText']}}</td>
                        <td class="text-wrap text-justify">{{ $item->queryResult['fulfillmentText'] }}</td>
                        <td class="text-wrap">{{ $item->queryResult['action'] }}</td>
                        <td class="text-wrap">{{ $item->session }}</td>
                        <td class="text-wrap">{{ $item->creation_date }}</td>

                        @if ( $item['originalDetectIntentRequest']['source']['payload'] == [] )
                        <td class="text-wrap"> web</td>
                        @else
                        <td class="text-wrap"> {{$item['originalDetectIntentRequest']['source']['source']}} </td>
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