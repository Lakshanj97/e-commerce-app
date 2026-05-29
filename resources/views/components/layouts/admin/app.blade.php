<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- <x-common.customer.navbar /> --}}

    <main>
        {{ $slot }}
    </main>

</body>
</html>