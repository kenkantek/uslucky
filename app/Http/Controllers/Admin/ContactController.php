<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyContactRequest;
use App\Models\Contact;
use App\Models\ContactPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $contact = Contact::findOrFail($id);
        if ($contact->status == 'unread') {
            $contact->status = 'read';
        }

        $contact->save();

        return view('admin.contacts.show', compact('contact'));
    }

    public function getContacts(Request $request)
    {
        $take = $request->take;

        return Contact::latest()->paginate($take);
    }

    public function update(ReplyContactRequest $request, $id)
    {
        $contact                = Contact::findOrFail($id);
        $contact->reply_content = $request->message;
        $contact->status        = 'replied';
        Mail::send('mail.contact.reply', ['senderName' => $contact->name, 'content' => $contact, 'logo' => ['path' => 'http://www.dadafest.co.uk/wp-content/uploads/2011/12/big-lottery-fund-logo.gif', 'width' => 150, 'height' => 150]], function ($m) use ($contact) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($contact->email, $contact->name)->subject('US Lucky reply your contact');
        });
        $contact->save();

        return $contact;
    }
    
    public function getPartner()
    {
        return view('admin.partners.index');
    }

    public function getPartnerList(Request $request)
    {
        $take = $request->take;

        return ContactPartner::latest()->paginate($take);
    }
}
