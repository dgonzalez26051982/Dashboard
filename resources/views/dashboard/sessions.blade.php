@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">History</div>

                <div class="card-body">
                    <?php $no=1; ?>
                    @foreach($sessions as $session)                    
                        <button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#item<?= $no ?>">Conversación #{{ $no }}</button>
                        <div id="item<?= $no ?>" class="collapse">

                            <?php $intents = $calls->where('session',$session) ?>
                            <table class="col-12">
                            <thead class="table-primary">
                                <tr>
                                    <th class="p-1">Usuario</th>
                                    <th class="p-1 text-center">Bot</th>
                                </tr>                       
                            </thead>
                        
                            <tbody class="list">
                                @foreach($intents as $r)
                                <tr>
                                    <td class="float-left mr-3">{{ $r->queryResult['queryText'] }}</td>
                                    <td class="text-justify">{{ $r->queryResult['fulfillmentText'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div><br>                    
                    <?php $no++; ?>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
