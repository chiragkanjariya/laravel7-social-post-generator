<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function __construct()
  {
  }

  public function view_index(){
    $viewPageConfigs = [
      'navbarType' => 'sticky',
      'footerType' => 'static',
      'horizontalMenuType' => 'floating',
      'theme' => 'dark',
      'navbarColor' => 'bg-primary'
    ];
    $profiles = Profile::query()->where('user_id', Auth::user()->id)->get();
    return view('pages.post-view', [
      'pageConfigs' => $viewPageConfigs,
      'profiles' => $profiles
    ]);
  }

  public function download_image(){

  }

  public function manage_index(){
    $result = array();
    $profiles = DB::select(DB::raw('
    SELECT profiles.*, posts_cnt.cnt, niches.name as niche_name FROM profiles
      LEFT JOIN (SELECT COUNT(posts.id) AS cnt, posts.profile_id FROM posts WHERE DATE(posts.created_at) = '. date('Y-m-d') .' GROUP BY posts.profile_id) AS posts_cnt ON profiles.id = posts_cnt.profile_id
      LEFT JOIN niches ON profiles.niche_id = niches.id
    ORDER BY posts_cnt.cnt'));
    foreach ($profiles as $profile)
    {
      $user = User::find($profile->user_id);
      $role = $user->roles->first()->name;
      $id = $profile->id;
      $count = $profile->cnt;
      $niche = $profile->niche_name;
      $hashtags = $profile->hashtag;
      $color = $profile->favour_color;
      array_push($result, array('user'=> $user, 'role'=> $role, 'id'=> $id, 'count'=> $count, 'niche'=> $niche, 'hashtags'=>$hashtags, 'color'=> $color));
    }
    return view('pages.post-manage', [
      'pageConfigs' => $this->pageConfigs,
      'profiles' => $result
    ]);
  }
  /**
   * get posts by profile id
   * @param \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getPosts(Request  $request){
    $posts = Post::query()->where('profile_id', $request->profile_id)
      ->where('created_at', 'LIKE', date('Y-m-d').'%')
      ->get();
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
            'isoverlay' => $request->isoverlay,
            'post_content' => $request->content,
            'post_image' => $imagePath,
            'profile_id' => $request->profile_id,
        ]);
    return new JsonResponse($post, 202);
  }

  /**
   * Approve post when user clicks approve buttion on view post page.
   * 
   * @param \Illuminate\Http\Request  $request
   * 
   * @return \Illuminate\Http\JsonResponse
   */
  public function approvePost(Request $request)
  {
    $post = Post::findOrfail($request->post_id);
    $post->isapproved = 1;
    $post->save();

    return new JsonResponse(null, 204);
  }

  /**
   * get posts by profile id
   * @param \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getNotApprovedPost(Request  $request){
    $posts = Post::query()->where('profile_id', $request->profile_id)
      ->where('created_at', 'LIKE', date('Y-m-d').'%')
      ->where('isapproved', 0)
      ->get();
    return new JsonResponse($posts, 202);
  }
}
