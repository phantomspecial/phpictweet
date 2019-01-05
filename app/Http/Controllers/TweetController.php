<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::all();
        return view('tweet.index', ['tweets' => $tweets]);
    }

    public function create()
    {
        return view('tweet.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, Tweet::$rules);
        $tweet = new Tweet;
        $formdata = $request->all();
        unset($formdata['_token']);
        $tweet->fill($formdata)->save();

        return redirect('/tweet');
    }

    public function show($id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.show', ['tweet' => $tweet]);
    }

    public function edit($id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.edit', ['tweet' => $tweet]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, Tweet::$rules);
        $tweet = Tweet::find($id);
        $formdata = $request->all();
        unset($formdata['_token']);
        $tweet->fill($formdata)->save();

        return redirect()->action('TweetController@show', ['id' => $id]);
    }

    public function destroy($id)
    {
        Tweet::find($id)->delete();
        return redirect('/tweet');
    }
}
