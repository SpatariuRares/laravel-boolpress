@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Vista Create Post</h1>
                    <form action="{{route('admin.posts.store')}}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input value="{{old('title')}}" type="text" name="title" id="title" class="form-control">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea type="text" name="content" id="content" class="form-control">{{old('content')}}</textarea>
                            @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-6">
                                <p>seleziona i tag</p>
                                @foreach($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        @if ($errors->any())
                                            <input 
                                            {{in_array($tag->id,old('tags',[])) ? 'checked' : null}}
                                            value="{{ $tag->id }}" type="checkbox" name="tags[]" class="form-check-input" id="{{'tag' . $tag->id}}">
                                            <label class="form-check-label" for="{{'tag' . $tag->id}}">{{ $tag->name }}</label>
                                        @else
                                            <input value="{{$tag->id}}" type="checkbox" name="tags[]" id="{{"tag".$tag->id}}" class="form-check-input">
                                            <label  class="form-check-label" for="{{"tag".$tag->id}}">{!! $tag->name !!}</label>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group col-6">
                                <label for="newTags">new tags</label>
                                <input value="{{old('newTags')}}" type="text" name="newTags" id="newTags" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">-- Seleziona la categoria --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : null }}
                                        >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Crea post</button>
                        </div>
                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection