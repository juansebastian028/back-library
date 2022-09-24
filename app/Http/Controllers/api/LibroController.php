<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::where('estado', '=', 'A')->get();
        return response()->json($libros);
    }

    public function historialLibros()
    {
        $libros = Libro::where('estado', '=', 'I')->get();
        return response()->json($libros);
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
        if($image = $request->file('img')){
            $img_name = $image->getClientOriginalName();
            $image->move('uploads', $image->getClientOriginalName());
            $request->img = asset('/uploads/' . $img_name);
        }

        $libro = Libro::create([
            "titulo" => $request->titulo,
            "autor" => $request->autor,
            "anio" => $request->anio,
            "genero" => $request->genero,
            "paginas" => $request->paginas,
            "editorial" => $request->editorial,
            "ISSN" => $request->ISSN,
            "idioma" => $request->idioma,
            "precio" => $request->precio,
            "cantidad" => $request->cantidad,
            "estado" => $request->estado,
            "img" => $request->img
        ]);

        return response()->json($libro, 200);
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
        try {
            $libro = Libro::findOrFail($id);
            
            if($image = $request->file('img')){
                $img_name = $image->getClientOriginalName();
                $image->move('uploads', $image->getClientOriginalName());
                $request->img = asset('/uploads/' . $img_name);
            }
    
            $libro->update([
                "titulo" => $request->titulo,
                "autor" => $request->autor,
                "anio" => $request->anio,
                "genero" => $request->genero,
                "paginas" => $request->paginas,
                "editorial" => $request->editorial,
                "ISSN" => $request->ISSN,
                "idioma" => $request->idioma,
                "precio" => $request->precio,
                "cantidad" => $request->cantidad,
                "estado" => $request->estado,
                "img" => $request->img
            ]);

            return response()->json([
                'message' => 'Libro actualizado correctamente.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Libro no encontrado.'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $libro = Libro::findOrFail($id);
            
            $libro->update([
                'estado' => 'I'
            ]);

            return response()->json([
                'message' => 'Libro eliminado correctamente.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Libro no encontrado.'
            ], 403);
        }
    }
}
