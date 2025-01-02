@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary btn-pill mb-6 float-right" id="add-post" href="{{ route('page.add-post') }}"
                            role="button"><i class="bi bi-database-add"></i> ADD POST </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            @foreach ($posts as $post)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-4">
                                        <div class="card-img-cover" style="background-image: url({{ asset($post->image) }});">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-primary kh-koulen">{{ $post->title }}</h5>
                                            <p class="card-text pb-3">{{ Str::limit($post->description,50) }}</p>
                                            <a href="/post/edit/{{$post->id}}" class="btn btn-outline-primary edit-button">Edit</a>
                                            <a class="btn btn-danger" href="{{ url('post/softDel/' . $post->id) }}"
                                                href="">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@endsection

@section('link')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
