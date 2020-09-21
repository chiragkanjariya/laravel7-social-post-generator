<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScrapImageController extends Controller
{
  // Default pageConfig
  protected $pageConfigs = [
    'navbarType' => 'sticky',
    'footerType' => 'static',
    'horizontalMenuType' => 'floating',
    'theme' => 'dark',
    'navbarColor' => 'bg-primary'
  ];

  public function index(){
    return view('/pages/scrap-image', [
      'pageConfigs' => $this->pageConfigs
    ]);
  }
  /**
   * get images from instagram by hashtags
   * @param \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getImages(Request  $request){
    ini_set('max_execution_time','3600000');
    $image_array = array();
    $hashtags = isset($request->hashtag) ? $request->hashtag : 'webdevelopment';
    foreach ($hashtags as $hashtag)
    {
      $insta_source = file_get_contents('https://www.instagram.com/explore/tags/' . $hashtag . '/?1_all'); // instagrame tag url
      $shards = explode('window._sharedData = ', $insta_source );
      $insta_json = explode(';</script>', $shards[1]);
      $insta_array = json_decode($insta_json[0], TRUE);
      $result = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
      for ($i = 0; $i < sizeof($result); $i++)
      {
        $one = $result[$i];
        $image = $one['node']['display_url'];
        array_push($image_array, $image);
      }
    }
    return new JsonResponse($image_array, 202);
  }
}
