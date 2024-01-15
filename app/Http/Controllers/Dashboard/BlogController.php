<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);

        return view('dashboard.blog.index', array(
            'blogs' => $blogs,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function create()
    {
        return view('dashboard.blog.create', array(
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        return view('dashboard.blog.edit', array(
            'blog' => $blog,
            'totalContacts' => $this->totalContacts,
            'newsMessages' => $this->newsMessages,
            'lastThreeMessages' => $this->lastThreeMessages
        ));
    }
}
