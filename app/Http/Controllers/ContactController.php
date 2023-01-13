<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('profile.contact');
    }

    public function showAll(Request $request)
    {
        $Contacs = \App\Models\Contact::All();

        $grid = new Datagrid($Contacs, $request->get('f', []));

        $grid->setColumn('name', 'Name')
            ->setColumn('email', 'email')
            ->setColumn('message' , 'Message')
        ->setActionColumn([
            'wrapper' => function($value, $row) {
                return '<a href="' . route('deleteContact', [$row->id]) . '" class="btn btn-danger delete-btn">Delete</a>';
           }
            ]);

        return view('profile.showAll', ['grid' => $grid]);
    }

public function delete(Request $request){

   $contact = \App\Models\Contact::find($request->id);
    $contact->delete();
    return redirect()->route('contactShow')->with('message', 'Contact deleted successfully');
}


    public function store(Request $request)
    {
        // validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // store the form data in the database
        Contact::create($request->all());


        return redirect('/home');
    }
}
