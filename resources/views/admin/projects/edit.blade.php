@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="my-3">Edita Progetto</h1>
        <form action="{{route('admin.projects.update', $project->slug)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required maxlength="200" minlength="3" value="{{old('title', $project->title)}}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id">Seleziona Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option value="">Seleziona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{old('category_id', $project->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <h6>Seleziona Tecnologie</h6>
                    @foreach ($technologies as $technology)
                        <div class="form-check @error('technologies') is-invalid @enderror">
                            @if($errors->any())
                            <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}" {{ in_array($technology->id, old('technologies', $project->technologies)) ? 'checked' : '' }}>
                            @else
                            <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}" {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                            @endif
                            <label class="form-check-label">
                                {{$technology->name}}
                            </label>
                        </div>
                    @endforeach
                    @error('technologies')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                      cols="30" rows="10">{{old('description', $project->description)}}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            
                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" value={{old('image', $project->image)}}
                        >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <div class="mb-3">
                <label for="creation_date">Data creazione</label>
                <input type="date" class="form-control @error('creation_date') is-invalid @enderror" name="creation_date" id="creation_date" value={{old('creation_date', $project->creation_date)}}
                    >
                @error('creation_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </form>
    </section>
@endsection