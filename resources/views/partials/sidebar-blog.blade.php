<div class="sidebar ms-lg-4 ps-lg-4 mt-5 mt-lg-0">
    <!-- Search widget-->
    <aside class="widget widget_search">
        <form class="position-relative" action="{{ route('blog-search') }}" method="GET">
            <input class="form-control" type="text" name="search" placeholder="Search...">
            <button class="bg-transparent border-0 position-absolute top-50 end-0 translate-middle-y fs-22 me-2" type="submit"><span class="mdi mdi-magnify text-muted"></span></button>
        </form>
    </aside>

    <div class="mt-4 pt-2">
        <div class="sd-title">
            <h6 class="fs-16 mb-3">Popular Post</h6>
        </div>
        <ul class="widget-popular-post list-unstyled my-4">
            @foreach ($popularPosts as $item)
                <li class="d-flex mb-3 align-items-center pb-3 border-bottom">
                    <img src="{{ $item->image ? $item->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="widget-popular-post-img rounded" />
                    <div class="flex-grow-1 text-truncate ms-3">
                        <a href="{{ route('blog-detail', $item->slug) }}" class="text-dark">{{ $item->title }}</a>
                        <span class="d-block text-muted fs-14">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div><!--end Polular Post-->
    <div class="mt-4 pt-2">
        <div class="sd-title">
            <h6 class="fs-16 mb-3">Latest Tags</h6>
        </div>
        <div class="tagcloud mt-3">
            @foreach ($tags as $tag)
                <a class="badge tag-cloud fs-12 mt-2" href="{{ route('blog-search', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div><!--end Latest Tags-->

    <div class="mt-4 pt-2">
        <div class="sd-title">
            <h6 class="fs-16 mb-3">Follow & Connect</h6>
        </div>
        <ul class="widget-social-menu list-inline mb-0 mt-3">
            <li class="list-inline-item">
                <a href="javascript:void(0)"><i class="uil uil-facebook-f"></i></a>
            </li>
            <li class="list-inline-item">
                <a href="javascript:void(0)"><i class="uil uil-whatsapp"></i></a>
            </li>
            <li class="list-inline-item">
                <a href="javascript:void(0)"><i class="uil uil-twitter-alt"></i></a>
            </li>
            <li class="list-inline-item">
                <a href="javascript:void(0)"><i class="uil uil-dribbble"></i></a>
            </li>
            <li class="list-inline-item">
                <a href="javascript:void(0)"><i class="uil uil-envelope"></i></a>
            </li>
        </ul>
    </div>
</div>
<!--end sidebar-->
