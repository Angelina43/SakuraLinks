<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function handleInput(Request $request)
    {
        $validated = $request->validate([
            'original_url' => ['required', 'url'],
            'user_url' => ['nullable', 'alpha_dash', 'max:50', 'unique:url,short_url', 'not_in:SakuraLinks,random-url,process-input'],
        ]);

        $shortCode = $validated['user_url'] ?? $this->generateUniqueCode();

        Url::create([
            'name_url' => $validated['original_url'],
            'short_url' => $shortCode,
        ]);

        return redirect('/')->with('short_url', url($shortCode));
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = Str::lower(Str::random(10));
        } while (Url::where('short_url', $code)->exists());

        return $code;
    }

    public function redirectUrl($code)
    {
        $url = Url::where('short_url', $code)
            ->orWhere('random_url', $code)
            ->firstOrFail();

        return redirect()->away($url->name_url);
    }
}
