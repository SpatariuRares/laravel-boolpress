@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h3 class="mb-3">ID post: {{$category->id}}</h3>
                    <header class="mb-4">
                        <h1 class="fw bolder mb-1">{{ $category->name }}</h1>
                    </header>
                    <div class="mb-5">
                        <p class="fs-5">
                            {{ $category->slug }}
                        </p>
                    </div>
                    <ul>
                        @foreach ($category->posts as $post)
                            <li>
                                <a href="{{ route('admin.posts.show', $post['id']) }}">
                                    <smal>
                                        {{  $post->title . ' ' . $post->content . ' ' . $post->slug }}
                                    </small> 
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection