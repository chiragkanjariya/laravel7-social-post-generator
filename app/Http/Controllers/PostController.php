<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
  // Default pageConfig
  protected $pageConfigs = [
    'navbarType' => 'sticky',
    'footerType' => 'static',
    'horizontalMenuType' => 'floating',
    'theme' => 'dark',
    'contentLayout' => "content-left-sidebar",
    'bodyClass' => 'chat-application',
    'navbarColor' => 'bg-primary'
  ];

  public function manage_index(){
    $profiles = array();
    array_push($profiles, array('user'=> User::find(1), 'role'=> User::find(1)->roles->first()->name, 'id'=> 2, 'count'=> 1, 'niche'=> 'Sports', 'hashtags'=>'laravel, python, development', 'color'=> '#93e7f1'));
    array_push($profiles, array('user'=> User::find(2), 'role'=> User::find(2)->roles->first()->name, 'id'=> 1, 'count'=> 2, 'niche'=> 'Model', 'hashtags'=>'shopify, python, web', 'color'=> '#c6e2d3'));
    array_push($profiles, array('user'=> User::find(2), 'role'=> User::find(2)->roles->first()->name, 'id'=> 3, 'count'=> 3, 'niche'=> 'Science', 'hashtags'=>'marketing, wordpress, magento', 'color'=> '#c6e2d3'));
    return view('pages.post-manage', [
      'pageConfigs' => $this->pageConfigs,
      'profiles' => $profiles
    ]);
  }
  /**
   * get posts by profile id
   * @param \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getPosts(Request  $request){
    $posts = Post::query()->where('profile_id', $request->profile_id)->get();
    return new JsonResponse($posts, 202);
  }
  /**
   * get posts by profile id
   * @param \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function deletePost(Request  $request){
    Post::find($request->id)->delete();
    return new JsonResponse([], 202);
  }
  /**
   * save post
   * @param \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function savePosts(Request  $request){
    $imagePath = '';
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('posts', 'public');
    }
    if ($imagePath == '')
    {
      return new JsonResponse("The image should be uploaded.", 203);
    }
    $post = Post::create( [ 'post_title' => $request->title,
            'post_content' => $request->content,
            'post_image' => $imagePath,
            'profile_id' => $request->profile_id,
        ]);
    return new JsonResponse($post, 202);
  }
}
