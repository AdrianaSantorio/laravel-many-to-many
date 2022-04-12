@extends('layouts.app')

@section('content')
        <header>
            <div class="d-flex justify-content-between">
                <h1>Posts</h1>
                <a href="{{route('admin.posts.create')}}" class="btn btn-success m-2">Create post<i class="fa-solid fa-plus ml-2"></i></a>
            </div>
        </header>
        @if(session('message'))
            <div class="alert alert-{{ session('type') ?? 'info'}}">
                {{session('message')}}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <tr>
                        <th scope="row"> {{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>
                            @if ($post->category)
                            {{$post->category->label}}
                            @else - 
                            @endif
                        </td>
                        <td>{{$post->slug}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td class="d-flex justify-content-end align-items-center">
                            {{-- edit --}}
                            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-small btn-warning mr-2">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            {{-- delete --}}
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger mr-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            {{-- go to show --}}
                            <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-small btn-dark">
                                <i class="fa-solid fa-circle-right"></i>
                            </a>
                        </td>
                    </tr>
                </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <h3>No posts available</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
@endsection

@section('scripts')
        <script src="{{asset('js/confirm-delete.js')}}" defer></script>
@endsection