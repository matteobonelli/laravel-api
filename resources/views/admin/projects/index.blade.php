@extends('layouts.app')
@section('content')
    <section class="container" id='projects_index'>
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Projects List</h1>
            <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Aggiungi Progetto</a>
        </div>
        
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-12 col-md-4 col-lg-3 gy-3 d-flex align-items-stretch ">
                <div class="card">
                    <a href="{{route('admin.projects.show', $project->slug)}}">
                        <img src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}">
                    </a>
                    <div class="p-3">
                        <h2>{{$project->title}}</h2>
                        <p>{{$project->description}}</p>
                        <h6>{{$project->creation_date}}</h6>
                        <a class="btn btn-primary my-2" href="{{route('admin.projects.edit', $project->slug)}}">Modifica</a>
                        <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
        
        </div>
        {{$projects->links('vendor.pagination.bootstrap-5')}}
    </section>
@endsection