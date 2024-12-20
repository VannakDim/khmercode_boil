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
                            <div class="card-header card-header-border-bottom" style="display: flex; justify-content:space-between">
                                <h2 class="kh-koulen" style="font-weight: 700">EDIT PAGE "ABOUT"</h2>
                                <div>
                                    <a href="{{ route('all.about') }}" class="btn btn-secondary align-right">BACK</a>
                                    <button type="submit" class="btn btn-primary align-right">SAVE</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="{{ $abouts->id }}">
                                <form action="{{ url('about/update/' . $abouts->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $abouts->image }}">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="card" style="padding: 10px">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="exampleInputFile">
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">About title</label>
                                                    <input type="text" name="title" class="form-control"
                                                        value="{{ $abouts->title }}" id="exampleInputEmail1" placeholder="About title">
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card">
                                                <img src="{{ asset($abouts->image) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short description</label>
                                        <input type="text" name="short_description" class="form-control"
                                            value="{{ $abouts->short_description }}" id="exampleInputEmail1"
                                            placeholder="Short description">
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Long description</label>
                                        <textarea rows="3" name="long_description" class="form-control" placeholder="Long description">{{ $abouts->long_description }}</textarea>
                                        @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">About Item</label>
                                        <select multiple class="form-control" id="exampleFormControlSelect2">
                                            @foreach ($items as $item)
                                                <option>{{ $item->about_item }}</option>
                                            @endforeach
                                        </select>
                                        <a class="btn btn-sm btn-success edit-btn mt-2" href="/about-item-page">Edit items</a>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">More description</label>
                                        <div class="editor-container editor-container_classic-editor" id="editor-container">
                                            <div class="editor-container__editor">
                                                <textarea id="editor" name="more_description" class="form-control" placeholder="More description">{{ $abouts->more_description }}</textarea>
                                            </div>
                                        </div>

                                        @error('more_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Save</button>
                                    <a href="{{ route('all.about') }}" class="btn btn-secondary float-right"
                                        style="margin-right: 6px">Back</a>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.umd.js" crossorigin></script>
    <script src="https://cdn.ckbox.io/ckbox/2.6.1/ckbox.js" crossorigin></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    {{-- <script>
        const editorConfig = {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    '|',
                    'link',
                    'insertImage',
                    'ckbox',
                    'mediaEmbed',
                    'insertTable',
                    'blockQuote',
                    '|',
                    'bulletedList',
                    'numberedList',
                    'todoList',
                    'outdent',
                    'indent'
                ],
                shouldNotGroupWhenFull: false
            },
            plugins: [
                Autoformat,
                AutoImage,
                Autosave,
                BlockQuote,
                Bold,
                CKBox,
                CKBoxImageEdit,
                CloudServices,
                Essentials,
                Heading,
                ImageBlock,
                ImageCaption,
                ImageInline,
                ImageInsert,
                ImageInsertViaUrl,
                ImageResize,
                ImageStyle,
                ImageTextAlternative,
                ImageToolbar,
                ImageUpload,
                Indent,
                IndentBlock,
                Italic,
                Link,
                LinkImage,
                List,
                ListProperties,
                MediaEmbed,
                Paragraph,
                PasteFromOffice,
                PictureEditing,
                Table,
                TableCaption,
                TableCellProperties,
                TableColumnResize,
                TableProperties,
                TableToolbar,
                TextTransformation,
                TodoList,
                Underline
            ],
            cloudServices: {
                tokenUrl: CLOUD_SERVICES_TOKEN_URL
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    },

                ]
            },
            image: {
                toolbar: [
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageStyle:inline',
                    'imageStyle:wrapText',
                    'imageStyle:breakText',
                    '|',
                    'resizeImage',
                    '|',
                    'ckboxImageEdit'
                ]
            },

            licenseKey: LICENSE_KEY,
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                decorators: {
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            placeholder: 'Your description here',
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
            }
        };
        configUpdateAlert(editorConfig);
    </script> --}}
@endsection
