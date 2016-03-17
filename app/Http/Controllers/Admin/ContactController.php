<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return view('admin.contacts.index');
    }

    public function getContact()
    {
        $contacts = Contact::select('id', 'name', 'email', 'created_at', 'status')->get();
        return $contacts;
    }

    public function getDetail($id)
    {
        return view('admin.contacts.detail');
    }
}
