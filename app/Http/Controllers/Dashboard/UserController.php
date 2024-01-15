<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function edit() {
        return view('dashboard.profile.edit', array(
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }
}
