<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
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
     * Show my account
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        return view('pages/accounts/edit', [
            'pageConfigs' => $this->pageConfigs,
            'user' => $user
        ]);
    }

    /**
     * Update my account
     * 
     * @param \App\Models\User  $user
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $validator = $request->validate([
            'username' => 'required|string|max:50',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50'
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('avatars', 'public');
        }

        $user->update([
            'name' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'photo' => $photo
        ]);

        return redirect()
            ->route('account.show')
            ->with('message', trans('locale.account.message.save'));
    }
}
