<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <title>{{ @$page_title }}</title>
    @include('admin.partials.styles')
</head>
<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @if ($page_type == 'Admin')
                @include('admin.layouts.header')
                @include('admin.layouts.sidebar')
            @endif


            @yield('content')


            @if ($page_type == 'Admin')
                @include('admin.layouts.footer')
            @endif


        </div>
    </div>

    @include('admin.partials.scripts')
</body>

</html>
