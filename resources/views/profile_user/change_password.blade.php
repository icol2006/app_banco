@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row  text-danger">
            <div class="row col-12">
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

        @if(session()->has('success'))
        <div id="success-alert" class="alert alert-success alerta">
            {{ session()->get('success') }}
        </div>
        @endif

    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">Cambiar Password</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form method="post" action="{{ route('profile_user.update_password') }}">
            @method('POST')
            @csrf

            <div class="row">

                <div class="row col-12">

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" value="" name="password" id="password" required>
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password_confirmation">Password Confirmacion</label>
                        <input type="password" class="form-control" value="" name="password_confirmation" id="password_confirmation" required>
                    </div>

                </div>


                <button type="submit" class="btn bg-primary float-right boton-guardar-registro">Aceptar</button>


            </div>
        </form>
    </div>
</div>

@endsection


@section('scripts')

<script>
    window.onload = function() {
        var duration = 1000; //2 seconds
        setTimeout(function() {
            $('#alerta-exito').hide();
        }, duration);
    };
</script>

@endsection