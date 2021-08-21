<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Artesaos\SEOTools\Traits\SEOTools;

class PostController extends Controller
{
    use SEOTools;

    public function byCategory($id)
    {

        $category = Category::with([
            'posts',
            'children',
            'children.posts',
        ])->findOrFail($id);

        $this->seo()->setTitle('Chia sẽ lập trình', false);
        $this->seo()->setDescription('Trang web nhằm mục đích chia sẽ lập tình miễn phí cho người mới bắt đầu, và chia sẽ kiến thức lập trình đến mọi người');
        $this->seo()->opengraph()->setUrl(request()->url());

        return view('by-category', compact('category'));
    }
}
