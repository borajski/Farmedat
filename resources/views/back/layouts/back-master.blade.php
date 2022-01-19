<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>AgroCon v2.0</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  <!-- Our Custom CSS -->
     <link rel="stylesheet" href="{{ asset('css/style-backend.css') }}">
@yield('css_before')
<script src="{{ asset('js/app.js') }}"></script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
@yield('js_before')
</head>

<body>

<div class="wrapper">
@include('back.layouts.partials.sidebar')
<!-- Page Content  -->
<div id="content">
@include('back.layouts.partials.header')
@include('back.layouts.partials.sessions')
@yield('content')
</div>
</div>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#sidebarCollapse').on('click', function () {
              $('#sidebar').toggleClass('active');
              $('#content').toggleClass('active');
              });
      });
  </script>
  @yield('js_after')
</body>

</html>
