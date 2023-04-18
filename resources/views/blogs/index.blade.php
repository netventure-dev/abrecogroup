@extends('layout.front_end')
@section('content')

    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/blog.webp') }});">
    <img src="{{ asset('assets/front/images/blog.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>OUR</span> BLOGS</h2>
            <p>Need an expert? You are more than welcome to leave your contact info and we will be in touch shortly
            </p>
            <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
        </div>
    </section>

    <section class="section2 section" id="blog-list">
        <div class="container">
            
            @foreach($blogLists as $bloglist)
                <div class="card">
                    <div class="card__header" style="background-image: url({{ asset('storage/'.$bloglist->image) }});">
                        <span class="tag tag-blue">Technology</span>
                    </div>
                    <div class="card__body">
                        <h4>{{@$bloglist->title}}</h4>
                        <p>{!! \Illuminate\Support\Str::limit($bloglist->description, $limit = 150, $end = '...') !!}</p>
                        <span>Read More</span>
                    </div>
                    <a href="{{route('blogs.show',$bloglist->slug)}}" class="blog-link"></a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
