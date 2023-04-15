<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('images/creative-icon.png')}}" type="image/icon type">
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PSM8B6M');</script>
        <!-- End Google Tag Manager -->
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
        <meta name="p:domain_verify" content="2aba52881f7228dc87a241df3217dedc"/>
        <script src="https://www.dwin1.com/45943.js" type="text/javascript" defer="defer"></script>

    </head>

	<body class="font-raleway bg-stone-50">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PSM8B6M"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

		@inertia
	</body>
</html>
