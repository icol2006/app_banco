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
                <h3 class="card-title">Consultar cuentas cliente</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                    <form method="get" class="form-inline col-12" action="{{ route('cuenta.index') }}">

                        <div class="form-group col-7">
                            <label style="margin-right: 20px;">Nombre Cliente</label>
                            <select class="form-control select2 col-9" name="usuarioID">
                                @foreach($data['usuarios'] as $dato )
                                @if ($dato->hasRole(App\Models\RolesNames::$cliente))
                                <option value="{{ $dato->id }}" {{ $data['usuarioSelecionado']==$dato->id?'selected':'' }}>
                                    {{ $dato->getFullName() }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info boton-guardar-registro " style="margin-left: 10px;">Consultar cuentas</button>
                    </form>
                    <br>

                    <a href="{{ route('cuenta.create')}}" class="btn btn-primary boton-agregar-registro">Agregar
                        Registro <i class="fa fa-plus"></i></a>

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cliente </th>
                                <th>Monto </th>
                                <th>Tipo </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['listado_cuentas'] as $item)
                            <tr>
                                <td>
                                    {{ $item->getFullNameUsuario()  }}
                                </td>
                                <td>
                                    {{ $item->monto }}
                                </td>
                                <td>
                                    {{ $item->tipo }}
                                </td>
                                <td>

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