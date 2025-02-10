<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('subscribers index,admin'), only:['index','store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('subscribers update,admin'), only:['edit','update']),



        ];
    }
    public function index()
    {
        $subs = Subscriber::all();
        return view('admin.subscriber.index', compact('subs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required']
        ]);

        $subscribers = Subscriber::pluck('email')->toArray();

        /** Send mails */
        Mail::to($subscribers)->send(new Newsletter($request->subject, $request->message));

        toast(__('admin.Mail sended successfully!'), 'success');

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subscriber::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => __('admin.Deleted Successfully!')]);
    }
}
