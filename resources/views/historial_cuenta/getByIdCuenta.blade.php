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
                <h3 class="card-title">Historial cuenta</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Monto </th>
                                <th>Fecha </th>
                                <th>Transaccion </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['listado_historial_cuenta'] as $item)
                            <tr>          
                                <td>
                                    {{ $item->monto }}
                                </td>
                                <td>
                                    {{ $item->fecha }}
                                </td>
                                <td>
                                    {{ strtoupper($item->transaccion)  }}
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