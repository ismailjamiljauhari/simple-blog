<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="{{ in_array(\Request::route()->getName(), [
        'posts.index',
        'posts.create',
        'posts.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('posts.index') }}"><i class="fa fa-news"></i><span class="menu-title">Post</span></a></li>
</ul>
