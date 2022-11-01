<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">

<head>
  @include(backpack_view('inc.head'))

</head>

<body class="{{ config('backpack.base.body_class') }}">

  @include(backpack_view('inc.main_header'))

  <div class="app-body">

    @include(backpack_view('inc.sidebar'))

    <main class="main pt-2">

       @yield('before_breadcrumbs_widgets')

       @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))

       @yield('after_breadcrumbs_widgets')

       @yield('header')

        <div class="container-fluid animated fadeIn">

          @yield('before_content_widgets')

          @yield('content')
          
          @yield('after_content_widgets')

        </div>

    </main>

  </div>{{-- ./app-body --}}

  <footer class="{{ config('backpack.base.footer_class') }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3258144106657369"
     crossorigin="anonymous"></script>
<!-- ads_Side -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3258144106657369"
     data-ad-slot="8812111908"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    @include(backpack_view('inc.footer'))
  </footer>

  @yield('before_scripts')
  @stack('before_scripts')

  @include(backpack_view('inc.scripts'))

  @yield('after_scripts')
  @stack('after_scripts')
</body>
</html>