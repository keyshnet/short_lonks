<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('links.index');
//        return view('home');
    }

    /**
     * @param $request
     */
    public function shortLink($request) {

        $url = Link::where(DB::raw('BINARY `short_link`'), $request)->where('active', true)->firstOrFail();

        $url->clicks++;
        $url->save();

        return redirect()->away($url->url);

    }


}
