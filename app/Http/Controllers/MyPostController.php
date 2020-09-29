<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class MyPostController extends Controller
{
    // Default pageConfig
    protected $pageConfigs = [
        'navbarType'                => 'sticky',
        'footerType'                => 'static',
        'horizontalMenuType'        => 'floating',
        'theme'                     => 'dark',
        'navbarColor'               => 'bg-primary'
    ];

    /**
     * Show myposts page
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::whereHas('profile', function(Builder $q) {
            $q->where('user_id', Auth::user()->id);
        })->where('isapproved', 1)
        ->get();

        return view('/pages/myposts', [
            'pageConfigs'             => $this->pageConfigs,
            'posts'                   => $posts
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()
            ->with('message', trans('locale.mypost.message.delete'));
    }
}
