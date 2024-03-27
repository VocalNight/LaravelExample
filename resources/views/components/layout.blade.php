<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <x-nav-dashlink href="/">home</x-nav-dashlink>
        <x-nav-dashlink href="/about">about</x-nav-dashlink>
        <x-nav-dashlink href="/contact">contact</x-nav-dashlink>
    </nav>
    
    {{$slot}}
</body>
</html>
