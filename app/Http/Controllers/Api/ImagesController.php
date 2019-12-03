<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\ImageRequest;
use App\Handlers\ImageUploadHandler;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Str;
use App\Models\Image;

class ImagesController extends ApiController
{

    /**
     * 图片上传
     *
     * @param ImageRequest $request
     * @param ImageUploadHandler $uploadHandler
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request, ImageUploadHandler $uploadHandler, Image $image)
    {
        switch ($request->f_type) {
            case 'avatar':
                $size   = 416;
                $result = $uploadHandler->save($request->image, Str::plural($request->f_type), Auth::id(), $size);
                break;
            case 'topic':
                $size   = 1024;
                $result = $uploadHandler->save($request->image, Str::plural($request->f_type), Auth::id(), $size);
                break;
            default:
                $result = [];
                break;
        }
        if (!$result['data']) {
            $image->path        = $result['path'];
            $image->f_type      = $request->f_type;
            $image->user_id     = Auth::id();
            $image->origin_name = $result['origin_name'];
            $image->save();
        } else {
            $image = $result['data'];
        }
        return $this->created(new ImageResource($image));
    }
}
