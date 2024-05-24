<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Url;

class UrlController extends Controller
{
    public function shortenUrl(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);
    
        $originalUrl = $request->input('url');
    
        // URL'den # işaretinden sonrasını kaldır
        $originalUrl = strtok($originalUrl, '#');
    
        $existingUrl = Url::where('original_url', $originalUrl)->first();
    
        if ($existingUrl) {
            return redirect()->back()->with('shortenedUrl', url($existingUrl->short_code));
        }
    
        $shortCode = $this->generateShortCode();
        Url::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode
        ]);
    
        return redirect()->back()->with('shortenedUrl', url($shortCode));
    }
 
    protected function generateShortCode()
    {
        return Str::random(12);
    }

    public function redirect($shortCode)
    {
        $url = Url::where('short_code', $shortCode)->firstOrFail();
        return redirect()->to($url->original_url);
    }
}
