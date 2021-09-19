<?php

namespace App\Http\Livewire\Admin\Post;

use App\Http\Livewire\Admin\BaseComponent;
use App\Services\BaseService;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class ImageContent extends BaseComponent
{
    use WithPagination;
    protected $listeners = ['deleteImage'];

    public function render()
    {
        $fService = app(FileService::class);
        $baseService = app(BaseService::class);
        $files = collect(Storage::disk('public')->allFiles('image_contents'))
            ->map(fn ($path) => ['path' => $path, 'url' => $fService->getImage($path)])
            ->toArray();
        $files = $baseService->paginate($files, 15);

        return view('livewire.admin.post.image-content', compact('files'))
            ->extends($this->extends)
            ->section($this->section);
    }

    public function deleteImage(array $images)
    {
        $fService = app(FileService::class);
        foreach($images as $image) {
            $fService->delete($image);
        }

        $this->emit('alert', ['success', 'Delete successfully']);
    }
}
