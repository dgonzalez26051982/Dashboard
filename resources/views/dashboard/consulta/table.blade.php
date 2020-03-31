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
                    <?php $no=1;
                    $conversation = $calls->groupBy('session');
                    $conversation->toArray();
                    ?>
                    @foreach($conversation as $c)                    
                    <?php 
                    $contrato = null;
                    $fi = $c->first();
                    $ff = $c->last();
                    $arrayContrato = array();
                    $arrayCanal = array();                        
                    ?>
                        @foreach($c as $i)
                        <?php $feedback = $i->pluck('customerData.account'); ?>
                        @if($i->customerData['account']=="emty")
                        @else
                        <?php $contrato = array_push($arrayContrato, $i['customerData']['account']); ?>
                        @endif
                        @if($i['originalDetectIntentRequest']['source']['payload']==[])
                        <?php array_push($arrayCanal, "web"); ?>                            
                        @else
                        <?php array_push($arrayCanal, $i['originalDetectIntentRequest']['source']['source']); ?>
                        @endif
                        @endforeach
                        <tr>
                            <td class="text-wrap">{{ $no }}</td>
                            @if($contrato==null)
                            <td class="text-wrap"></td>
                            @else
                            <td class="text-wrap">{{ implode(", ", $arrayContrato) ?? '' }}</td>
                            @endif
                            <td class="text-wrap">{{ $fi['creation_date'] ?? '' }}</td>
                            <td class="text-wrap">{{ $ff['creation_date'] ?? '' }}</td>
                            <td class="text-wrap">{{ $c->implode('queryResult.action', ', ') ?? '' }}</td>                            
                            <td class="text-wrap">Ninguna</td>
                            <td class="text-wrap">100%</td>
                            <td class="text-wrap">{{ implode(", ", array_unique($arrayCanal)) ?? '' }}</td>
                        </tr>
                    <?php $no++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>