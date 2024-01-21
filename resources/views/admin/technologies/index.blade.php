@extends('layouts.app')
@section('content')
    <section class="container" id='projects_index'>
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Technology List</h1>
            <a href="{{route('admin.technologies.create')}}" class="btn btn-primary">Aggiungi Categoria</a>
        </div>
        
        <div class="row">
            @foreach ($technologies as $technology)
            <div class="col-12 col-md-4 col-lg-3 gy-3 d-flex align-items-stretch ">
                <div class="card">
                    <a href="{{route('admin.technologies.show', $technology->slug)}}">
                        <h2>{{$technology->name}}</h2>
                    </a>
                    @if (Auth::id() == 1)
                    <div class="p-3">
                        <a class="btn btn-primary my-2" href="{{route('admin.technologies.edit', $technology->slug)}}">Modifica</a>
                        <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            
        
        </div>
    </section>
@endsection