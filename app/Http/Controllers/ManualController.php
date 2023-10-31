<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManualController extends Controller
{
    public function manual_admin(Request $request, $file = 'index')
    {
        if ($file != 'index') {
            $file = $file . '/index';
        }
        return File::get(public_path() . '/manual/' . $file . '.html');
    }
}
