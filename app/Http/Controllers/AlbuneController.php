<?php

namespace App\Http\Controllers;

use App\Models\Albune;
use App\Models\Artista;
use Illuminate\Http\Request;

/**
 * Class AlbuneController
 * @package App\Http\Controllers
 */
class AlbuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albunes = Albune::paginate();

        return view('albune.index', compact('albunes'))
            ->with('i', (request()->input('page', 1) - 1) * $albunes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albune = new Albune();
        $artistas= Artista::pluck('nombre','id');
        return view('albune.create', compact('albune','artistas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Albune::$rules);

        $albune = Albune::create($request->all());

        return redirect()->route('albunes.index')
            ->with('success', 'Albune created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $albune = Albune::find($id);

        return view('albune.show', compact('albune'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $albune = Albune::find($id);
        $artistas= Artista::pluck('nombre','id');

        return view('albune.edit', compact('albune','artistas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Albune $albune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Albune $albune)
    {
        request()->validate(Albune::$rules);

        $albune->update($request->all());

        return redirect()->route('albunes.index')
            ->with('success', 'Albune updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $albune = Albune::find($id)->delete();

        return redirect()->route('albunes.index')
            ->with('success', 'Albune deleted successfully');
    }
}
