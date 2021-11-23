@extends('layouts.dashboard')


@section('content')
<div class="container">
    @if (session('updated'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('updated') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('inserted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('inserted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('deleted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4 mb-4">all post</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">slug</th>
                        <th scope="col">cattegory</th>
                        <th scope="col">tag</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post['id'] }}</th>
                            <td>{{ $post['title'] }}</td>
                            <td>{!! $post['slug'] !!}</td>
                            <td  scope="row">
                                @if ($post->category)
                                    {{$post->category->name}}
                                @endif
                            </td>
                            <td  scope="row">
                                @if ($post->tags)
                                    @foreach ($post->tags as $tag)
                                        @if ($loop->last)
                                            {{$tag->name}}
                                        @else
                                            {{$tag->name.', '}}
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', $post['id']) }}"
                                    class="btn btn-info">
                                    Details
                                </a>
                                <a href="{{ route('admin.posts.edit', $post['id']) }}"
                                    class="btn btn-warning">
                                    Modify
                                </a>
                                <form class="d-inline" method="post" onclick="return confirm('Qesta azione è irreversibile!!! Sei sicuro di voler cancellare?')" action="{{ route('admin.posts.destroy', $post['id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection