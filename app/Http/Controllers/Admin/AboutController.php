<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AboutController extends Controller implements HasMiddleware


{

    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('about index,admin'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('about update,admin'), only:['update']),



        ];
    }

    public function index()
    {
        $languages = Language::all();

        return view('admin.about-page.index', compact('languages'));
    }

    public function update(Request $request)
    {


        $request->validate([
            'content1' => ['required']
        ]);

        About::updateOrCreate(
            ['language' => $request->language],
            [
                'content' => $request->content1 ?? 'empty',
            ]
        );

        toast(__('admin.Updated Successfully!'), 'success');

        return redirect()->back();
    }


}
