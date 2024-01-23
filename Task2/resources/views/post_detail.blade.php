@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (\Session::has('success'))
            <hr />

            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif


        @if (\Session::has('error'))
            <hr />

            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif


        <div class="row box-div">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <img src="/user.png" width="70%" />
                        <h5 class="mt-3">{{ $post_info->user->name }} {{ $post_info->user->surname }}</h5>
                        <small>{{ $post_info->created_at }}</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h4>{{ $post_info->title }}</h4>
                <h5>{{ $post_info->sub_title }}</h5>
                <hr />
                <span>{!! $post_info->text !!}</span>
            </div>
            <hr class="mt-2" />


            <div class="col-12 mt-2">
                @if (Auth::check() && Auth::user()->id == $post_info->create_user_id)
                    <a href="{{ route('edit_post', [$post_info->id]) }}">
                        <button type="button" class="btn btn-warning float-start me-2">Edit</button>
                    </a>
                    <form method="POST" action="{{ route('deletePost') }}">
                        @csrf

                        <input type="hidden" name="post_id" value="{{ $post_info->id }}" />
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>
                @endif
            </div>


        </div>
        <hr />
        <h4>Comments</h4>
        @foreach ($comments as $item)
            <div class="row box-div mt-3">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <img src="/user.png" width="20%" />
                            <h5 class="mt-3">{{ $item->user->name }} {{ $item->user->surname }}</h5>
                            <small>{{ $item->created_at }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">

                    <span>{!! $item->comment !!}</span>
                </div>

                <div class="col-12 mt-3">
                    @if (Auth::check() && Auth::user()->id == $item->create_user_id)
                        <button type="button" class="btn float-start me-2 btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editCommentModal_{{ $item->id }}">Edit</button>

                        <form action="{{ route('commentDelete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentId" value="{{ $item->id }}" />
                            <input type="hidden" name="postId" value="{{ $post_info->id }}" />
                            <button type="submit" class="btn  btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="modal fade" id="editCommentModal_{{ $item->id }}" tabindex="-1"
                aria-labelledby="editCommentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCommentModalLabel">Comment Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('editComment') }}">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group mt-2">
                                    <label class="col-form-label">Content</label>
                                    <textarea name="comment">{!! $item->comment !!} </textarea>
                                </div>
                                <input type="hidden" value="{{ $item->id }}" name="comment_id" />
                                <input type="hidden" value="{{ $post_info->id }}" name="post_id" />

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Comment</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
        <hr />


        @auth

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        @if(Auth::user()->email_verified == 1)
                        <form action="{{ route('commentSave') }}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <h5>Comments</h5>
                                <textarea name="comment"> </textarea>
                            </div>
                            <input type="hidden" value="{{ $post_info->id }}" name="post_id" />
                            <button type="submit" class="btn btn-success mt-3 float-end">Comment</button>
                        </form>

                        @else

                            <div class="alert alert-info">
                                You must verify your e-mail address to comment.
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endauth

    </div>

    <style>
        .box-div {
            min-height: 250px;
            background: #f1f1f1;
            border-radius: 5px;
            border: 1px solid #cdcdcd;
            padding: 11px;
        }
    </style>

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

            function checkEditorNotification() {
                var notification = $(".tox-notification");

                if (notification.length > 0) {
                    notification.remove();
                    clearInterval(intervalId);
                }
            }

            var intervalId = setInterval(checkEditorNotification, 1000);
        });
    </script>
    <style>
        .tox-notification {
            display: none !important;
        }
    </style>
@endsection
