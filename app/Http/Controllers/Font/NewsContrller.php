<?php

namespace App\Http\Controllers\Font;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsContrller extends Controller
{
    // last news
    public function lastNews(){
        try {
            $last_news = News::latest()->take (5)->get ();
            return response()->json([
                'status' => 200,
                "message" => "last news found",
                'data' => $last_news
            ], 200);
        }catch (\Exception $e){
            return response()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    // hot news
    public function hotNews ()
    {
        try {

            // hot news
            $host_news = News::latest()->take (5)->get ();
            return response()->json([
                'status' => 200,
                "message" => "hot news found",
                'data' => $host_news
            ],200);
        }catch (\Exception $e){
            return response()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ],500);
        }
    }

    // related news
    public function relatedNews (){
        try {

        }catch (\Exception $e){
            return response()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
