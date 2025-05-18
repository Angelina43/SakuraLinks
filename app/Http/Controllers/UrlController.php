<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function handleInput(Request $request)
    {
        $original_url = $request->input('original_url');
        $user_url = $request->input('user_url');
        $alphabet_english = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'y', 'z'];

        $url = new Url();
        $url->name_url = $original_url;
        if(empty($user_url)){
            $random_string = '';
            for ($i = 0; $i < 10; $i++) {
                $random_name = random_int(0, 24);
                $random_string .= $alphabet_english[$random_name];
            }
            $url->random_url = $random_string;
        } else {
            $url->short_url = $user_url;
        }

        $url->save();

        return redirect('/SakuraLinks');
    }

//    public function check(){
//        return "Это вернула функция check";
//        }
//
//    public function day(){
//        return $this->check();
//        }
}
