{{-- resources/views/components/layouts/settings-no-sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? __('Settings') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; direction: rtl; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
            {{ $slot }}
    </div>
</body>
</html>