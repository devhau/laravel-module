<!-- DevHau/Core Styles -->
@if(file_exists($distPathCore."devhau-module.css"))
        <style>{!! file_get_contents($distPathCore."devhau-module.css") !!}</style>
@endif
@foreach(\DevHau\Modules\Theme::css() as $item)
@if($item&&file_exists($distPathCore.$item))
<style>{!! file_get_contents($distPathCore.$item) !!}</style>
@elseif($item&&file_exists($item))
<style>{!! file_get_contents($distPathCore.$item) !!}</style>
@elseif($item)
<link rel="stylesheet" type="text/css" href="{{$item}}"/>
@endif
@endforeach
@if(\DevHau\Modules\Theme::isTurbo()&&file_exists($distPathCore."devhau-turbolinks.js"))
        <script>{!! file_get_contents($distPathCore."devhau-turbolinks.js") !!}</script>
@endif