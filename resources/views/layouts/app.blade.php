<!DOCTYPE html>
<html lang="fr">
<head>
@include('partials.styles')
</head>
<body>

@include('partials.header')
@include('partials.navbar')

<main>
    @include('partials.breadcrumb')
    @yield('content')
</main>

@include('partials.footer')
@include('partials.chatbot')
@include('partials.scripts')
</body>
</html>
