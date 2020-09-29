<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use File;

class InstagramController extends Controller
{
    // Default pageConfig
    protected $pageConfigs = [
        'navbarType' => 'sticky',
        'footerType' => 'static',
        'horizontalMenuType' => 'floating',
        'theme' => 'dark',
        'navbarColor' => 'bg-primary'
    ];

    public function index()
    {
        $profiles = Auth::user()->profiles;

        return view('pages/instagrams/index', [
            'pageConfigs' => $this->pageConfigs,
            'profiles' => $profiles
        ]);
    }

    public function indexManagement()
    {
        $profiles = Profile::all();

        return view('/pages/instagrams/index-management', [
            'pageConfigs' => $this->pageConfigs,
            'profiles' => $profiles
        ]);
    }

    public function edit(Profile $profile)
    {
        return view('/pages/instagrams/edit', [
            'pageConfigs' => $this->pageConfigs,
            'profile' => $profile
        ]);
    }

    public function store(Profile $profile, Request $request)
    {
        $validator = $request->validate([
            'followers' => 'required|integer',
            'best_hashtags' => 'required|string|max:190',
            'posts' => 'required|integer',
            'advices' => 'required|string|max:190'
        ]);
        
        $profile->analysistInstagram()->updateOrCreate([
            'followers' => $request->followers,
            'best_hashtags' => $request->best_hashtags,
            'posts' => $request->posts,
            'advices' => $request->advices
        ]);

        return redirect('/instagrams/management')
            ->with('message', trans('locale.instagram.message.save'));
    }

    public function destroy(Profile $profile)
    {
        $profile->analysistInstagram()->delete();

        return back()
            ->with('message', trans('locale.instagram.message.delete'));
    }
}
