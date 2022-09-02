<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::all();
        return view('links.index', [
            'links' => $links
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generateLink = $this->generateUniqueCode();
        return view('links.add', [
            'generateLink' => $generateLink
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Link::create([
            'url' => $data['url'],
            'short_link' => $data['short_link'],
            'active' => $request->has('active')
        ]);

        return redirect()->back()->withSuccess('Short link successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Link $link
     * @return mixed
     */
    public function edit(Link $link)
    {
        return view('links.edit', [
            'link' => $link
        ]);
    }

    /**
     * @param Request $request
     * @param Link $link
     * @return mixed
     */
    public function update(Request $request, Link $link)
    {
        $link->url = $request->url;
        $link->short_link = $request->short_link;
        $link->active = $request->has('active');
        $link->save();


        return redirect()->back()->withSuccess('Short link successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->back()->withSuccess('Short Link "' .$link["url"]. '" deleted!');
    }


    public function generateUniqueCode()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        do {
            $code = substr(str_shuffle($permitted_chars), 0, 7);
        } while (Link::where(DB::raw('BINARY `short_link`'), "=", $code)->first());

        return $code;
    }
}
