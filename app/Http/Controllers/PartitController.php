<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PartitController extends Controller
{
    public $partits = [
        [
            'local' => 'Barça Femení',
            'visitant' => 'Atlètic de Madrid',
            'data' => '2024-11-30',
            'resultat' => '',
        ],
        [
            'local' => 'Real Madrid Femení',
            'visitant' => 'Barça Femení',
            'data' => '2024-12-15',
            'resultat' => '0-3',
        ],
    ];

    public function index()
    {
        $partits = Session::get('partits', $this->partits);
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        return view('partits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'local' => 'required|min:2',
            'visitant' => 'required|min:2|different:local',
            'data' => 'required|date_format:Y-m-d',
            'resultat' => ['nullable', 'regex:/^\d+-\d+$/'],
        ], [
            'visitant.different' => 'L\'equip visitant ha de ser diferent del local.',
            'resultat.regex' => 'El resultat ha de tenir el format 0-0 (exemple: 2-1).',
        ]);

        $partits = Session::get('partits', $this->partits);
        $partits[] = $validated;
        Session::put('partits', $partits);

        return redirect()->route('partits.index')->with('success', 'Partit afegit correctament!');
    }
}
