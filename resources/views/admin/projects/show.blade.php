@extends('layouts.app')
@section('content')
    <section class="container" id='projects_index'>
        <h1>{{$project->title}}</h1>
        <p>{{$project->description}}</p>
        <span>{{$project->category ? $project->category->name : 'Non catalogato'}}</span>
        @if($project->technologies)
        <div class="mb-3">
            <h4>Tecnologie</h4>
            @foreach ($project->technologies as $technology)
                <a class="badge rounded-pill text-bg-success" href="{{route('admin.technologies.show', $technology->slug)}}">{{$technology->name}}</a>
            @endforeach
        </div>
        @endif
        {{-- $post->category?->name --}}
    </section>
@endsection