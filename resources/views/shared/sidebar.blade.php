<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" id="category-content">
              @foreach ($categories as $category)
                  <li class="nav-item">
                    <div class="nav-link category-link" onclick="getSubCategoriesByCategory($(this), {{$category['id']}})">{{$category['name']}}</div>
                  </li>
              @endforeach
            </ul>
          </div>
        </nav>
        <nav class="col-md-2 d-none d-md-block bg-light sidebar" style="margin-left:213px;">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              @foreach ($subCategories as $subCategory)
                <li class="nav-item">
                  <div class="nav-link subCategory-link category-{{$subCategory['category_id']}}" onclick="getThreads($(this), {{$subCategory['id']}})" style="display:none;">{{$subCategory['name']}}</div>
                </li>
              @endforeach
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-8 ml-sm-auto mt-3" style="margin-left:426px!important">
            @yield('content')
        </main>
    </div>
</div>

@prepend('scripts')
<script>
    function getSubCategoriesByCategory(category_link, category_id) {
      $('.subCategory-link').hide();
      $(`.category-${category_id}`).show();
      $('.category-link').removeClass('active');
      category_link.addClass('active');
    }
</script>
@endprepend