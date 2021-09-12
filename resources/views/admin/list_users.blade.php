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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>Listado Usuarios</h3>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row col-12">
                    <a href="{{ route('admin.create_user')}}" class="btn btn-primary boton-agregar-registro">Agregar
                        Registro <i class="fa fa-plus"></i></a>
                </div>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre </th>
                            <th>Rol </th>
                            <th>Email </th>
                            <th>Telefono</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['users'] as $item)
                        <tr>
                            <td>
                                {{ $item->getFullName() }}
                            </td>
                            <td>
                                {{ $item->getRol() }}
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                @if ($item->deleted_at === null)
                                <a href="{{  route('admin.disable_user',$item->id)}}"> Desactivar</a>
                                @endif

                                @if ($item->deleted_at !== null)
                                <a href="{{  route('admin.enable_user',$item->id)}}">Activar </a>
                                @endif
                            </td>
                            <td>
                            <div style="width: 50px;">
                                <a href="{{ route('admin.edit_user',$item->id)}}"> <i class="fa fa-edit fa-lg icono-editar"></i></a>
                                <a style="margin-left: 10px;" href="{{ route('admin.delete_user',$item->id)}}"> <i class="fa fa-trash fa-lg icono-eliminar"></i></a>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>


@endsection