<!DOCTYPE html>
<html lang="{{ $letter['locale'] ?? 'en' }}" class="{{ ($letter['locale'] ?? 'en') === 'km' ? 'locale-km' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $letter['ui']['cover_letter'] ?? 'Cover Letter' }} — {{ $letter['profile']['full_name'] ?? '' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="cover-letter-app"></div>
    <script>
        window.__COVER_LETTER__ = @json($letter);
    </script>
</body>
</html>
