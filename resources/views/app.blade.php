<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('images/creative-icon.png')}}" type="image/icon type">
        @routes
		@vite
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,200&display=swap" rel="stylesheet">
        <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://creativestitches.store",
      "logo": "{{asset('images/creative-stitches-logo.png')}}"
    }

        </script>
    </head>
	<body class="font-raleway bg-stone-50">
		@inertia
	</body>
</html>
