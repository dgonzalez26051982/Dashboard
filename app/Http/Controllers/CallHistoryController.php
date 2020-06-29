<?php

namespace App\Http\Controllers;

use App\Exports\CallsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Call;
use Carbon\Carbon;
use App\Role;

class CallHistoryController extends Controller
{
    public function index(){
        $calls = Call::all()->sortByDesc('creation_date');
        $roles = Role::all();
        return view('dashboard.conversations', compact('calls', 'roles'));
    }

    public function search(){
        $roles = Role::all();
        return view('dashboard.history', compact('roles'));
    }

    public function show(){
        $account = request('account');
        $sessions = Call::where('customerData.account',$account)->orderBy('creation_date','desc')->pluck('session')->unique();
        $calls = collect();
        foreach($sessions as $session) {
            $conversation = Call::where('session',$session)->get();
            $calls = $calls->concat($conversation);
        }
        $roles = Role::all();
        return view('dashboard.sessions', compact('sessions', 'calls', 'roles'));
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
        $roles = Role::all();
        return view('dashboard.panel', compact('calls', 'today', 'date', 'subdate', 'yesterday', 'dates', 'actions', 'et', 'facebook', 'whatsapp', 'telegram', 'web', 'roles'));
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
        $roles = Role::all();
        return view('dashboard.panel', compact('calls', 'today', 'date', 'subdate', 'yesterday', 'dates', 'actions', 'et', 'facebook', 'whatsapp', 'telegram', 'web', 'roles'));
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
        $export = request('excel');
        if($export!=null) {
            return Excel::download(new CallsExport, 'reporte.xlsx');
        };
        $export = request('pdf');
        if($export!=null) {
            $pdf = PDF::loadView('dashboard.consulta.table', compact('calls'));
            $pdf->setPaper('a4','landscape');
            return $pdf->download('reporte.pdf');
        };
        $roles = Role::all();        
        return view('dashboard.consulta.header', compact('calls', 'roles'));
    }

    public function tecAdvisors(){
        $roles = Role::all();
        return view('dashboard.tecAdvisors', compact('roles'));
    }

    public function views(){
        $roles = Role::all();
        return view('layouts.app', compact('roles'));
    }
    
    public function register(){
        $roles = Role::pluck('role');
        return view('auth.register', compact('roles'));
    }

    public function admin(){
        $roles = Role::all();
        $r = Role::pluck('role');
        return view('dashboard.roles.admin', compact('roles', 'r'));
    }

    public function create(){
        $roles = Role::all();
        return view('dashboard.roles.create', compact('roles'));
    }

    public function role(){        
        if(request('Nombre')!=null) {
            $Nombre = request('Nombre');
            $exist = Role::where('role',$Nombre)->exists();
            if($exist!=false) {
                $roles = Role::all();
                return view('dashboard.roles.create', compact('roles','exist'));
            }
            else {
                $role=new Role;
                $role->role=$Nombre;
                $collection = collect([]);

                if(request('Dashboard')!=null) {
                    $Dashboard = request('Dashboard');         
                    $collection = $collection->put('panel', $Dashboard);
                }
                if(request('TecAdvisors')!=null) {
                    $TecAdvisors = request('TecAdvisors');
                    $collection = $collection->put('tecAdvisors', $TecAdvisors);
                }
                if(request('Log')!=null) {
                    $Log = request('Log');
                    $collection = $collection->put('conversations', $Log);
                }
                if(request('Historial')!=null) {
                    $Historial = request('Historial');
                    $collection = $collection->put('history', $Historial);
                }
                if(request('Consulta')!=null) {
                    $Consulta = request('Consulta');
                    $collection = $collection->put('consulta', $Consulta);
                }
                if(request('Administración')!=null) {
                    $Administración = request('Administración');
                    $collection = $collection->put('admin', $Administración);
                }
                $role->views=$collection->toArray();
                $role->save();
            }
        }
        $roles = Role::all();
        return view('dashboard.roles.admin', compact('roles'));
    }
}
