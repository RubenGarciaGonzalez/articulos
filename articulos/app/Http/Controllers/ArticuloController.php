<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias=['Electrónica', 'Hogar', 'Bazar'];
        $precios = [
            0 => "Todos",
            1 => "Menos de 50€",
            2 => "Entre 50€-120€",
            3 => "Más de 120€"
        ];
        $miCategoria = $request->get('categoria');
        $precio=$request->get('precio');

        $articulos= Articulo::orderBy("nombre")
        ->categoria($miCategoria)
        ->precio($precio)
        ->paginate(3);

        return view('articulos.index', compact('articulos', 'categorias','precios','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>['required', 'unique:articulos,nombre'], 
            'categoria'=>['required'],
            'precio'=>['required'],
            'stock'=>['required']
        ]);

        //Compruebo que haya subido foto
        if ($request->has('imagen')) {
            $request->validate([
                'imagen'=>['image']
            ]);
            //Si todo es correcto:
            $file=$request->file('imagen');
            //Creo un nombre
            $nombre='articulos/'.time().'_'.$file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //Guardo el coche pero la imagen estaria mal
            $articulo=Articulo::create($request->all());
            //Actualizo el registro foto del articulo guardado
            $articulo->update(['imagen'=>"img/$nombre"]);
        }
        else{
            Articulo::create($request->all());
        }
        return redirect()->route('articulos.index')->with('mensaje', 'Artículo creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        return view('articulos.detalle', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        $categorias=['Electrónica', 'Hogar', 'Bazar'];
        return view('articulos.edit', compact('articulo', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        $request->validate([
            'nombre'=>['required', 'unique:articulos,nombre,'.$articulo->id], 
            'categoria'=>['required'],
            'precio'=>['required'],
            'stock'=>['required']
        ]);

        //Compruebo que haya subido foto
        if ($request->has('imagen')) {
            $request->validate([
                'imagen'=>['image']
            ]);
            //Si todo es correcto:
            $file=$request->file('imagen');
            //Creo un nombre
            $nombre='articulos/'.time().'_'.$file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //si he subido una foto nueva booro la vieja, SALVO que sea default.jpg
            if(basename($articulo->imagen)!='default.jpg'){
                unlink($articulo->imagen);
            }
            //ahora actualizo el coche
            $articulo->update($request->all());
            $articulo->update(['imagen'=>"img/$nombre"]);
        }
        else{
            $articulo->update($request->all());
        }
        return redirect()->route('articulos.index')->with('mensaje', 'Artículo modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //Primero borro la imagen si no es default.jpg
        //Borro el registro
        $imagen = $articulo->imagen;
        if (basename($imagen)!='default.jpg') {
            unlink($imagen);
        }
        //En cualquier caso, borro el registro
        $articulo->delete();
        return redirect()->route('articulos.index')->with('mensaje','Articulo borrado correctamente');
    }
}
