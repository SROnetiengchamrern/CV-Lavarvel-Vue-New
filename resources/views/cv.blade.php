<!DOCTYPE html>
<html lang="{{ $cv['locale'] ?? 'en' }}" class="{{ ($cv['locale'] ?? 'en') === 'km' ? 'locale-km' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $cv['profile']['full_name'] ?? 'CV' }} — {{ $cv['profile']['title'] ?? 'Web Developer' }}</title>
    <meta name="description" content="Curriculum Vitae of {{ $cv['profile']['full_name'] ?? 'Tieng Chamrern' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="cv-app"></div>
    <script>
        window.__CV_DATA__ = @json($cv);
    </script>
</body>
</html>
