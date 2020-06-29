@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <label>Roles</label>
                        </div>                        
                        <form method="POST" class="form-inline" action="{{ route('create') }}">
                        @csrf
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Nuevo</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Vistas</th>
                            </tr>
                        </thead>
                        @foreach($roles as $role)
                        <tbody>
                            <tr>
                                <td>{{ $role->role }}</td>
                                <?php $views = $role->where('role',$role->role)->pluck('views'); ?>
                                <td>
                                @foreach($views as $view)
                                    @foreach($view as $route=>$view)
                                        <li class="nav-item">
                                            {{ $view }}
                                        </li>
                                    @endforeach
                                @endforeach
                                </td>
                            </tr>
                        </tbody>                        
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
