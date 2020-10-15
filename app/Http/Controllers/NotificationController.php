<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notification;
use App\Events\NotificationEvent;
use phpDocumentor\Reflection\Types\True_;


class NotificationController extends Controller
{
   /**
   * init function.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
      $data = new Notification;
      $data->channel = ['notification-channel'];
      $data->title = 'Schedule';
      $data->message = ['message' => 'It is your post schedule time', 'user' => \Auth::user()->id];
      $data->url = 'http://google.com';
      $data->icon = 'mid mid-bar';
      $data->user = \Auth::user()->id;
      $res = event(new NotificationEvent($data));
      return $res;
    }

}
