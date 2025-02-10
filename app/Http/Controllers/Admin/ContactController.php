<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminContactUpdateRequest;
use App\Models\Contact;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactController extends Controller implements HasMiddleware
{
//    public function __construct()
//    {
//        $this->middleware(['permission:contact index,admin'])->only(['index']);
//        $this->middleware(['permission:contact update,admin'])->only(['update']);
//    }
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('contact index,admin'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('contact update,admin'), only:['update']),



        ];
    }

    public function index()
    {
        $languages = Language::all();
        return view('admin.contact-page.index', compact('languages'));
    }

    public function update(AdminContactUpdateRequest $request)
    {
       Contact::updateOrCreate(
            ['language' => $request->language],
            [
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email
            ]
        );

        toast(__('admin.Updated Successfully'), 'success');

        return redirect()->back();
    }
}
