<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Call;
use Carbon\Carbon;

class CallHistoryController extends Controller
{
    public function index(){
        $calls = Call::all()->sortByDesc('creation_date');
        return view('dashboard.conversations', compact('calls'));
    }

    public function search(){
        return view('dashboard.history');
    }

    public function show(){
        $account = request('account');
        $sessions = Call::where('customerData.account',$account)->orderBy('creation_date','desc')->pluck('session')->unique();
        $calls = collect();
        foreach($sessions as $session) {
            $conversation = Call::where('session',$session)->get();
            $calls = $calls->concat($conversation);
        }
        return view('dashboard.sessions', compact('sessions', 'calls'));
    }

    public function panel(){
        $calls = Call::all();
        $today = Carbon::today('America/Mexico_City');
        $date = Carbon::now('America/Mexico_City');
        $subdate = Carbon::now('America/Mexico_City');
        $yesterday = new Carbon('yesterday');
        $dates = Call::pluck('creation_date');
        $actions = Call::pluck('queryResult.action');
        $e1 = Call::where('queryResult.action',"UsuarioPideConsultarSaldo.UsuarioPideConsultarSaldo-custom")->pluck('session');
        $e2 = Call::where('queryResult.action',"plan")->pluck('session');
        $e3 = Call::where('queryResult.action',"paquete")->pluck('session');
        $e4 = Call::where('queryResult.action',"UsuarioPideFactura.UsuarioPideFactura-custom")->pluck('session');
        $e5 = Call::where('queryResult.action',"promocion")->pluck('session');
        $et = collect([$e1,$e2,$e3,$e4,$e5])->collapse()->unique()->count();
        $facebook = Call::where('originalDetectIntentRequest.source.source',"facebook")->pluck('session')->unique()->count();
        $whatsapp = Call::where('originalDetectIntentRequest.source.source',"twilio")->pluck('session')->unique()->count();
        $telegram = Call::where('originalDetectIntentRequest.source.source',"telegram")->pluck('session')->unique()->count();
        $web = count($calls->pluck('session')->unique())-$facebook-$whatsapp-$telegram;
        return view('dashboard.panel', compact('calls', 'today', 'date', 'subdate', 'yesterday', 'dates', 'actions', 'et', 'facebook', 'whatsapp', 'telegram', 'web'));
    }

    public function dates(){
        $calls = Call::all();
        $today = Carbon::today('America/Mexico_City');
        $date = Carbon::now('America/Mexico_City');
        $subdate = Carbon::now('America/Mexico_City');
        $yesterday = new Carbon('yesterday');

        $dates = Call::pluck('creation_date');
        $actions = Call::pluck('queryResult.action');
        $e1 = Call::where('queryResult.action',"UsuarioPideConsultarSaldo.UsuarioPideConsultarSaldo-custom")->pluck('session');
        $e2 = Call::where('queryResult.action',"plan")->pluck('session');
        $e3 = Call::where('queryResult.action',"paquete")->pluck('session');
        $e4 = Call::where('queryResult.action',"UsuarioPideFactura.UsuarioPideFactura-custom")->pluck('session');
        $e5 = Call::where('queryResult.action',"promocion")->pluck('session');
        $et = collect([$e1,$e2,$e3,$e4,$e5])->collapse()->unique()->count();
        $facebook = Call::where('originalDetectIntentRequest.source.source',"facebook")->pluck('session')->unique()->count();
        $whatsapp = Call::where('originalDetectIntentRequest.source.source',"twilio")->pluck('session')->unique()->count();
        $telegram = Call::where('originalDetectIntentRequest.source.source',"telegram")->pluck('session')->unique()->count();
        $web = count($calls->pluck('session')->unique())-$facebook-$whatsapp-$telegram;        
        $to = request('to');
        $from = request('from');
        if($to!=null && $from!=null) {
            $to = "$to 00:00:00";
            $from = "$from 23:59:59";
            $dates = Call::whereBetween('creation_date', [$to, $from])->pluck('creation_date');
        };
        return view('dashboard.panel', compact('calls', 'today', 'date', 'subdate', 'yesterday', 'dates', 'actions', 'et', 'facebook', 'whatsapp', 'telegram', 'web'));
    }

    public function consulta(){
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
                    $calls = $calls->where('queryResult.action',"UsuarioConsultaSaldo");
                break;
                case "Plan":
                    $calls = $calls->where('queryResult.action',"plan");                
                break;
                case "Paquete":
                    $calls = $calls->where('queryResult.action',"paquete");
                break;
                case "Factura":
                    $calls = $calls->where('queryResult.action',"Factura");
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

        return view('dashboard.consulta', compact('calls'));
    }


    // Sahid
    public function consulta1(){
        $calls = Call::all()->sortByDesc('creation_date') ;
        return view('dashboard.consulta1', compact('calls'));
    }

    public function filter(){
        $axion = request('axion');
        $canal = request('canal');
        $palabra = request('palabra');
        if($axion != '') {
            $calls = Call::all()->where('queryResult.action',$axion)->sortByDesc('creation_date');
        }
        elseif($canal != '') {
            $calls = Call::all()->where('originalDetectIntentRequest.source.source',$canal)->sortByDesc('creation_date');
        }
        elseif($palabra != '') {
            $calls = Call::all()->where('queryResult.queryText',$palabra)->sortByDesc('creation_date');
        }
        else {
            $calls = Call::all()->sortByDesc('creation_date') ;
        }
        return view('dashboard.consulta1', compact('calls'));
    }
}
