<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\UserUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function handleInput(Request $request)
    {
        $validated = $request->validate([
            'original_url' => ['required', 'url'],
            'user_url' => ['nullable', 'alpha_dash', 'max:50', 'unique:urls,short_url', 'not_in:SakuraLinks,random-url,process-input'],
            'description_url' => ['required', 'string', 'max:1000'],
        ]);

        $shortCode = $validated['user_url'] ?? $this->generateUniqueCode();

        $url = Url::create([
            'name_url'  => $validated['original_url'],
            'short_url' => $shortCode,
            'description_url' => $validated['description_url']
        ]);

        UserUrl::create([
            'user_id' => auth()->id(),
            'url_id' => $url->id,
        ]);

        return redirect('index')->with('short_url', url($shortCode));
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
