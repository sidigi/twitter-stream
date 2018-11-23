<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::paginate(25);

        return view('admin.tweets.index', compact('tweets'));
    }

    public function create()
    {
        return view('admin.tweets.create');
    }

    public function store(Request $request)
    {
        $tweetId = collect(explode('/', $request->tweet))->filter()->last();

        $tweet = (new TwitterApiController())->get($tweetId);

        if ($request->has('approve')){
            $tweet->approved = true;
            $tweet->moderated= true;
        }

        try{
            $tweet->save();

            return redirect()->back()->with(['success'=> "Tweet with id {$tweetId} was saved"]);
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
    }

    public function approve(Tweet $tweet)
    {
        $tweet->approved = true;
        $tweet->save();
    }

    public function unApprove(Tweet $tweet)
    {
        $tweet->approved = false;
        $tweet->save();
    }

    public function moderate(Tweet $tweet)
    {
        $tweet->moderated = true;
        $tweet->save();
    }

    public function deleteNoModerate(){
        Tweet::moderated(false)->delete();

        return redirect()->route('admin.tweets.index');
    }
}
