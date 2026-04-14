<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Valex Lost&Found')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    
    @hasSection('sidebar')
        <div class="container">
            @include('partials.sidebar')
            
            <div class="main">
                @include('partials.navbar')
                
                <div id="content">
                    @yield('content')
                </div>
                
                @include('partials.footer')
            </div>
        </div>
    @else
        @yield('content')
    @endif

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>