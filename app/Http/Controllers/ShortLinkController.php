<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
        $this->timeLaps();
        return view('shortenLink', compact('shortLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'timeline' => 'required|integer'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
        $input['clicks'] = 0;
        $input['timeline'] = $request->timeline;

        ShortLink::create($input);

        return redirect('generate-shorten-link')->with('success', 'Shorten Link Generated Successfully!');
    }

    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();
        $find->increment('clicks');
        $find->update();
        return redirect($find->link);
    }

    public function timeLaps()
    {
        $gettimes = ShortLink::latest()->get();
        foreach ($gettimes as $gettime) {
            if ($gettime->timeline != 0)
            {
                ShortLink::whereRaw('created_at < NOW() - INTERVAL '.$gettime->timeline.' HOUR')->delete();
            }
        }
    }

}
