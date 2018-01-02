
<!DOCTYPE html>
<html lang="zh-CN">
@include('layout.header')
<body>

@include('layout.nav')

<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        @yield('content')
        @include('layout.sidebar')
    </div>    <!-- /.row -->
</div><!-- /.container -->

@include('layout.footer')

</body>
</html>
