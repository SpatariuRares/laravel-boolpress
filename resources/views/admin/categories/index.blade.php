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
            <h1 class="mt-4 mb-4">all categories</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">slug</th>
                        <th scope="col">post</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category['id'] }}</th>
                            <td>{{ $category['name'] }}</td>
                            <td>{!! $category['slug'] !!}</td>
                            <td>
                                @if (count($category->posts)!==0)
                                    {{$category->posts->first()->title}}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category['id']) }}"
                                    class="btn btn-info">
                                    Details
                                </a>
                                <a href="{{ route('admin.categories.edit', $category['id']) }}"
                                    class="btn btn-warning">
                                    Modify
                                </a>
                                <form class="d-inline" method="post" onclick="return confirm('Qesta azione è irreversibile!!! Sei sicuro di voler cancellare?')" action="{{ route('admin.categories.destroy', $category['id']) }}">
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
    <div>
        <a href="{{ route('admin.categories.create') }}"
            class="btn btn-success">
            create
        </a>
    </div>
    
</div>
@endsection