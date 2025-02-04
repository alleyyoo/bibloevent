<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return redirect(route('admin.pages'));
    }

    public function urlImage(Request $request)
    {
        if (filter_var($request->url, FILTER_VALIDATE_URL)) {

            $image = $request->url;
            $path = $request->url;

            if (preg_match("@((https?:\/\/)?(?:youtu\.be\/|(?:[a-z]{2,3}\.)?youtube\.com\/v\/)([\w-]{11}).*|https?:\/\/(?:youtu\.be\/|(?:[a-z]{2,3}\.)?youtube\.com\/watch(?:\?|#\!)v=)([\w-]{11}).*)@i", $request->url)) {
                preg_match("@(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+@", $request->url, $matches);
                $image = "https://img.youtube.com/vi/{$matches[0]}/maxresdefault.jpg";
            } elseif (preg_match('/(http|https)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)/', $request->url, $matches)) {
                $hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . end($matches) . '.php'));
                $image = $hash[0]['thumbnail_large'];
            }

            return compact('image', 'path');

        } else {
            abort(500);
        }
    }
}
