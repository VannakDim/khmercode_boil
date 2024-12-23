@extends('admin.layout.admin')
@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection
@section('main_body')
    <div class="py-12">
        <div class="mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary btn-pill mb-6 float-right" id="add-team" href="#"
                            role="button"><i class="bi bi-database-add"></i> ADD OUR TEAM </a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($teams as $team)
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-4">
                                <div class="card-img-contain"
                                    style="background-image: url({{ asset($team->image) }});"></div>
                                {{-- <img style="" class="card-img-top" src="{{ asset($service->service_icon) }}"> --}}
                                <div class="card-body">
                                    <h5 class="card-title text-primary kh-koulen">{{ $team->name }}</h5>
                                    <p class="card-text pb-3">{{ $team->position }}</p>
                                    <a href="#" class="btn btn-outline-primary edit-button"
                                        data-id={{ $team->id }}>Edit</a>
                                    <a class="btn btn-danger" href="{{ url('team/softDel/' . $team->id) }}"
                                        href="">Delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- MODAL FORM --}}
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong id="modal-title"></strong></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="edit-error" class="alert-danger" style="display: none">
                                    <ul class="mb-0"></ul>
                                </div>
                                <form id="modal-form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="edit-id" name="id">
                                    <input type="hidden" id="old-image" name="old_image">
                                    <div class="row">
                                        <div class="col-lg">
                                            <img src="" alt="" id="edit-image">
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-lg">
                                            {{-- <p class="text-muted">Image file must be less than 2mb</p> --}}
                                            <input type="file" id="edit-newimage" name="image">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>Name</label>
                                            <input type="text" id="edit-name" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>Position</label>
                                            <input type="text" id="edit-position" name="position" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>Email</label>
                                            <input type="text" id="edit-email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>Phone</label>
                                            <input type="text" id="edit-phone" name="phone" class="form-control">
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" form="modal-form">Save</button>
                            </div>
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
    <script>
        var SITEURL = '{{ URL::to('') }}' + '/';
        let isUpdate;

        $(document).ready(function() {

            $('.container').on('click', '#add-team', function() {
                isUpdate=false;
                $('#modal-title').text('ADD OUR TEAM');
                $('#modal-form')[0].reset();
                $('#edit-image').attr('src', '');
                $('#editModal').modal('show');
            });

            $('.card').on('click', '.edit-button', function() {
                isUpdate=true;
                var id = ($(this).data('id'));
                $('#edit-error').hide();

                $.ajax({
                        url: '/team/get/' + id,
                        type: 'GET',
                    })
                    .done(function(response) {
                        console.log(response.message);
                        $('#edit-id').val(id);
                        $('#old-image').val(response.team.image);
                        $('#modal-title').text('EDIT OUR TEAM');
                        $('#edit-name').val(response.team.name);
                        $('#edit-position').val(response.team.position);
                        $('#edit-email').val(response.team.email);
                        $('#edit-phone').val(response.team.phone);
                        $('#edit-image').attr('src', SITEURL + response.team.image);
                        $('#editModal').modal('show');

                    })
            });

            $('#modal-form').submit(function(e) {

                $('#edit-error').hide();
                e.preventDefault();
                const team = new FormData(this);
                
                let url = isUpdate ? '/team/update' : '/team/add';
                $.ajax({
                    url: url ,
                    method: 'POST',
                    data: team,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            $('#modal-form')[0].reset();
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            $('#edit-error').find('ul').html('');
                            $.each(response.error, function(index, val) {
                                $('#edit-error').find('ul').append('<li>' + val +
                                    '</li>');
                            })
                            $('#edit-error').show();
                            console.log(response.error);
                        }
                    }
                });
            });
        });
    </script>
@endsection