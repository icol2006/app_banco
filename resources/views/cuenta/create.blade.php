@extends('layouts.dashboard')

@section('content')

<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">Crear Cuenta</h2>
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



        <form method="post" action="{{ route('cuenta.store') }}">
            @method('POST')
            @csrf
            <div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label>Monto</label>
                        <input type="number" class="form-control" value="{{ old('monto') }}" name="monto" id="monto" required>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <label>Tipo de cuenta</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="credito">Credito</option>
                            <option value="debito">Debito</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Usuario</label>
                            <select class="form-control select2" style="width: 100%;" name="usuarioID" id="">                         
                                @foreach($data['usuarios'] as $dato )
                                @if ($dato->hasRole(App\Models\RolesNames::$cliente))
                                <option value="{{ $dato->id }}">
                                    {{ $dato->getFullName() }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
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