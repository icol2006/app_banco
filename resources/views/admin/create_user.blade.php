@extends('layouts.dashboard')

@section('content')

<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">Crear Usuario</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">

            <div class="row  text-danger">
                <div class="row col-12 col-xs-12">
                    @if (count($errors) > 0)
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- /.row -->



        <form method="post" action="{{ route('admin.store_user') }}">
            @method('POST')
            @csrf
            <div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label>Nombre</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" required>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" value="{{ old('lastname') }}" name="lastname" id="lastname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label>Email address</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email">
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label>Telefono</label>
                        <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="phone">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" value="" name="password" id="password" required>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label for="password_confirmation">Password Confirmacion</label>
                        <input type="password" class="form-control" value="" name="password_confirmation" id="password_confirmation" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12 col-xs-12">
                        <label>Rol</label>
                        <br>
                        @foreach($data['roles'] as $item)
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="{{ $item->name }}" name="role" {{ 2 == $item->name ? "checked" : "" }} required>
                                {{ strtoupper($item->name)  }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="ln_solid"></div>
                <button type="submit" class="btn btn-primary boton-guardar-registro">Guardar</button>

            </div>

        </form>

    </div>
</div>
<!-- /.card-body -->
</div>


@endsection