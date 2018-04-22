<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="{{ \App\MetaData::find(1)->keywords }}"/>
<meta name="subject" content="{{ \App\MetaData::find(1)->subject }}">
<meta name="description" content="{{ \App\MetaData::find(1)->description }}">
<meta name="author" content="Mazeyar Rezaei Ghavamabadi, info.mazeyar@gmail.com">
<meta name="designer" content="Mazeyar Rezaei, http://mazeyar.nl">
<meta name="url" content="http://fix4all.nl">
<meta property="og:locale" content="nl_NL" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Fix4all - Allround Klusbedrijf" />
<meta property="og:description" content="{{ $intro }}" />
<meta property="og:url" content="http://fix4al.nl" />
<meta property="og:site_name" content="Fix4all - Allround Klusbedrijf" />
<meta name="og:street-address" content="Wielewaallaan 4"/>
<meta name="og:image" content="{{ asset('img/LogoBlack@2x.png')  }}"/>