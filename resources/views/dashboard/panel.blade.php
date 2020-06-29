@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="col-xl-12 py-4">
        <form class="form-inline justify-content-center" method="POST" action="{{ route('panel') }}">
            @csrf        
            <div class="form-group">
                <label for="to" class="mr-1 font-weight-light">De:</label>
                <input type="date" class="form-control mr-5" id="to" name="to">
            </div>
            <div class="form-group">
                <label for="from" class="mr-1 font-weight-light">A:</label>
                <input type="date" class="form-control mr-5" id="from" name="from">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Performance</h6>
                                <h2 class="text-white mb-0">Tráfico de la semana</h2>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-body">
                        @include('dashboard.charts.dates')
                    </div>
                </div>
            </div>            
        </div>
        <div class="row pt-3">
            <div class="col-xl-7">
            @include('dashboard.charts.actions')
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Vista general</h6>
                                <h2 class="mb-0">Acciones</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        @yield('column')
                    </div>
                </div>
            </div>
            <div class="col-xl-5">            
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Vista general</h6>
                                <h2 class="mb-0">Acciones</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @yield('piechart3D')
                    </div>
                </div>
            </div>
        </div>  
        <div class="row pt-3">
            <div class="col-xl-7">
            @include('dashboard.charts.platform')
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Vista general</h6>
                                <h2 class="mb-0">Plataformas</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        @yield('platform')
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Vista general</h6>
                                <h2 class="mb-0">Efectividad</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @yield('efectividad')
                    </div>
                </div>
            </div>        
        </div>
    </div>

    <ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">
  
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tabs_2_2" role="tab" aria-controls="profile" aria-selected="false">
      <span class="nav-link-icon d-block"><i class="fa fa-comments" aria-hidden="true"></i></span>
    </a>
  </li>
</ul>        
@endsection