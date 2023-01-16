<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = products::all();
        return view('shop.shop', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addProdView()
    {
        return view('shop.shop_pridaj');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showAll(Request $request)
    {
        $Products = \App\Models\products::All();

        $grid = new Datagrid($Products, $request->get('f', []));

        $grid->setColumn('name', 'name')
            ->setColumn('price', 'price')
            ->setColumn('popis', 'popis')
            ->setActionColumn([
                'wrapper' => function ($value, $row) {
                    return ' <a href="' . route('editProduct', [$row->id]) . '" class="btn btn-danger delete-btn">Edit</a>
                    <a href="' . route('deleteProduct', [$row->id]) . '" class="btn btn-danger delete-btn">Delete</a>';
                }
            ]);

        return view('shop.delete', ['grid' => $grid]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addProd(Request $request)
    {
        if($request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'img' => 'required|string|max:255',
            'popis' => 'required|string|max:255',
        ])){
            $string1 = "/imgs/";
            $result = $string1 . "" . $request->img;

            $products = products::create([
                'name' => $request->name,
                'price' => $request->cena,
                'img' => $result,
                'popis' => $request->popis,
            ]);

            return redirect()->route('shopView');
        } else {
            return redirect()->back()->withErrors('Error', 'Zle zadane data');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $products = \App\Models\products::find($request->id);
        $products->delete();
        return redirect()->route('productShow')->with('message', 'Product deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $products = \App\Models\products::find($request->id);

        return view('shop.edit', ['products' => $products]);
    }

    public function update(Request $request)
    {
    $products = products::find($request->id);

            if($request->validate([
                'name' => 'nullable|string|max:255',
                'popis' => 'nullable|string|max:255',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'img' => 'nullable|string|max:255',
            ])) {
                // aktualizujte údaje používateľa podľa údajov z formulára
                if($request->filled('name')) {
                    $products->name = $request->input('name');
                }
                if($request->filled('price')) {
                    $products->price = $request->input('price');
                }
                if($request->filled('popis')) {
                    $products->popis = $request->input('popis');
                }
                if($request->filled('img')) {
                    $products->img = $request->input('img');
                }



                // uložte aktualizácie do databázy
                $products->save();

                // presmerujte používateľa na stránku s profilom a oznámte mu úspešnú aktualizáciu
                return redirect('shop')->with('success', 'Produkt bol úspešne aktualizovaný');
            } else {
                return redirect()->back()->with('error', 'zle zadaný vstup');

            }
    }

}

