@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Vista Create Post</h1>
                    <form action="{{route('admin.categories.store')}}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" name="name" id="title" class="form-control"  value="{{ old('name')}}">
                            @error('title')
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