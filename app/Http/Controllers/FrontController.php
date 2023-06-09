<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
   Public function welcome () {
    $announcements= Announcement::where('is_accepted', true)->take(3)->orderBy('created_at','desc')->get();
   
        return view('welcome', compact('announcements'));
    }
    public function categoryShow (Category $category)
    {
        return view ('categoryShow', compact ('category'));
    }
    public function searchAnnouncements(Request $request)
    {
        //dd($request);
        $announcements=Announcement::search($request->searched)->where('is_accepted',true)->paginate(3);
        return view('announcement.index',compact('announcements'));
    }

    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
