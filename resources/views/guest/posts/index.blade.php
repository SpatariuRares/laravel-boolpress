@extends('layouts.dashboard')




@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4 mb-4">all Comics</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post['id'] }}</th>
                            <td>{{ $post['title'] }}</td>
                            <td>{!! $post['slug'] !!}</td>
                            <td>
                                <a href="{{ route('posts.show', $post['slug']) }}"
                                    class="btn btn-info">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection