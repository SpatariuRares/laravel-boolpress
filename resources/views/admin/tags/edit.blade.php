@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Modifica tag</h1>
                    <form action="{{route('admin.tags.update', $tag->id)}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" name="name" id="title" class="form-control" value="{{ old('name',$tag->name) }}" >
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">update</button>
                        </div>
                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection
