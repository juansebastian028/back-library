<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reserva;
use App\Models\User;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reservas = Reserva::with('libro','usuario')->get();
        
        return response()->json($reservas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    
    public function showByUser($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Reserva no encotrado.'
            ], 403);
        }

        return Pedido::select("reservas.id", "cantidad", "fecha_expira", "fecha_reserva")
        ->join('libros', 'reservas.libro_id', '=', 'libros.id')->where('reservas.usuario_id', '=', $id)
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $reserva = Reserva::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Reserva no encotrada.'
            ], 403);
        }
        $reserva->delete();
        return response()->json(['message'=>'Reserva eliminada correctamente.'], 200);
    }
}
