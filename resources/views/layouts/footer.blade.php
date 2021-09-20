<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="widget">
                <h2 class="widget-title">Popular Posts</h2>
                @foreach($all_posts as $all_post)
                    <div class="blog-list-widget">
                        <div class="list-group">
                            <a href="{{ route('posts.single', ['slug' => $all_post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <img src="{{ $all_post->getImage() }}" alt="" class="img-fluid float-left">
                                    <h5 class="mb-1">{{ $all_post->title }}</h5>
                                    <span class="rating">
                                        <i class="fa fa-star"> {{ $all_post->views }} </i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div><!-- end blog-list -->
                @endforeach
            </div><!-- end widget -->
        </div><!-- end col -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="widget">
                <h2 class="widget-title">Popular Categories</h2>
                <div class="link-widget">
                    <ul>
                        @foreach($all_categories as $all_category)
                            <li>
                                <a href="{{ route('categories.single', ['slug' => $all_category->slug ]) }}">{{ $all_category->title }} <span>({{ $all_category->posts_count }})</span></a>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- end link-widget -->
            </div><!-- end widget -->
        </div><!-- end col -->
    </div><!-- end row -->
    <div class="row">
        <div class="col-md-12 text-center">
            <br>
            <br>
            <div class="copyright">&copy; <?=date('Y')?>: <a href="http://laravel.blog/">Laravel Blog</a>.</div>
        </div>
    </div>
</div><!-- end container -->
