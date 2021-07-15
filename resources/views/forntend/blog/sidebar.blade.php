  @php
        $categories = App\Models\Blog\Category::latest()->get();
        $tags = App\Models\Blog\Tag::latest()->get();
  @endphp
  
  <div class="col-md-3">
                <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                    <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle"
                        data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>

                    <div class="collapse-sidebar c-scrollbar-light text-left">
                        <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                            <h3 class="h6 mb-0 fw-600">Filters</h3>
                            <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle"
                                data-target=".aiz-filter-sidebar">
                                <i class="las la-times la-2x"></i>
                            </button>
                        </div>

                        <div class="bg-white shadow-sm rounded mb-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                Search Whatever you looking for
                            </div>
                            <div class="p-3">
                                <aside id="search-2" class="widget widget_search">
                                    <form role="search" method="POST" class="search-form" action="{{route('blog.search')}}">
                                    @csrf
                                        <div class="input-group">
                                            <input type="text" class="border-0 border-lg form-control" id="post_search" name="search" placeholder="Searching for..." autocomplete="off">
                                            <div class="input-group-append d-none d-lg-block">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="la la-search la-flip-horizontal fs-18"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </aside>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm rounded mb-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                Sort by
                            </div>
                            <div class="p-3">
                                <aside id="search-2" class="widget widget_search">
                                 <div class="dropdown sort_by">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown">Sort By
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-left w-100">
                                        <li><a href="{{route('blog.latest')}}" class="dropdown-item">Latest</a></li>
                                        <li><a href="{{route('blog.show')}}" class="dropdown-item">Oldest</a></li>
                                    </ul>
                                    </div> 
                            </aside>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm rounded mb-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                Categories
                            </div>
                            <div class="p-3">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <a class="text-reset fs-14 fw-600" href="{{route('blog.show')}}">
                                            <i class="las la-angle-left"></i>
                                            All categories
                                        </a>
                                    </li>

                                    @foreach($categories as $category)

                                        <li class="ml-4 mb-2">
                                        <a class="text-reset fs-14" href="{{route('blog.category.search' , $category -> category_name_en_slug )}}">{{$category -> category_name_en}} <span class="text-bold pl-2">({{$category -> posts -> count()}})</span></a>
                                        </li>


                                    @endforeach


                                </ul>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm rounded mb-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                Filter by Tags
                            </div>
                            <div class="p-3">
                                <div class="aiz-checkbox-list">
                                <form action="{{route('blog.tag.search')}}" method="POST">
                                @csrf
                                    @foreach($tags as $tag)

                                    <label class="aiz-checkbox">
                                        <input type="checkbox" onchange="filter()" name="tags[]" value="{{ $tag -> id }}">
                                        <span class="aiz-square-check"></span>
                                        <span>{{$tag -> tag_name_en }}<span class="text-bold pl-2">({{$tag -> posts -> count()}})</span></span>
                                    </label>

                                    

                                    @endforeach
                                    <input type="Submit" value="Search" class="btn btn-sm btn-primary d-block my-3">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>