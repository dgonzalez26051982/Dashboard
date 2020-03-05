<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Tráfico</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ count($calls) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ $calls->whereBetween('creation_date', [$today, $date])->count() }}</span>
                                <span class="text-nowrap">Interacciones de hoy</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Usuarios</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ count($calls->pluck('session')->countBy()) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ $calls->whereBetween('creation_date', [$today, $date])->unique('session')->count() }}</span>
                                <span class="text-nowrap">Conversaciones de hoy</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Usuarios Activos</h5>
                                    <?php $min = 5; $subdate->subMinute($min) ?>
                                    <span class="h2 font-weight-bold mb-0">{{ $calls->whereBetween('creation_date', [$subdate, $date])->unique('session')->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <?php $min = 30; $subdate->subMinute($min) ?>
                                <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> {{ $calls->whereBetween('creation_date', [$subdate, $date])->unique('session')->count() }}</span>
                                <span class="text-nowrap">Conversaciones en los {{$min}} min</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                    <?php
                                        $y = $date->year;
                                        $m = $date->month;
                                        if(strlen($m)==1){
                                            $FIM = "$y-0$m-00 00:00:00";
                                        };
                                        if(strlen($m)==2){
                                            $FIM = "$y-$m-00 00:00:00";
                                        };
                                    ?>                                    

                                    <span class="h2 font-weight-bold mb-0">{{ ($calls->whereBetween('creation_date', [$FIM, $date])->count())*0.01 }}%</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ ($calls->whereBetween('creation_date', [$today, $date])->count())*0.01 }}%</span>
                                <span class="text-nowrap">Performance del día</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>