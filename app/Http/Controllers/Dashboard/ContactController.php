<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    protected $totalContacts;
    protected $newsMessages;
    protected $lastThreeMessages;

    public function __construct()
    {
        $this->totalContacts = Contact::count();
        $this->newsMessages = Contact::where('is_read', 0)->count();
        $this->lastThreeMessages = Contact::where('is_read', 0)->orderBy('id', 'desc')->take('3')->get();
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc');

        return view('dashboard/contact/index', array(
            'contacts' => $contacts,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
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
            'contacts' => $contacts,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
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
            'contact' => $contact,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function update(Request $request, $id)
    {

    }

    public function read()
    {
        $contacts = Contact::orderBy('id', 'desc')->where('is_read', 1);

        return view('dashboard.contact.index', array(
            'contacts' => $contacts,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function notRead()
    {

    }

    public function label($label)
    {
        $contacts = Contact::orderBy('id', 'desc')->where('label', $label);

        return view('dashboard/contact/index', array(
            'contacts' => $contacts,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function delete($id)
    {

    }
}
