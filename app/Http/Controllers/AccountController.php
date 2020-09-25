<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\OldpasswordValidate;

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
