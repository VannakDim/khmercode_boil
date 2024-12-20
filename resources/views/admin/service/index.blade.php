@extends('admin.layout.admin')
@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('main_body')
<div class="py-12">
    <div class="mx-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <a class="btn btn-primary btn-pill mb-6 float-right" id="add-task" href="{{ route('add.service')}}" role="button"><i class="bi bi-database-add"></i> ADD SERVICE </a>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- @show --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Service title</th>
                                <th scope="col">Service description</th>
                                <th scope="col">Service icon</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <th scope="row">{{ $services->firstItem() + $loop->index }}</th>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->short_description }}</td>
                                    <td><img style="height: 50px" src="{{ asset($service->service_icon) }}" alt="{{ $service->service_icon }}"></td>
                                    <td>{{ $service->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ url('service/edit/' . $service->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ url('service/softDel/' . $service->id) }}"
                                            href="">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $services->links() }}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection