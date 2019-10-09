<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuite;
use App\Http\Requests\UpdateSuite;
use App\Rate;
use App\Suite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SuiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getArraySuites()
    {
        return Suite::all();
    }

    /**
     * Devuelve una vista de las habitaciones del sistemas
     */
    public function suitesView()
    {
        return view('habitaciones.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('index.suites'))
        abort(404);

        $suites = DataTables::eloquent(Suite::query())
        ->addColumn('options', 'habitaciones.option-buttons')
        ->rawColumns([ 'options' ])
        ->toJson();

        return $suites;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create.suite'))
        abort(401);

        return view('habitaciones.create-suite');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSuite $request)
    {
        $data = $request->validated();

        $suite = new Suite();
        $suite->number = $data['number'];
        $suite->title = $data['title'];
        $suite->bed_type = $data['bed_type'];
        $suite->bed_number = $data['bed_number'];
        $suite->save();

        return redirect()->route('suites')->with([ 'success' => 'Habitación creada correctamente' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function show(Suite $suite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function edit(Suite $suite)
    {
        if (!auth()->user()->can('edit.suite'))
        abort(401);

        return view('habitaciones.edit-suite', compact('suite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSuite $request, Suite $suite)
    {
        $data = $request->validated();

        $suite->number = $data['number'];
        $suite->title = $data['title'];
        $suite->bed_type = $data['bed_type'];
        $suite->bed_number = $data['bed_number'];
        $suite->save();

        return redirect()->route('suites')->with([ 'success' => 'Editado correctamente' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suite $suite)
    {
        $validator = Validator::make([], []);

        $validator->after(function ($validator) {
            if (!auth()->user()->can('suites.destroy'))
            $validator->errors()->add('permission', 'No tiene permiso de eliminar esta habitación');
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'delete');
        }

        $suite->delete();
        return redirect()->route('suites')->with([ 'success' => 'Elemento borrado' ]);
    }

    public function assignRate(Request $request, Suite $suite)
    {
        if (!auth()->user()->can('edit.suite'))
        abort(401);

        $request->validate([
            'type' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $data = $request->all();

        $suite->rates()->create([
            'type'  => strtolower($data['type']),
            'price' => $data['price'],
        ]);

        return redirect()->back()->with('success', 'Tarifa asignada');
    }

    public function removeRate(Rate $rate)
    {
        if (!auth()->user()->can('edit.suite'))
        abort(401);

        $rate->delete();
        return redirect()->back()->with('success', 'Tarifa eliminada');
    }
}
