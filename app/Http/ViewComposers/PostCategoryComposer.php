<?php

namespace App\Http\ViewComposers;

use App\Models\Post;
use Illuminate\View\View;

class PostCategoryComposer
{
    public function compose(View $view)
    {
        $categories = Post::select('category')->distinct()->get();
        
        $view->with('postCategories', $categories);
    }
}