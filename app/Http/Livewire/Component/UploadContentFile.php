<?php

namespace App\Http\Livewire\Component;

use App\Services\FileService;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadContentFile extends Component
{
    const PATH_UPLOAD = 'image_contents';

    use WithFileUploads;

    public $image;

    public function updatedImage() {
        $imageService = app(FileService::class);
        $image = $imageService->save($this->image, static::PATH_UPLOAD);
        $pathImage = asset('storage/'.$image);

        $this->emit('uploaded', $pathImage);
    }

    public function render()
    {
        return view('livewire.component.upload-content-file');
    }
}
