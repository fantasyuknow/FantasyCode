<?php


namespace App\Handlers;

use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage;


class ImageUploadHandler
{

    private $current_time;

    public function __construct()
    {
        $this->current_time = time();
    }

    protected $allowedExt = ['png', 'jpeg', 'gif', 'jpg'];

    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }

        $folderName = "uploads/images/{$folder}/" . date('Ym', $this->current_time) . '/' . date('d', $this->current_time) . '/';
        $uploadPath = public_path() . '/' . $folderName;
        $fileName   = $file_prefix . '_' . $this->current_time . '_' . Str::random(10) . '.' . $extension;
        $file->move($uploadPath, $fileName);
        if ($max_width && $extension != 'gif') {
            // 此类中封装的函数，用于裁剪图片
            $this->cutSize($uploadPath . $fileName, $max_width);
        }
        return [
            'path' => "/{$folderName}{$fileName}"
        ];
    }

    /**
     * 图片裁剪
     *
     * @param $file_path
     * @param $max_width
     */
    public function cutSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);
        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {
            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();
            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });
        // 对图片修改后进行保存
        $image->save();
    }
}
