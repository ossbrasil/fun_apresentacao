<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc');

        return view('dashboard/contact/index', array(
            'contacts' => $contacts,
        ));
    }

    public function show($id)
    {
        return view('dashboard/contact/show');
    }

    public function create()
    {
        $contacts = Contact::orderBy('id', 'desc');

        return view('dashboard/contact/create', array(
            'contacts' => $contacts
        ));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|min:3',
            'email' => 'string|email|required',
            'subject' => 'string|required',
            'label' => 'string|required',
            'message' => 'string|required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $response = Contact::create($request->only('name', 'email', 'subject', 'label', 'message'));

        if ($response) {
            return redirect()->route('dashboard-contact')->with('success', 'Contato cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Algo de errado aconteceu');
    }

    public function edit($id)
    {
        $contacts = Contact::orderBy('id', 'desc');
        $contact = Contact::where('id',$id)->get()->first();
        $contact['is_read'] = 1;
        $contact->save();

        return view('dashboard/contact/edit', array(
            'contacts' => $contacts,
            'contact' => $contact
        ));
    }

    public function update(Request $request, $id)
    {

    }

    public function delete($id)
    {

    }
}
