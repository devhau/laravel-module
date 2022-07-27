<div @if($isPage) class="page-wrapper" @else class="p-3" @endif @if(getValueByKey($option,'poll','')) wire:poll.{{getValueByKey($option,'poll','')}}@endif>
    <div @if($isPage) class="page-content" @endif>
        @if($isPage)
        <div class="mb-2">
            <h4>{{$modal_title}}</h4>
        </div>
        @endif
        <div class="mb-2 d-flex flex-row">
            <div style="flex:auto">
                @if($checkAdd===true)
                <button class="btn btn-primary btn-sm" wire:openmodal='{{$viewEdit}}({"module":"{{$module}}"})'>
                    <i class="bi bi-plus-square"></i> <span>Thêm mới</span>
                </button>
                @endif
                @foreach(getValueByKey($option, 'action.append', []) as $button)
                @if (getValueByKey($button, 'type', '') == 'new')
                <button class="btn btn-sm  {{getValueByKey($button, 'class', 'btn-danger')}}" {!!getValueByKey($button,"action" , function(){})()!!}> {!!getValueByKey($button, 'icon', '')!!} <span> {{getValueByKey($button, 'title', '') }} </span></button>
                @endif
                @endforeach
            </div>
            <div style="flex:none">
                @if($checkInportExcel)
                <button class="btn btn-primary btn-sm" wire:openmodal='devhau-module::admin.table.import({"module":"{{$module}}"})'>
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    <span>Nhập excel</span>
                </button>
                @endif
                @if($checkExportExcel)
                <button class="btn btn-primary btn-sm" wire:openmodal='devhau-module::admin.table.export({"module":"{{$module}}"})'>
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    <span>Xuất excel</span>
                </button>
                @endif
            </div>
        </div>
        {!!\DevHau\Modules\Builder\Table\TableBuilder::Render($data,$option,['sort'=>$sort])!!}
        @if(isset($data)&& $data!=null)
        {{ $data->links() }}
        @endif
    </div>
</div>