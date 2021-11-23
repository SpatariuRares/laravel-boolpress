@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">I tuoi dati</div>
                    <div class="card-body">
                        <div>{{ Auth::user()->name }}</div>
                        <div>{{ Auth::user()->email }}</div>
                        @if (Auth::user()->api_token)
                            <div>{{ Auth::user()->api_token }}</div>
                        @else
                            <form action="{{ route('admin.generate-token')}}" method="post">
                                @csrf
                                @method('POST')
                    
                                <button type="submit" class="btn btn-primary">Genera il Token</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection