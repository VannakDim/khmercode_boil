@extends('admin.layout.admin')
@section('link')
    {{-- CK Editor --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" crossorigin>
@endsection

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Edit Blog</h2>
                            </div>

                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="/post/update/{{ $post->id }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Blog title</label>
                                                <input type="text" name="title" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Blog title"
                                                    value="{{ $post->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tags">Tags:</label>
                                                <select name="tags[]" id="tags" class="form-control"
                                                    multiple="multiple">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->name }}"
                                                            @if ($post->tags->contains($tag->id)) selected @endif>
                                                            {{ $tag->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tags')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="featured">Featured</label>
                                                <input type="checkbox" name="featured" id="featured"
                                                    value="@if (true) 1 @else 0 @endif"
                                                    @if ($post->is_featured) checked @endif>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Blog image</label>
                                                <input type="file" name="image" class="form-control" style="border: rgb(209, 215, 221) 0.1px solid;">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div style="display: flex; justify-content: center; align-items: center; background-image: url({{asset($post->image)}}); background-size: cover; background-position: center; width: 100%; height: 100%;">
                                        </div>
                                            {{-- <img src="{{ asset($post->image) }}" alt="" style="width: 100%"> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Description</label>
                                                <textarea name="description" class="form-control" id="exampleInputEmail1" placeholder="Description" rows="3">{{ $post->description }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Content</label>
                                                <textarea id="editor" name="content" class="form-control" placeholder="Content" rows="5">{{ $post->content }}</textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
        
        
                                            <button type="submit" class="btn btn-primary float-right">Edit Blog</button>
                                            <a href="{{ route('all.post') }}" class="btn btn-secondary float-right"
                                                style="margin-right: 6px">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#tags').select2({
                tags: true, // Allow new tags
                placeholder: "Select or add tags",
                tokenSeparators: [',', ' ']
            });
        });
    </script>
@endsection
