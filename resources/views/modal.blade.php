<div>
    @if($modals&&count($modals)>0)
    @foreach($modals as $item)
    @livewireModal($item['modal'],params($item['params']),modal($item['id']))
    @endforeach
    @endif
</div>