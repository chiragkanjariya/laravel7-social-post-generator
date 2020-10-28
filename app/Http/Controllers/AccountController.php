<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\OldpasswordValidate;
use Auth;

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
        $timezone = array();
        $timestamp = time();
        foreach(timezone_identifiers_list(\DateTimeZone::ALL) as $key => $t) {
            date_default_timezone_set($t);
            $timezone[$key]['zone'] = $t;
            $timezone[$key]['GMT_difference'] =  date('P', $timestamp);
        }
        $timezone = collect($timezone)->sortBy('GMT_difference');

        $user = Auth::user();
        return view('pages/accounts/edit', [
            'pageConfigs' => $this->pageConfigs,
            'user' => $user,
            'timezone' => $timezone
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
            'lastname' => 'required|string|max:50',
            'timezone' => 'required'
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('avatars', 'public');
        }

        $user->update([
            'name' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'photo' => $photo,
            'timezone' => $request->timezone
        ]);

        return redirect()
            ->route('account.show')
            ->with('message', trans('locale.account.message.save'));
    }

    /**
     * Change password in my account page
     * 
     * @param \App\Models\User  $user
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function changePassword(User $user, Request $request)
    {
        $validator = $request->validate([
            'old_password' => ['required', new OldpasswordValidate],
            'new_password' => 'required|min:6',
            'retype_password' => 'required|min:6|same:new_password',
        ]);

        $user->update([
            'password' => $request->new_password
        ]);

        return redirect()
            ->route('account.show')
            ->with('message', trans('locale.account.successPassword'));
    }
}
