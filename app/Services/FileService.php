<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public function save(UploadedFile $file, string $path = '/') : string
    {
        return Storage::putFile($path, $file);
    }

    public function getImage(string $fileName)
    {
        return config('filesystems.default') === 'public'
            ? url(Storage::url($fileName))
            : Storage::url($fileName);
    }

    /**
     * @param $fileName
     * @param $prefix
     */
    public function move($fileName, $prefix)
    {
        if ($this->isset($fileName)) {
            $newFilename = $prefix . last(explode('/', $fileName));
            Storage::move($fileName, $newFilename);

            return $newFilename;
        } else {
            logInfo('Not found file=' . $fileName);
        }
    }

    /**
     * @param $fileName
     */
    public function delete($fileName)
    {
        if ($this->isset($fileName)) {
            return Storage::delete($fileName);
        } else {
            logInfo('Not found file=' . $fileName);
        }
    }

    /**
     * @param $fileName
     * @return bool
     */
    public function isset($fileName): bool
    {
        return Storage::exists($fileName);
    }

    public function getPath($fileName)
    {
        if ($this->isset($fileName)) {
            return Storage::path($fileName);
        }
        logInfo('Not found file=' . $fileName);

        return false;
    }
}
