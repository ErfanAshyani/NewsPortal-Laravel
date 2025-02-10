<?php

use App\Models\Language;
use App\Models\Setting;
use PhpParser\Node\Expr\Cast\String_;

/** format news tags */

function formatTags(array $tags): String
{
   return implode(',', $tags);
}

/** get selected language from session */
function getLangauge(): string
{
    if(session()->has('language')){
        \Illuminate\Support\Facades\App::setlocale(session('language'),'en');
        return session('language');
    }else {
        try {
            $language = Language::where('default', 1)->first();
            setLanguage($language->lang);

            return $language->lang;
        } catch (\Throwable $th) {
            setLanguage('en');

            return $language->lang;
        }
    }
}

/** set language code in session */
function setLanguage(string $code): void
{
    session(['language' => $code]);
    \Illuminate\Support\Facades\App::setlocale(session('language'),'en');
}
function saveonsession(string $key,string $value): void
{
    session([$key => $value]);

}
function getfromsession(string $key): string
{
    return session($key);

}
function deletefromsession(string $key): void
{
    session()->forget($key);

}

/** Truncate text */

function truncate(string $text, int $limit = 45): String
{
    return \Str::limit($text, $limit, '...');
}

/** Convert a number in K format */

function convertToKFormat(int $number): String
{
    if($number < 1000){
        return $number;
    }elseif($number < 1000000){
        return round($number / 1000, 1) . 'K';
    }else {
        return round($number / 1000000, 1). 'M';
    }
}

/** Make Sidebar Active */

function setSidebarActive(array $routes): ?string
{
    foreach($routes as $route){
        if(request()->routeIs($route)){
            return 'active';
        }
    }
    return '';
}

/** get Setting */

function getSetting($key){
    $data = Setting::where('key', $key)->first();
    return $data->value;
}

/** check permission */

function canAccess(array $permissions){

   $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
   $superAdmin = auth()->guard('admin')->user()->hasRole('Super Admin');

   if($permission || $superAdmin){
    return true;
   }else {
    return false;
   }

}

/** get admin role */

function getRole(){
    $role = auth()->guard('admin')->user()->getRoleNames();
    return $role->first();
}

/** check user permission */

function checkPermission(string $permission){
    return auth()->guard('admin')->user()->hasPermissionTo($permission);
}


