@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="x_panel">
        <div class="x_title">
            <h3>Editar Usuario</h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <form method="post" action="{{ route('admin.update_user', $data['user']->id) }}">
                @method('PATCH')
                @csrf

                <div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label>Nombre</label>
                            <input type="text" class="form-control" value="{{ $data['user']->name }}" name="name" id="name" required>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" value="{{ $data['user']->lastname }}" name="lastname" id="lastname" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label>Email address</label>
                            <input type="email" class="form-control" value="{{ $data['user']->email }}" name="email" id="email">
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label>Telefono</label>
                            <input type="text" class="form-control" value="{{ $data['user']->phone }}" name="phone" id="phone">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <button type="submit" class="btn btn-primary boton-guardar-registro">Guardar</button>

                </div>


            </form>
        </div>
    </div>
</div>




@endsection