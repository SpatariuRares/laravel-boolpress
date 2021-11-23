@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h3 class="mb-3">ID post: {{$post->id}}</h3>
                    <header class="mb-4">
                        <h1 class="fw bolder mb-1">{{ $post->title }}</h1>
                    </header>
                    <div class="mb-5">
                        <p class="fs-5">
                            {{ $post->content }}
                        </p>
                    </div>
                    <ul>
                        <li>
                            <a href="{{ route('admin.categories.show', $post->category['id']) }}">
                                <smal>
                                    {{  $post->category->name }}
                                </small> 
                            </a>
                        </li>
                    </ul>
                </article>
                
            </div>
        </div>
    </div>
@endsection