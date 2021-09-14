@extends('layouts.dashboard')

@section('content')

<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">Realizar transaccion</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">

        <div class="row  text-danger col-12">
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


        </div>
        <!-- /.row -->



        <form method="post" action="{{ route('cuenta.realizar_transaccion_update') }}">
            @method('PATCH')
            @csrf
            <div>
            <div class="row">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <label>Seleccione la opcion</label>
                        <select class="form-control select2" style="width: 100%;" name="opcion" id="">
                            <option value="deposito">
                               Depositar
                            </option>
                            <option value="retiro">
                               Retirar
                            </option>                            
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <label>Monto</label>
                        <input type="number" class="form-control" value="{{ old('monto') }}" name="monto" id="monto" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <label>Seleccione la cuenta</label>
                        <select class="form-control select2" style="width: 100%;" name="id" id="">
                            @foreach($data['listado_cuentas'] as $dato )
                            <option value="{{ $dato->id }}">
                                NUM CUENTA {{ $dato->id }} - {{ strtoupper($dato->tipo) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>

                <div class="ln_solid"></div>
                <button type="submit" class="btn btn-primary boton-guardar-registro">Aceptar</button>

            </div>

        </form>

    </div>
</div>
<!-- /.card-body -->
</div>


@endsection