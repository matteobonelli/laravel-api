@extends('layouts.app')
@section('content')
    <section class="container" id='projects_index'>
        <h1>{{$technology->name}}</h1>
        <ul>
            @forelse ($technology->projects as $project)
                <li>{{$project->title}}</li>
            @empty
                <li>No posts</li>
            @endforelse
        </ul>
        
    </section>
@endsection