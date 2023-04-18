@extends('layout.front_end')
@section('content')

    <section class="section2 section" id="blog-lists">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 blog-data">
                    <h1>{{$blog->title}}</h1>
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="" />
                    <p>{{$blog->description}}</p>
                </div>
                <div class="col-lg-4 related">
                    <h5>Related Posts</h5>
                    <ul>
                        @if(@$relatedPosts)
                            @foreach(@$relatedPosts as $post)
                                <li>
                                    <img src="{{ asset('storage/'.$post->image) }}" alt="" />
                                    <h4>{{@$post->title}}</h4>
                                    <a href="{{route('blogs.show',$post->slug)}}"></a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection