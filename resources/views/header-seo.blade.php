<meta charset="utf-8">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--meta http-equiv="refresh" content="5; url ={{  Request::path() }} "-->
<meta http-equiv="content-language" content="{{DevHau\Modules\Theme::getContentLanguage()}}" />
<meta name="language" content="{{DevHau\Modules\Theme::getLanguage()}}">
<meta name="revisit-after" content="{{DevHau\Modules\Theme::getRevisitAfter()}}" />
<meta name="google" content="nositelinkssearchbox" />
<title>{{DevHau\Modules\Theme::getTitle()}}</title>
<meta name="title" content="{{DevHau\Modules\Theme::getTitle()}}">
<meta name="description" content="{{DevHau\Modules\Theme::getDescription()}}">
<meta name="keywords" content="{{DevHau\Modules\Theme::getKeyword()}}">
<meta name="robots" content="{{DevHau\Modules\Theme::getRobots()}}">
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{DevHau\Modules\Theme::getTitle()}}">
<meta itemprop="description" content="{{DevHau\Modules\Theme::getDescription()}}">
<meta itemprop="image" content="{{DevHau\Modules\Theme::getImage()}}">
<meta name="author" content="{{DevHau\Modules\Theme::getAuthor()}}">
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{DevHau\Modules\Theme::getTitle()}}">
<meta name="twitter:description" content="{{DevHau\Modules\Theme::getDescription()}}">
@if(DevHau\Modules\Theme::getValue('twitter:creator'))
<meta name="twitter:creator" content="@{{DevHau\Modules\Theme::getValue('twitter:creator')}}">
@endif
<meta name="twitter:image:src" content="{{DevHau\Modules\Theme::getImage()}}">
<!-- Open Graph data -->
<meta property="og:title" content="{{DevHau\Modules\Theme::getTitle()}}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{DevHau\Modules\Theme::getUrl()}}" />
<meta property="og:image" content="{{DevHau\Modules\Theme::getImage()}}" />
<meta property="og:description" content="{{DevHau\Modules\Theme::getDescription()}}" />
<meta property="og:site_name" content="{{DevHau\Modules\Theme::getTitle()}}" />
@if(DevHau\Modules\Theme::getValue('article:published_time')!='')
<meta property="article:published_time" content="{{DevHau\Modules\Theme::getValue('article:published_time')}}" />
@endif
@if(DevHau\Modules\Theme::getValue('article:modified_time')!='')
<meta property="article:modified_time" content="{{DevHau\Modules\Theme::getValue('article:modified_time')}}" />
@endif
@if(DevHau\Modules\Theme::getValue('article:section')!='')
<meta property="article:section" content="{{DevHau\Modules\Theme::getValue('article:section')}}" />
@endif
@if(DevHau\Modules\Theme::getValue('article:tag')!='')
<meta property="article:tag" content="{{DevHau\Modules\Theme::getValue('article:tag')}}" />
@endif
@if(DevHau\Modules\Theme::getValue('fb:admins')!='')
<meta property="fb:admins" content="{{DevHau\Modules\Theme::getValue('fb:admins')}}" />
@endif