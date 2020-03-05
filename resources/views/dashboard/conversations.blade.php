@extends('layouts.app')

@section('content')
        <div class="col-xs-12">
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
                                    </tr>                       
                                </thead>
                            
                                <tbody class="list">
                                <?php $no=1; ?>
                                    @foreach($calls as $item)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td class="text-wrap">{{ $item->queryResult['queryText'] }}</td>
                                        <td class="text-wrap text-justify">{{ $item->queryResult['fulfillmentText'] }}</td>
                                        <td class="text-wrap">{{ $item->queryResult['action'] }}</td>
                                        <td class="text-wrap">{{ $item->session }}</td>
                                        <td class="text-wrap">{{ $item->creation_date }}</td>
                                    </tr>
                                    <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>
@endsection
