@php
    $user = $action['user'];
    $uniqueId = (string) Str::uuid();
@endphp
<div class="card mb-3 shadow">
    <div class="card-header" style="background-color:#F274D3">
        {{ $action['title'] }}
    </div>
    <div class="card-body" style="padding:0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 border-right">
                    <div class="row p-3 text-center">
                        <img src="" class="col-12" alt="">
                        <h5 class="col-12">{{ $user['username'] }}</h5>
                        <p class="col-12">{{ $user['onlineStatus'] }}</p>
                    </div>
                    <div class="row p-3 border-top">
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-user"></i> {{ $user['role'] }}
                            </li>
                            <li>
                                <i class="fa fa-pencil"></i> {{ $user['postCount'] }} posts
                            </li>
                            <li>
                                <i class="fa fa-sign-in"></i> {{ $user['lastLogin'] }}
                            </li>
                            <li>
                                <i class="fa fa-info-circle"></i> {{ $user['moderationType'] }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 thread-action-content">
                    {{ Form::open(['route' => ['saveThread', $subCategoryId], 'id' => 'form-'.$uniqueId]) }}
                        {{ Form::hidden('targetPostId', $targetPostId ?? '') }}
                        @if ($createThread)
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title:</span>
                                </div>
                                {{ Form::text('title', null, ['class' => 'form-control']) }}
                            </div>
                        @endif
                        {{ Form::textarea('content', null, ['class' => 'content-textarea', 'rows' => 30, 'id' => 'test']) }}
                        <div id="err-{{$uniqueId}}"></div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer" style="background-color:white; padding:0;">
        <div class="row justify-content-between">
            <div class="col">
                <button class="btn btn-light" data-dismiss="modal">&#10005;</button>
            </div>
            <div class="col">
                <div class="float-right lead">
                    <button class="btn btn-light" onclick="submitThread()">&#10003;</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var contentEditor;
    ClassicEditor
        .create(document.querySelector('.content-textarea'))
        .then(editor => {
            contentEditor = editor;
        });
    function submitThread(){
        saveThread('{{ $uniqueId }}', {{ $subCategoryId }}, contentEditor);
    }
</script>