@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row  text-danger">
            <div class="row col-12">
                @if (count($errors) > 0)
                <div class="error mensaje-error-validacion">
                    <ul>
                        @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        @if(session()->has('success'))
        <div id="success-alert" class="alert alert-success alerta">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de cuentas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <a href="{{ route('cuenta.realizar_transaccion')}}" class="btn btn-primary boton-agregar-registro">Realizar transaccion
                    <i class="fa fa-plus"></i></a>

                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Num Cuenta </th>
                            <th>Monto </th>
                            <th>Tipo </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['listado_cuentas'] as $item)
                        <tr>
                            <td>
                                {{ $item->id  }}
                            </td>
                            <td>
                                {{ $item->monto }}
                            </td>
                            <td>
                                {{ strtoupper($item->tipo) }}
                            </td>
                            <td>
                            <a href="{{ route('historial_cuenta.getByIdCuenta',$item->id)}}" class="btn btn-info">Ver Historial</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection