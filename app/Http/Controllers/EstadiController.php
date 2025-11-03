<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EstadiController extends Controller
{
    public $estadis = [
        ['nom' => 'Estadi Johan Cruyff', 'localitat' => 'Sant Joan Despí', 'aforament' => 6000, 'equip' => 'FC Barcelona Femení'],
        ['nom' => 'Centro Deportivo Wanda Alcalá de Henares', 'localitat' => 'Alcalá de Henares', 'aforament' => 2800, 'equip' => 'Atlètic de Madrid Femení'],
        ['nom' => 'Estadio Alfredo Di Stéfano', 'localitat' => 'Madrid', 'aforament' => 6000, 'equip' => 'Real Madrid Femení'],
    ];

    public function index()
    {
        $estadis = Session::get('estadis', $this->estadis);
        return view('estadis.index', compact('estadis'));
    }

    public function show(int $id)
    {
        $estadis = Session::get('estadis', $this->estadis);
        abort_if(!isset($estadis[$id]), 404);
        $estadi = $estadis[$id];
        return view('estadis.show', compact('estadi'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'        => 'required|min:3',
            'localitat'  => 'required|min:2',
            'aforament'  => 'required|integer|min:0',
            'equip'      => 'required|min:3',
        ]);

        $estadis = Session::get('estadis', $this->estadis);
        $estadis[] = $validated;
        Session::put('estadis', $estadis);

        return redirect()->route('estadis.index')->with('success', 'Estadi afegit correctament!');
    }
}
