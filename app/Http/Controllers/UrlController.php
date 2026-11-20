<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\UserUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'name_url' => $validated['original_url'],
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

    public function update(Request $request, $id)
    {
        UserUrl::where('user_id', auth()->id())
            ->where('url_id', $id)
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name_url' => ['required', 'url'],
            'short_url' => [
                'required',
                'alpha_dash',
                'max:50',
                Rule::unique('urls', 'short_url')->ignore($id),
                'not_in:SakuraLinks,random-url,process-input,profile,login,register'
            ],
            'description_url' => ['nullable', 'string', 'max:1000'],
        ], [
            'name_url.required' => 'Укажите исходную ссылку.',
            'name_url.url' => 'Введите корректный URL (например, https://...).',
            'short_url.required' => 'Короткий адрес не может быть пустым.',
            'short_url.alpha_dash' => 'Допускаются только латинские буквы, цифры, дефис и подчёркивание.',
            'short_url.unique' => 'Этот короткий адрес уже занят.',
            'short_url.not_in' => 'Это системное имя, выберите другое.',
            'description_url.max' => 'Описание не должно превышать 1000 символов.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('edit_url_id', $id);
        }

        $validated = $validator->validated();
        $url = Url::findOrFail($id);

        $url->update([
            'name_url' => $validated['name_url'],
            'short_url' => $validated['short_url'],
            'description_url' => $validated['description_url'] ?? null,
        ]);

        return back()->with('status', 'Ссылка успешно обновлена!');
    }

    public function destroy(string $id)
    {
        $userUrl = UserUrl::where('user_id', auth()->id())
            ->where('url_id', $id)
            ->firstOrFail();

        $userUrl->delete();
        Url::where('id', $id)->delete();

        return back()->with('status', 'Ссылка удалена');
    }
}
