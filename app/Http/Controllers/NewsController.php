<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $news = News::orderBy('id', 'desc')->get();
            // return data
            return response ()->json ([
                "status" => 200,
                "message" => "get all news",
                "data" => $news,
            ]);

        }catch (\Exception $e){
            return response ()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        try {
            // check if user forgot entry
            $validated = $request->validated();
            // handle image for upload for post
            if($request->hasFile('image')){
                $validated["image"] = $request->uploadImage($request->file('image'));
            }else{
                $validated["image"] = null;
            }

            // handle image for logo
            if($request->hasFile("image_logo")){
                $validated["image_logo"] = $request->uploadImageLogo ($request->file ('image_logo'));
            }else{
                $validated["image_logo"] = null;
            }

            $news = News::create ($validated);

            return response ()->json ([
                "status" => 200,
                "message" => "created news now",
                "data" => $news,
            ], 200);
        }catch (\Exception $e){
            return response ()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // find ID
            $news_id = News::find($id);

            // check if id not found
            if(!$news_id){
                return response ()->json ([
                    "status" => 404,
                    "message" => "news not found"
                ], 404);
            }
            return response ()->json ([
                "status" => 200,
                "message" => "get news",
                "data" => $news_id,
            ], 200);
        }catch (\Exception $e){
            return response ()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, string $id)
    {
        try {
            // find news id
            $news_id = News::find($id);
            // check if news don't exist
            if(!$news_id){
                return response ()->json ([
                    "status" => 404,
                    "message" => "news not found"
                ], 404);
            }
            // validated
            $validated = $request->validated();
            // handle image
            if($request->hasFile('image')){
                $validated["image"] = $request->uploadImage($request->file('image'));

            }else{
                $validated["image"] = null;
            }
            // handle image for logo
            if($request->hasFile("image_logo")){
                $validated["image_logo"] = $request->uploadImageLogo ($request->file ('image_logo'));
            }else{
                $validated["image_logo"] = null;
            }
            // updated to database
            $news_id-> update ($validated);
            return response ()->json ([
                "status" => 200,
                "message" => "updated news",
                "data" => $news_id,
            ], 200);
        }catch (\Exception $e){
            return response ()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // find id
            $news_id = News::find($id);
            // check if id not exist
            if(!$news_id){
                return response ()->json ([
                    "status" => 404,
                    "message" => "news not found"
                ], 404);
            }

            // delete data from DB
            $news_id->delete();
            return response ()->json ([
                "status" => 200,
                "message" => "deleted news",
                "data" => $news_id,
            ], 200);
        }catch (\Exception $e){
            return response ()->json ([
                "status" => 500,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
