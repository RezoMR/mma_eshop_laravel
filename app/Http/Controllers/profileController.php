<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $user = Auth::user();
        return view('profile.edit_profile', ['user' => $user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $hasher = app('hash');
        if ($hasher->check($request->password, $user->password)) {
            // overte údaje formulára pomocou pravidiel validácie
            $request->validate([
                'name' => 'nullable|string|max:255',
                'lname' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
//                'phone' => 'nullable|digits:10',
            ]);

            // aktualizujte údaje používateľa podľa údajov z formulára
            if($request->filled('name')) {
                $user->name = $request->input('name');
            }
            if($request->filled('lname')) {
                $user->lastName = $request->input('lname');
            }
            if($request->filled('address')) {
                $user->address = $request->input('address');
            }
//            if($request->filled('phone')) {
//                $user->phone = $request->input('phone');
//            }



            // uložte aktualizácie do databázy
            $user->save();

            // presmerujte používateľa na stránku s profilom a oznámte mu úspešnú aktualizáciu
            return redirect('/editProfile')->with('success', 'Profil bol úspešne aktualizovaný');
        } else {
            // Heslo sa nezhoduje, zobrazíme chybové hlásenie
            return redirect()->back()->withErrors(['password' => 'Zadané heslo nie je správne.']);
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function del(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        // odhlásiť používateľa a presmerovať ho na úvodnú stránku
        Auth::logout();
        return redirect('/home');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deleteProf(Request $request)
    {
        $user = Auth::user();
        return view('profile.delete_profile', ['user' => $user]);
    }
}
