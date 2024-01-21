@extends('layouts.app')
@section('content')
    <section class="container" id='projects_index'>
        <h1>{{$category->name}}</h1>
        <ul>
            @forelse ($category->projects as $project)
            @if(Auth::id() == $project->user_id || Auth::id() == 1)
                <li>{{$project->title}}</li>
            @endif    
            @empty
                <li>No posts</li>
            @endforelse
        </ul>
        
    </section>
@endsection