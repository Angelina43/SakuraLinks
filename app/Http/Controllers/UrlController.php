<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function handleInput(Request $request)
    {
        $url_user = $request->input('url');

        $url = new Url();
        $url->name_url = $url_user;

        $url->save();

        return redirect('/SakuraLinks');
    }
}
