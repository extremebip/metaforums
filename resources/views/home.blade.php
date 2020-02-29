@extends('layouts.app')

@section('style')
    <style>
        .list-unstyled {
            margin-bottom: 0;
        }

        .ck-content {
            min-height: 150px;
        }

        .thread-action-content {
            padding: 0;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <h5 class="legend"><span><strong>Site</strong></span></h5>
        Currently Active Users: 1
    </div>
    <div class="row">
        <table class="table table-striped mt-3" id="thread-table">
        </table>
    </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#threadModal">
    Launch demo modal
</button>

<div class="modal" id="threadModal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header" style="padding-bottom: 0">
                <div class="container-fluid">
                    <div class="row">
                        <h5 class="legend"><span><strong>Thread in : RPG</strong></span></h5>
                    </div>
                    <div class="row">
                        <h3>This is a very long thread title that you won't probably read to the end</h3>
                    </div>
                    <div class="row">
                        <p>
                            Hello World 
                            <br> 
                            <i class="fa fa-history"></i> Test 
                        </p>
                    </div>
                </div>
            </div> --}}
            <div class="modal-body">
                {{-- <div class="card mb-3 shadow">
                    <div class="card-header" style="background-color:#49BFBE">
                        Main post
                    </div>
                    <div class="card-body" style="padding:0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2 border-right" style="">
                                    <div class="row p-3 text-center">
                                        <img src="" class="col-12" alt="">
                                        <h5 class="col-12">Author</h5>
                                        <p class="col-12">Online</p>
                                    </div>
                                    <div class="row p-3 border-top">
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="fa fa-user"></i> User
                                            </li>
                                            <li>
                                                <i class="fa fa-pencil"></i> 3 posts
                                            </li>
                                            <li>
                                                <i class="fa fa-sign-in"></i> 56 minutes ago
                                            </li>
                                            <li>
                                                <i class="fa fa-info-circle"></i> Active
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-10 p-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis autem quas similique dolor eveniet architecto. Animi harum eveniet voluptas autem, nemo possimus ex quos, sunt reiciendis tempore cum perspiciatis assumenda!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:white">
                        <div class="row justify-content-between">
                            <div class="col">
                                <i class="fa fa-heart"></i>
                                3 users favorited this post
                            </div>
                            <div class="col">
                                <div class="float-right">Hello</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-3">
                    <div class="card-header" style="background-color:#49BFBE">
                        Main post
                    </div>
                    <div class="card-body" style="padding:0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2 border-right" style="">
                                    <div class="row p-3 text-center">
                                        <img src="" class="col-12" alt="">
                                        <h5 class="col-12">Author</h5>
                                        <p class="col-12">Online</p>
                                    </div>
                                    <div class="row p-3 border-top">
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="fa fa-user"></i> User
                                            </li>
                                            <li>
                                                <i class="fa fa-pencil"></i> 3 posts
                                            </li>
                                            <li>
                                                <i class="fa fa-sign-in"></i> 56 minutes ago
                                            </li>
                                            <li>
                                                <i class="fa fa-info-circle"></i> Active
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-10 p-3">Sama</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:white">
                        <div class="row justify-content-between">
                            <div class="col">
                                <i class="fa fa-heart"></i>
                                3 users favorited this post
                            </div>
                            <div class="col">
                                <div class="float-right">Hello</div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('js/threadTable.js')}}"></script>
    <script>
        let getThreadUrl = "{{ route('getThread', 'default') }}";
        let createThreadUrl = "{{ route('createThread', 'default') }}";
        let saveThreadUrl = "{{ route('saveThread', 'default') }}";
        var threadTable = $('#thread-table').ThreadTable({
            url: getThreadUrl.replace('default', '{{$subCategories[0]['id']}}'),
            showCreate: {{ ($showCreate) ? "true" : "false" }},
            canCreate: {{ ($canCreate) ? "true" : "false" }},
            // autoRefresh: true,
            // refreshTime: 4000,
        });
        function getThreads(subCategory_link, subCategory_id) {
            $('.subCategory-link').removeClass('active');
            subCategory_link.addClass('active');
            threadTable.url = getThreadUrl.replace('default', subCategory_id);
            threadTable.loadThreads();
        }
        function createThread() {
            var subcategory_id = $('.subCategory-link.active').data('subcategory');
            $.ajax({
                url: createThreadUrl.replace('default', subcategory_id),
                method: 'GET',
                success: function (component) {
                    $('.modal-content').html(`
                        <div class="modal-body">
                            ${component}
                        </div>
                    `);
                }
            });
        }
        function saveThread(actionId, subCategoryId, editor) {
            var form = $(`#form-${actionId}`);
            var data = formArrayToObject(form.serializeArray());
            data['content'] = editor.getData();
            $.ajax({
                method: 'POST',
                url: saveThreadUrl.replace('default', subCategoryId),
                contentType: 'application/json; charset=utf-8',
                data: JSON.stringify(data),
                success: function (result) {
                    $('#threadModal').modal('hide');
                    $('.modal-content').html('');
                    threadTable.getThreads();
                },
                error: function (error) {
                    if (error.status == ErrorCode.UNPROCESSABLE_ENTITY){
                        var errors = getErrorMessageFromResponse(error);
                        $(`#err-${actionId}`).html('');
                        for (var field in errors){
                            $(`#err-${actionId}`).append(`
                                <div class="text-danger">
                                    * ${errors[field]}
                                </div>
                            `);
                        }
                    }
                }
            });
        }
        $(document).ready(function () {
            $('#threadModal').on('hidden.bs.modal', function () {
                $('.modal-content').html('');
            });
            getSubCategoriesByCategory($('.category-link').first(), {{$categories[0]['id']}});
            getThreads($('.subCategory-link').first(), {{$subCategories[0]['id']}});
        });
    </script>
@endpush