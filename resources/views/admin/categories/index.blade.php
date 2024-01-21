@extends('layouts.app')
@section('content')
    <section class="container" id='projects_index'>
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Category List</h1>
            <a href="{{route('admin.categories.create')}}" class="btn btn-primary">Aggiungi Categoria</a>
        </div>
        
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-12 col-md-4 col-lg-3 gy-3 d-flex align-items-stretch ">
                <div class="card">
                    <a href="{{route('admin.categories.show', $category->slug)}}">
                        <h2>{{$category->name}}</h2>
                    </a>
                    <div class="p-3">
                        <a class="btn btn-primary my-2" href="{{route('admin.categories.edit', $category->slug)}}">Modifica</a>
                        <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
        
        </div>
    </section>
@endsection