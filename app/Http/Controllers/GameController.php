<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use Illuminate\Http\Request;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        return view('game');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse()
     */
    public function gameAjaxx(Request $request): \Illuminate\Http\JsonResponse
    {

        $Code = codes::create([
            'code' => $request->input('codee'),
        ]);

        return response()->json($Code);
    }


}
