<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <div id="app"></div>

    <!-- Vue.js 및 애플리케이션의 JavaScript 파일 -->
    {{-- @if (in_array($theme, ['theme1', 'theme2', 'theme_1024', 'basic', 'basic_vertical']) )
    <script src='{{ asset(mix("/themes/{$theme}/js/app.js", "/modules/{$deviceType}")) }}'></script>
    @else
        <script src='{{ asset(mix("/js/app.js", "/modules/{$deviceType}/themes/{$theme}")) }}'></script>
    @endif --}}
    {{-- <script src="{{ asset(mix('themes/theme2/js/test.js')) }}"></script> --}}
    {{-- <script src="{{ asset(mix('themes/theme2/js/app.js')) }}"></script> --}}
    {{-- <script src="{{ asset(mix('js/test/test.js')) }}"></script> --}}
    {{-- <script src="/pos/themes/theme2/js/test.js"></script> --}}
    <script src="/pos/themes/theme2/js/app.js"></script>

</body>
</html>
