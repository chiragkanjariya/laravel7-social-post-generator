<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Freepost;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use File;

class FreePostController extends Controller
{
    // Default pageConfig
    protected $pageConfigs = [
        'navbarType' => 'sticky',
        'footerType' => 'static',
        'horizontalMenuType' => 'floating',
        'theme' => 'dark',
        'navbarColor' => 'bg-primary'
    ];

    /**
     * Show freepost page
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $freeposts = Auth::user()->freeposts;

        return view('/pages/freeposts/index', [
            'pageConfigs' => $this->pageConfigs,
            'freeposts' => $freeposts
        ]);
    }

    /**
     * Create freepost page
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('/pages/freeposts/create', [
            'pageConfigs' => $this->pageConfigs
        ]);
    }

    /**
     * Store specified freepost to database.
     * 
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'image' => 'required',
            'title' => 'required|string|max:50',
            'content' => 'required|string'
        ]);
        
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('posts', 'public');
        }
        
        Auth::user()->freeposts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image
        ]);

        return redirect('/freeposts')
            ->with('message', trans('locale.freepost.message.save'));
    }

    /**
     * Remove specified resource from database.
     * 
     * @param \App\Models\Freepost  $freepost
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freepost $freepost)
    {
        $imagePath = public_path("storage/$freepost->image");
        if (File::exists($imagePath) && $freepost->image != null) { // unlink or remove previous image from folder
            unlink($imagePath);
        }
        $freepost->delete();

        return back()
            ->with('message', trans('locale.freepost.message.delete'));
    }
}
