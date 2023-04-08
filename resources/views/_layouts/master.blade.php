<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        <link rel="canonical" href="{{ $page->url }}">

        <meta name="description" content="{{ $page->description }}">

        <title>{{ $page->title }}</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <script src="{{ asset('js/app.js')}}" defer></script>
    </head>
    <body>
        <div x-data="{ cartOpen: false , isOpen: false }">
            @include('_layouts._navbar')

            @include('_layouts._cart')

            <main class="my-8">
                @yield('body')
            </main>

            @include('_layouts._footer')
        </div>
    </body>
</html>
