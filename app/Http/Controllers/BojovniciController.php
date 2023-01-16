<?php


namespace App\Http\Controllers;


use Aginev\Datagrid\Datagrid;
use App\Models\Bojovnik;
use Illuminate\Http\Request;

class BojovniciController extends Controller
{


    public function delete(Request $request)
    {
        $bojovnici = \App\Models\Bojovnik::find($request->id);
        $bojovnici->delete();
        return redirect()->route('bojovnici')->with('message', 'Bojovnik deleted successfully');
    }
    public function addBojView()
    {
        return view('bojovnik.pridajBojovnika');
    }
    public function addBoj(Request $request)
    {
        if($request->validate([
            'name' => 'string|max:255',
            'vyhry' => 'numeric',
            'prehry' => 'numeric',
        ])) {

            $products = Bojovnik::create([
                'name' => $request->name,
                'vyhry' => $request->vyhry,
                'prehry' => $request->prehry,
            ]);
            return redirect()->route('bojovnici');
        } else {
            return redirect()->back()->with('msg', 'Zle zadané údaje');
        }


    }

    public function index(Request $request)
    {
        $Bojovnici = \App\Models\bojovnik::All();

        $grid = new Datagrid($Bojovnici, $request->get('f', []));

        $grid->setColumn('name', 'name')
            ->setColumn('vyhry', 'Výhry')
            ->setColumn('prehry', 'Prehry')
        ->setActionColumn([
        'wrapper' => function ($value, $row) {
            return '<a href="' . route('addVyhra', [$row->id]) . '" class="btn btn-danger delete-btn">Pridaj Výhru</a>
            <a href="' . route('addPrehra', [$row->id]) . '" class="btn btn-danger delete-btn">Pridaj Prehru</a>
                    <a href="' . route('delete.bojovnik', [$row->id]) . '" class="btn btn-danger delete-btn">Delete</a>';
        }
    ]);
        return view('Bojovnik.bojovnici', ['grid' => $grid]);
    }


    public function incVyhra(Request $request)
    {
        $bojovnik = \App\Models\bojovnik::find($request->id);
        $bojovnik->increment('vyhry');
        $bojovnik->save();
        return redirect()->route('bojovnici')->with('message', 'Vyhra added successfully');
    }
    public function incPrehra(Request $request)
    {
        $bojovnik = \App\Models\bojovnik::find($request->id);
        $bojovnik->increment('prehry');
        $bojovnik->save();
        return redirect()->route('bojovnici')->with('message', 'Prehra added successfully');
    }

}
