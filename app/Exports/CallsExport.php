<?php

namespace App\Exports;

use App\Call;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class CallsExport implements FromView
{   
    public function view(): View
    {
        $fi = collect();
        $ff = collect();
        $intents = collect();
        $calls = collect();
        $account = request('account');
        if($account==null) {
            $calls = Call::all()->sortByDesc('creation_date');            
        };
        if($account!=null) {            
            $sessions = Call::where('customerData.account',$account)->orderBy('creation_date','desc')->pluck('session')->unique();
            foreach($sessions as $session) {
                $conversation = Call::where('session',$session)->get();
                $calls = $calls->concat($conversation);
                $fi = $conversation->first();
                $ff = $conversation->last();
                $conversation = $conversation->pluck('queryResult.action');
                $calls = Call::where('customerData.account',$account)->get();
            };
        };
        $canal = request('canal');
        if($canal!=null) {
            switch($canal) {
                case "Web":
                    $calls = $calls->whereNotIn('originalDetectIntentRequest.source.source',["facebook","twilio","telegram"]);
                break;
                case "Facebook":
                    $calls = $calls->where('originalDetectIntentRequest.source.source',"facebook");                
                break;
                case "Whatsapp":
                    $calls = $calls->where('originalDetectIntentRequest.source.source',"twilio");
                break;
                case "Telegram":
                    $calls = $calls->where('originalDetectIntentRequest.source.source',"telegram");
                break;
            };
        };
        $action = request('action');
        if($action!=null) {
            switch($action) {
                case "Saldo":
                    $calls = $calls->where('queryResult.action',"saldo");
                break;
                case "Plan":
                    $calls = $calls->where('queryResult.action',"plan");                
                break;
                case "Paquete":
                    $calls = $calls->where('queryResult.action',"paquete");
                break;
                case "Factura":
                    $calls = $calls->where('queryResult.action',"factura");
                break;
                case "Promoción":
                    $calls = $calls->where('queryResult.action',"promocion");
                break;
            };
        };
        $to = request('to');
        $from = request('from');
        if($to!=null && $from!=null) {
            $to = "$to 00:00:00";
            $from = "$from 23:59:59";
            $calls = $calls->whereBetween('creation_date', [$to, $from]);
        };
        return view('dashboard.consulta.table', compact('calls'));
    }    
}
