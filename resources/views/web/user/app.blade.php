<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Blog</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('web/user/assets/favicon.ico') }}" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="{{ asset('web/user/css/styles.css') }}" rel="stylesheet" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  @stack('head_links')
</head>
<body>

  @include('web.user.template.header')

  @yield('content')

  @include('web.user.template.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{ asset('web/user/js/scripts.js') }}"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    @if(\Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
    @endif
    @if(\Session::has('failed'))
      toastr.error("{{ Session::get('failed') }}");
    @endif
    @if($errors->any())
      toastr.error("{{$errors->first()}}");
    @endif
  </script>
  @stack('body_scripts')
</body>
</html>

