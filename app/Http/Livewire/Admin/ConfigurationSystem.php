<?php

namespace App\Http\Livewire\Admin;

use App\Models\Configuration;
use App\Models\User;
use App\Rules\UrlRule;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConfigurationSystem extends Component
{
    use WithFileUploads;

    public Configuration $configuration;
    public $favicon, $banner, $password, $password_confirmation;
    public array $rules = [];

    public function mount()
    {
        $this->configuration = Configuration::firstOrNew();

        if (!$this->configuration->title) {
            $this->configuration->title = 'Chia sẻ và học hỏi';
        }

        if (!$this->configuration->total_post_a_cate) {
            $this->configuration->total_post_a_cate = 5;
        }

        if (!$this->configuration->facebook_link) {
            $this->configuration->facebook_link = 'https://www.facebook.com/thuongnguyen130499';
        }

        if (!$this->configuration->instagram_link) {
            $this->configuration->instagram_link = '#';
        }

        if (!$this->configuration->twitter_link) {
            $this->configuration->twitter_link = '#';
        }

        if (!$this->configuration->personal_link) {
            $this->configuration->personal_link = 'https://nguyenthuong1304.github.io/mysefl/';
        }

        if (!$this->configuration->banner) {
            $this->banner = asset('images/banner.jpeg');
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.admin.configuration-system')
            ->extends('layouts.admin.app')
            ->section('main');
    }

    public function store(FileService $fileService)
    {
        $this->validate();

        if ($this->banner instanceof UploadedFile) {
            $fileService->delete($this->configuration->banner);
            $this->configuration->banner = $fileService->save($this->banner);
        }

        if ($this->favicon instanceof UploadedFile) {
            $fileService->delete($this->configuration->favicon);
            $this->configuration->favicon = $fileService->save($this->favicon);
        }

        $this->configuration->save();

        if ($this->password) {
            User::first()->update(['password' => bcrypt($this->password)]);
            $this->password = '';
            $this->password_confirmation = '';
        }

        $this->emit('alert', [
            'success',
            'Cập nhận thông tin cấu hình thành công',
        ]);
    }

    public function rules()
    {
        return [
            'configuration.title' => 'bail|nullable|max:255|string',
            'configuration.banner' => 'bail|nullable|file|mimes:jpeg,jpg,png|max:4000',
            'configuration.favicon' => 'bail|nullable|file|mimes:jpeg,jpg,png|max:4000',
            'configuration.total_post_a_cate' => 'bail|nullable|integer',
            'configuration.facebook_link' => [
                'bail',
                'nullable',
                'max:255',
                new UrlRule(),
            ],
            'configuration.instagram_link' => [
                'bail',
                'nullable',
                'max:255',
                new UrlRule(),
            ],
            'configuration.twitter_link' => [
                'bail',
                'nullable',
                'max:255',
                new UrlRule(),
            ],
            'configuration.personal_link' => [
                'bail',
                'nullable',
                'max:255',
                new UrlRule(),
            ],
            'configuration.config_common' => [
                'bail',
                'nullable',
                'max:255',
                new UrlRule(),
            ],
            'password' => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation|max:32',
            'password_confirmation' => 'nullable|min:6|max:32',
        ];
    }
}
