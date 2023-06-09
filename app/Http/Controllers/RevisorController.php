<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    public function index(){
        $announcement_to_check=Announcement::where('is_accepted', null)->first();
        $announcement=[];
        $refusedAnnouncements=Announcement::where('is_accepted', false)->get();
        return view('revisor.index', compact('announcement_to_check','announcement','refusedAnnouncements'));
    }
    public function acceptAnnouncement(Announcement $announcement,){
        $stato='accettato';
        $announcement->setAccepted(true);
        $announcement_to_check=Announcement::where('is_accepted', null)->first();
        $refusedAnnouncements=Announcement::where('is_accepted', false)->get();
        
        return view('revisor.index', compact('announcement_to_check','announcement','stato','refusedAnnouncements'));
        
    }
    // with('message', 'Complimenti, hai accettato l\'annuncio')->
    public function cancelAnnouncement(Announcement $announcement){
        $announcement->setAccepted(null);
        $announcement->save();
        $announcement=[];
        $announcement_to_check=Announcement::where('is_accepted', null)->first();
        $refusedAnnouncements=Announcement::where('is_accepted', false)->get();
        return view('revisor.index', compact('announcement_to_check','announcement','refusedAnnouncements'));
        //return redirect()->back()->with('message', 'Complimenti, hai annullato l\'annuncio');
    }

    public function rejectAnnouncement(Announcement $announcement){
        $stato='rifiutato';
        $announcement->setAccepted(false);
        $announcement->save();
        $announcement_to_check=Announcement::where('is_accepted', null)->first();
        $refusedAnnouncements=Announcement::where('is_accepted', false)->get();

        return view('revisor.index', compact('announcement_to_check','announcement','stato','refusedAnnouncements'));
        //return redirect()->back()->with('message', 'Complimenti, hai rifiutato l\'annuncio')->with('announcement',$announcement);
    }

    public function becomeRevisor()
    {
        Mail::to('admin@starmarket.it')->send(new BecomeRevisor(Auth::user()));
        return redirect('/')->with('success','Complimenti! Hai richiesto di entrare in accademia correttamente');
    }
    public function makeRevisor(User $user)
    {
        Artisan::call('presto:makeUserRevisor',["email"=>$user->email]);
        return redirect('/')->with('success','Complimenti! L\'utente è diventato un Maestro Jedi');
    }
}
