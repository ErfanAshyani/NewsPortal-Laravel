<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\RecivedMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller implements HasMiddleware
{
//    public function __construct()
//    {
//        $this->middleware(['permission:contact message index,admin'])->only(['index']);
//        $this->middleware(['permission:contact message update,admin'])->only(['sendReplay']);
//    }
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('contact message index,admin'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('contact message update,admin'), only:['sendReplay']),



        ];
    }

    public function index()
    {
        RecivedMail::query()->update(['seen' => 1]);

        $messages = RecivedMail::all();
        return view('admin.contact-message.index', compact('messages'));
    }

    /** Sned Replay to a email */

    public function sendReplay(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required']
        ]);

        try {
            $contact = Contact::where('language', getLangauge())->first();

            /** Send mail */
            Mail::to($request->email)->send( new ContactMail($request->subject, $request->message, $contact->email));

            $makeReplied = RecivedMail::find($request->message_id);
            $makeReplied->replied = 1;
            $makeReplied->save();

            toast(__('admin.Mail Sent Successfully!'), 'success');

            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');

            return redirect()->back();
        }
    }
}
