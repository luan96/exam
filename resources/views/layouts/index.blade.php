<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.head')
</head>
<body>
@include('partials.nav')

<div class="content text-center">
  <div class="row content">
    @yield('content')

    @include('partials.col-sm-2')
  </div>
</div>

@include('partials.footer')

</body>
</html>