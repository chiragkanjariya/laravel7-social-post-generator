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
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/coffeescript-2-1175056.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/nodewebkit-4-1175135.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/npm-3-1175132.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/c-57-1175191.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/confluence-3-1175188.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/django-13-1175187.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/django-13-1175187.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/django-13-1175187.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/django-13-1175187.png");
    array_push($image_array, "https://cdn.iconscout.com/icon/free/png-64/django-13-1175187.png");
//    foreach ($hashtags as $hashtag)
//    {
//      $insta_source = file_get_contents('https://www.instagram.com/explore/tags/' . $hashtag . '/?1_all'); // instagrame tag url
//      $shards = explode('window._sharedData = ', $insta_source );
//      $insta_json = explode(';</script>', $shards[1]);
//      $insta_array = json_decode($insta_json[0], TRUE);
//      $result = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
//      for ($i = 0; $i < sizeof($result); $i++)
//      {
//        $one = $result[$i];
//        $image = $one['node']['display_url'];
//        array_push($image_array, $image);
//      }
//    }
    return new JsonResponse($image_array, 202);
  }
}
