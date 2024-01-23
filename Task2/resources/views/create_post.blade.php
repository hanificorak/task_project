@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h3>Create Post</h3>
        <hr />
        <form action="{{ route('create_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="col-form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" required />
            </div>
            <div class="form-group">
                <label class="col-form-label">Sub Title</label>
                <input type="text" class="form-control" placeholder="Sub title" name="sub_title" required />
            </div>
            <div class="form-group mt-2">
                <label class="col-form-label">Content</label>
                <textarea name="content"> </textarea>
            </div>
            <hr />
            <button type="submit" class="btn btn-success float-end">Save & Share</button>
        </form>

        @if (\Session::has('error'))
            <hr />

            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: 'textarea',
                plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [{
                        value: 'First.Name',
                        title: 'First Name'
                    },
                    {
                        value: 'Email',
                        title: 'Email'
                    },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                    "See docs to implement AI Assistant")),
            });
        });
    </script>
@endsection
