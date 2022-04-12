@extends('layouts.app')

@section('content')
        @if(session('message'))
            <div class="alert alert-{{ session('type') ?? 'info'}}">
                {{session('message')}}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h1 class="my-2">{{$post->title}}</h1>
                <div class="clearfix">
                    @if ($post->image)
                    <img src="{{$post->image}}" alt="{{$post->slug}}" class="float-left mr-2">
                    @endif
                    <p>{{$post->content}}</p>
                </div>
                {{-- actions --}}
                <div class="d-flex justify-content-end text-muted">
                    <time> {{$post->updated_at}} </time>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end my-2">
                {{-- edit --}}
                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-small btn-warning mr-2">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="delete-form">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-2">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                <a href="{{route('admin.posts.index')}}" class="btn btn-secondary ml-2">
                    <i class="fa-solid fa-circle-left"></i>
                </a>
            </div>
        </div>
@endsection

@section('scripts')
        <script src="{{asset('js/confirm-delete.js')}}" defer></script>
@endsection