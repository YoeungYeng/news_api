<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
