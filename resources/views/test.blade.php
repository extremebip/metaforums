@extends('layouts.test-layout')

@section('title', 'Test')

@section('content')
    <div class="row">
        <h2>Category</h2>
    </div>
    <div class="row">
        <h4 id="category-state">Create</h4>
    </div>
    <div class="row">
        {{ Form::open(['action' => 'TestController@saveCategory']) }}
            {{ Form::hidden('category-id', 0, ['id' => 'category-id']) }}
            <div class="form-group">
                {{ Form::text('category-name', null, ['class' => 'form-control '.($errors->has('category-name') ? 'is-invalid' : ''), 'id' => 'category-name']) }}
                @error('category-name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                <input type="reset" value="Cancel" class="btn btn-danger" id="category-reset">
            </div>
        {{ Form::close() }}
    </div>
    <div class="row">
        <table id="categories-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category["id"] }}</td>
                        <td>{{ $category["name"] }}</td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row">
        <h2>SubCategory</h2>
    </div>
    <div class="row">
        <h4 id="subcategory-state">Create</h4>
    </div>
    <div class="row">
        {{ Form::open(['action' => 'TestController@saveSubCategory']) }}
        <div class="form-group">
            {{ Form::select('subcategory-category_id', $categories_dropdown, null, ['class' => 'form-control', 'id' => 'subcategory-category_id']) }}
        </div>
        {{ Form::hidden('subcategory-id', 0, ['id' => 'subcategory-id']) }}
        <div class="form-group">
            {{ Form::text('subcategory-name', null, ['class' => 'form-control '.($errors->has('subcategory-name') ? 'is-invalid' : ''), 'id' => 'subcategory-name']) }}
            @error('subcategory-name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            <button class="btn btn-danger" type="button" id="empty-subcategory">Cancel</button>
        </div>
        {{ Form::close() }}
    </div>
    <div class="row">
        <table class="table table-bordered table-striped" id="subcategories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function getSubCategoriesDatatable(category_id = 1) {
            $.ajax({
                method: "POST",
                url: `/test/categories/${category_id}/sub-categories`,
                success: function (data) {
                    subcategories_table.clear().draw();
                    subcategories_table.rows.add(data).draw();
                }
            });
        }

        $(document).ready(function () {
            var categories_table = $('#categories-table').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' }
                ]
            });
            subcategories_table = $('#subcategories-table').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' }
                ]
            });
            getSubCategoriesDatatable();

            $('#categories-table tbody').on('click', 'tr', function () {
                var data = categories_table.row(this).data();
                $('#category-id').val(data.id);
                $('#category-name').val(data.name);
                $('#category-state').text('Update');
            });

            $('#subcategories-table tbody').on('click', 'tr', function () {
                var data = subcategories_table.row(this).data();
                $('#subcategory-id').val(data.id);
                $('#subcategory-name').val(data.name);
                $('#subcategory-state').text('Update');
            });

            $('#subcategory-category_id').change(function () {
                var category_id = $(this).val();
                getSubCategoriesDatatable(category_id);
            });

            $('#category-reset').click(function () {
                $('#category-id').val('0');
                $('#category-state').text('Create');
            });

            $('#empty-subcategory').click(function () {
                $('#subcategory-id').val('0');
                $('#subcategory-name').val('');
                $('#subcategory-state').text('Create');
            });
        });
    </script>
@endsection