<?php

namespace App\Tools;

use Storage;
use Illuminate\Http\UploadedFile;

class FileTool
{
    /**
     * 操作磁盘
     * 
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    private $disk;

    /**
     * 构造函数
     * 
     * @param  string  $disk
     * @return void
     */
    public function __construct(string $disk = 'public')
    {
        $this->disk = Storage::disk($disk);
    }

    /**
     * 上传文件
     * 
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $config
     * @return string
     */
    public function upload(UploadedFile $file, array $config = [])
    {
        $name = $config['name'] ?? $this->getUniqueName($file, $config['extension'] ?? '');
        return $this->disk->putFileAs($config['catalog'] ?? '', $file, $name);
    }

    /**
     * 上传多个文件
     * 
     * @param  array   $files
     * @param  bool    $url
     * @param  string  $catalog  存储目录
     * @return string
     */
    public function uploadMultiple(array $files, bool $url = false, string $catalog = '')
    {
        $result = [];
        foreach ($files as $key => $file) {
            if ($file instanceof UploadedFile) {
                $path = $this->upload($file);
                $result[$key] = $url ? $this->getUrl($path) : $path;
            }
        }
        return $result;
    }

    /**
     * 获得url
     *
     * @param  string  $path
     * @return string
     */
    public function getUrl($path)
    {
        return $this->disk->url($path);
    }

    /**
     * 获得内容
     *
     * @param  string  $path
     * @return string
     */
    public function getContent($address)
    {
        $path = str_replace($this->disk->url('/'), '', $address);
        if (! $this->disk->exists($path)) {
            return false;
        }
        return $this->disk->get($path);
    }

    /**
     * 删除文件
     * 
     * @param  string  $address
     * @return bool
     */
    public function delete(string $address)
    {
        return $this->disk->delete(str_replace($this->disk->url('/'), '', $address));
    }

    /**
     * 获得存储对象
     *
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage()
    {
        return $this->disk;
    }

    /**
     * 获得唯一名称
     * 
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $extension
     * @return string
     */
    private function getUniqueName(UploadedFile $file, string $extension = '')
    {
        // loading... 如出现重复文件名，请替换uniqid函数
        return date('Y-m-d') . '/' . uniqid() . '.' . ($extension ?: $file->getClientOriginalExtension());
    }
}