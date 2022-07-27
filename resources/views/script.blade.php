<!-- DevHau/Core Scripts -->
@if(file_exists($distPathCore."devhau-module.js"))
        <script>{!! file_get_contents($distPathCore."devhau-module.js") !!}</script>
@endif
@foreach(\DevHau\Modules\Theme::js() as $item)
@if($item&&file_exists($distPathCore.$item))
        <script>{!! file_get_contents($distPathCore.$item) !!}</script>
@elseif($item&&file_exists($item))
        <script>{!! file_get_contents($item) !!}</script>
@elseif($item)
<script src="{{$item}}"></script>
@endif
@endforeach
@livewire('devhau-module::modal-builder')