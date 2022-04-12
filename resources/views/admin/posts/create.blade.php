@extends('layouts.app')

@section('content')
    <header>
        <h1>Create Post</h1>
    </header>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('admin.posts.store')}}" method="POST" novalidate>
        @csrf
        <div class="row">
            <div class="col-9">        
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="post title" value="{{old('title')}}" required>
                </div>
            </div>
            <div class="col-3">        
                <div class="form-group">
                    <label for="category">Post category</label>
                    <select class="form-control" id="category" name="category_id" value="{{old('category_id')}}" >
                        <option value="">---</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>{{$category->label}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="content">Post text</label>
                    <textarea class="form-control" id="content" name="content" rows="10">{{old('content')}}</textarea>
                </div>
            </div>
            <div class="col-11">
                <div class="form-group">
                    <label for="image">Post image</label>
                    <input type="url" class="form-control" name="image" id="image" value="{{old('image')}}">
                </div>
            </div>
            <div class="col-1">
                <img src="https://media.istockphoto.com/vectors/thumbnail-image-vector-graphic-vector-id1147544807?k=20&m=1147544807&s=612x612&w=0&h=pBhz1dkwsCMq37Udtp9sfxbjaMl27JUapoyYpQm0anc=" alt="placeholder" class="img-fluid" id="preview">
            </div>
            <div class="col-12">
                <div class="form-group">
                    @foreach($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="tag-{{$tag->id}}}}" value="{{$tag->id}}" name="tags[]" @if(in_array($tag->id, old('tags', []))) checked @endif>
                        <label class="form-check-label" for="tag-{{$tag->id}}}}">{{$tag->label}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class=" col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Post</button>
            </div>
        </div>
        
    </form>
@endsection

@section('scripts')
    <script src="{{asset('js/image-preview.js')}}" defer>

    </script>
@endsection