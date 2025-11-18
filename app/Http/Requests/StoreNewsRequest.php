<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize (): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules (): array
    {
        return [
            "title" => "required|string",
            "description" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "slug" => "required|string",
            "image_logo" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "title_logo" => "required|string",
        ];
    }


    // crop image for logo
    public function uploadImageLogo ($image)
    {
        // check if it is Image
        if ($image && $image->isValid ()) {
            // Generate a unique filename
            $filename = Str::uuid () . '.' . $image->getClientOriginalExtension ();

            // Read and crop/resize the image using Intervention
            $processedImage = Image::read ($image)
                ->cover (60, 60) // Resize to 300x300 pixels
                // ->crop(300, 300, 50, 50) // Or optionally crop
                ->encodeByExtension ($image->getClientOriginalExtension (), quality: 80);

            // Save to public disk
            Storage::disk ('public')->put ("images/logo/{$filename}", $processedImage);

            // Return the public URL
            return asset ("storage/images/{$filename}");
        }

        return null;
    }

    public function uploadImage ($image)
    {
        // check if it is Image
        if ($image && $image->isValid ()) {
            // Generate a unique filename
            $filename = Str::uuid () . '.' . $image->getClientOriginalExtension ();

            // Read and crop/resize the image using Intervention
            $processedImage = Image::read ($image)
                ->cover (300, 300) // Resize to 300x300 pixels
                // ->crop(300, 300, 50, 50) // Or optionally crop
                ->encodeByExtension ($image->getClientOriginalExtension (), quality: 80);

            // Save to public disk
            Storage::disk ('public')->put ("images/{$filename}", $processedImage);

            // Return the public URL
            return asset ("storage/images/{$filename}");
        }

        return null;
    }

    // check validated
    public function failedValidation (\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            Response ()->json (['errors' => $validator->errors ()], 422)
        );
    }

    // formate date
    protected function formatDate ()
    {
        return [
            "created_at" => "datetime: d-m-Y",
            "updated_at" => "datetime: d-m-Y",
        ];
    }
}
