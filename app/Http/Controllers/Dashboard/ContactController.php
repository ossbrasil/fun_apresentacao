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
    protected $notRead;

    public function __construct()
    {
        $this->totalContacts = Contact::count();
        $this->newsMessages = Contact::where('is_read', 0)->count();
        $this->lastThreeMessages = Contact::where('is_read', 0)->orderBy('id', 'desc')->take('3')->get();
        $this->notRead = Contact::where('is_read', 0)->count();
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(10);

        return view('dashboard/contact/index', array(
            'contacts' => $contacts,
            'notRead' => $this->notRead,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    // public function show($id)
    // {
    //     return view('dashboard/contact/show');
    // }

    public function create()
    {
        $contacts = Contact::orderBy('id', 'desc');

        return view('dashboard/contact/create', array(
            'contacts' => $contacts,
            'notRead' => $this->notRead,
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
        $contact = Contact::where('id',$id)->get()->first();
        $contact['is_read'] = 1;
        $contact->save();

        return view('dashboard.contact.edit', array(
            'contact' => $contact,
            'notRead' => $this->notRead,
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
        $contacts = Contact::orderBy('id', 'desc')->where('is_read', 1)->get()->all();

        return view('dashboard.contact.index', array(
            'contacts' => $contacts,
            'notRead' => $this->notRead,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function notRead()
    {
        $contacts = Contact::orderBy('id', 'desc')->where('is_read', 0)->get()->all();

        return view('dashboard.contact.index', array(
            'contacts' => $contacts,
            'notRead' => $this->notRead,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function label($label)
    {
        $contacts = Contact::orderBy('id', 'desc')->where('label', $label)->get()->all();

        return view('dashboard/contact/index', array(
            'contacts' => $contacts,
            'notRead' => $this->notRead,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();

            return redirect()->route('dashboard-contact')->with('warning', 'Contato deletado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Algo deu errado!');
        }
    }
}
