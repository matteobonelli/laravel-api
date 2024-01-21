@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="my-3">Crea Tecnologia</h1>
        <form action="{{route('admin.technologies.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" id="name"
                    required maxlength="200" minlength="3" value="{{old('name')}}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </form>
    </section>
@endsection