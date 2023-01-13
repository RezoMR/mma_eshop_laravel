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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
                    return '<a href="' . route('deleteProduct', [$row->id]) . '" class="btn btn-danger delete-btn">Delete</a>';
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
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'string|max:255',
            'img' => 'string|max:255',
            'popis' => 'string|max:255',
        ]);

        $string1 = "/imgs/";
        $result = $string1 . "" . $request->img;

        $products = products::create([
            'name' => $request->name,
            'price' => $request->cena,
            'img' => $result,
            'popis' => $request->popis,
        ]);

        return redirect()->route('shopView');
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
}

