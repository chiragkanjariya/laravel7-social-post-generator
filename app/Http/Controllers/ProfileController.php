<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Niche;
use App\Models\Profile;
use App\Rules\TagValidate;
use Illuminate\Http\RedirectResponse;
use Auth;

class ProfileController extends Controller
{
    /**
     * Default page configs
     * 
     * @var array
     */
    protected $pageConfigs = [
        'navbarType' => 'sticky',
        'footerType' => 'static',
        'horizontalMenuType' => 'floating',
        'theme' => 'dark',
        'navbarColor' => 'bg-primary'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $profiles = Auth::user()->profiles;

        return view('/pages/profiles/index', [
            'pageConfigs' => $this->pageConfigs,
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $role = Auth::user()->roles[0]->name;
        $profiles = Auth::user()->profiles;

        switch ($role) {
            case 'Beginner':
                if (count($profiles) > 0) return back()->with('message', trans('locale.profile.message.overProfile'));
                break;
            case 'Intermediate':
                if (count($profiles) > 1) return back()->with('message', trans('locale.profile.message.overProfile'));
                break;
            case 'Advanced':
                if (count($profiles) > 2) return back()->with('message', trans('locale.profile.message.overProfile'));
                break;
        }

        $niches = Niche::all();
        $breadcrumbs = [
            ['link' => "/profiles", 'name' => trans('locale.profile.title')],
            ['name'=>trans('locale.profile.create')]
        ];

        return view('/pages/profiles/create', [
            'pageConfigs' => $this->pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'niches' => $niches
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = $request->validate([
            'niche' => 'required',
            'hashtag' => ['required', new TagValidate],
            'favour_color' => 'required',
        ]);
        Auth::user()->profiles()->create([
            'niche_id' => $request->niche,
            'hashtag' => $request->hashtag,
            'favour_color' => $request->favour_color,
            'instagram' => $request->instagram
        ]);

        return redirect()->route('profiles.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $breadcrumbs = [
            ['link' => "/profiles", 'name' => trans('locale.profile.title')],
            ['name'=>trans('locale.profile.edit')]
        ];

        return view('/pages/profiles/edit', [
            'pageConfigs' => $this->pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Profile $profile): RedirectResponse
    {
        $validator = $request->validate([
            'hashtag' => ['required', new TagValidate],
            'favour_color' => 'required',
        ]);
        $profile->update([
            'hashtag' => $request->hashtag,
            'favour_color' => $request->favour_color,
            'instagram' => $request->instagram
        ]);

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Profile $profile): RedirectResponse
    {
        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('message', trans('locale.profile.message.delete'));
    }
}
