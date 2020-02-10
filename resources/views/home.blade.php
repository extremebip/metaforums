@extends('layouts.app')

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
@endsection

@push('scripts')
    <script src="{{asset('js/threadTable.js')}}"></script>
    <script>
        var getThreadUrl = "{{ route('getThread', 'default') }}";
        var threadTable = $('#thread-table').ThreadTable({
            url: getThreadUrl.replace('default', '{{$subCategories[0]['id']}}'),
            // autoRefresh: true,
            // refreshTime: 4000
        });
        function getThreads(subCategory_link, subCategory_id) {
            $('.subCategory-link').removeClass('active');
            subCategory_link.addClass('active');
            threadTable.url = getThreadUrl.replace('default', subCategory_id);
            threadTable.loadThreads();
        }
        $(document).ready(function () {
            getSubCategoriesByCategory($('.category-link').first(), {{$categories[0]['id']}});
            getThreads($('.subCategory-link').first(), {{$subCategories[0]['id']}});
        });
    </script>
@endpush