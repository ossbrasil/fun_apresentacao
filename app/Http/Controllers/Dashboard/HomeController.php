<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class HomeController extends Controller
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
        return view('dashboard.home', array(
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }
}
