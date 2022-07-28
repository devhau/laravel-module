<div @if($isPage) class="page-wrapper page-setting" @else class="p-3 page-setting" @endif>
    <div @if($isPage) class="page-content" @endif>
        @if($isPage)
        <div class="mb-2">
            <h4>{{$modal_title}}</h4>
        </div>
        @endif
        <div class="row tab-wrapper">
            <div class="col-3">
                <div class="list-group">
                    @foreach($settings as $item)
                    <a href="#" data-tab-key="{{$item['key']}}" class="tab-item {{$item['key']==$settingKey?'active':''}} list-group-item list-group-item-action" aria-current="true">
                        <div>{!!getValueByKey($item,'icon','<i class="bi bi-gear"></i>')!!} <span>{{$item['name']}}</span></div>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-9">
                @foreach($settings as $item)
                <div class="tab-content {{$item['key']==$settingKey?'active':''}} form-setting">
                    @livewire($item['key'],['setting'=>$item['params']])
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>