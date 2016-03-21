<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.contacts.index');
    }

    public function show($id)
    {
        return view('admin.contacts.detail');
    }

    public function getContacts(Request $request)
    {
        $take = $request->take;
        return Contact::paginate(10);
    }
}
