<?php

namespace App\Http\Controllers\HistorialCuenta;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use App\Models\HistorialCuenta;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $historialCuenta = HistorialCuenta::all();

        $data = [
            'historialCuenta'  => $historialCuenta,
        ];

        return view("historial_cuenta.index", compact('data'));
    }

    public function edit($id)
    {
        $historilCuenta = HistorialCuenta::find($id);
        $usuarios =  User::all();

        $data = [
            'historilCuenta'  => $historilCuenta,
        ];

        return view('historial_cuenta.edit', compact('data'));
    }

    public function create()
    {
        return view('historial_cuenta.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'cuentaID'     => 'required',
                'monto'     => 'required',
                'fecha'     => 'required',
            ],
            [
                'cuentaID.required'      => 'Cuenta es requerida',
                'monto.required'      => 'Monto es requerido',
                'fecha.required'      => 'Tipo  es requerido',
            ]
        );

        $data = HistorialCuenta::find($id);
        $data->update($request->all());

        return redirect('historial_cuenta/')->with('success', 'Datos guardados!');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'cuentaID'     => 'required',
                'monto'     => 'required',
                'fecha'     => 'required',
            ],
            [
                'cuentaID.required'      => 'Cuenta es requerida',
                'monto.required'      => 'Monto es requerido',
                'fecha.required'      => 'Tipo  es requerido',
            ]
        );
        
        $input = $request->all();

        $data = HistorialCuenta::create($input);

        return redirect('historial_cuenta/')->with('success', 'Datos guardados!');
    }


    public function delete($id)
    {
        try {
            $datos = HistorialCuenta::find($id);
            $datos->delete();
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                $errors = array();
                array_push($errors, 'No se puede borrar el registro. Esta siendo usado en la base de datos');
                return redirect()->route('historial_cuenta.index')
                    ->with('errors', $errors);
            }
        }

        return redirect()->route('historial_cuenta.index')
            ->with('success', 'Registro borrado exitosamente');
    }

    public function api_getAll()
    {
        $historialCuenta = HistorialCuenta::all();

        return response($historialCuenta, 200);
    }

    public function api_getAllBycuentaID(Request $request, $id)
    {
        $data = [];
        if (HistorialCuenta::where('cuentaID', $id)->exists()) {
            $data = HistorialCuenta::where('cuentaID', $id)->get()->toJson(JSON_PRETTY_PRINT);
        }
        return response($data, 200);
    }

    public function api_getById(Request $request, $id)
    {
        $data = new HistorialCuenta();
        if (HistorialCuenta::where('id', $id)->exists()) {
            $data = HistorialCuenta::where('id', $id)->get()->first()->toJson(JSON_PRETTY_PRINT);
        }
        return response($data, 200);
    }

    public function api_add(Request $request)
    {
        $input = $request->all();
        $data = HistorialCuenta::create($input);

        return response($data, 200);
    }
}
