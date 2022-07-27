@if($showModal)
<div wire:ignore.self class="modal fade" wire:showmodal id="{{$this->id}}Modal" tabindex="-1" aria-labelledby="{{$this->id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog {{$sizeModal}}">
        <div class="modal-content">
            @if(!$hideHeader)
            <div class="modal-header">
                @if($viewInclude['header'])
                @includeIf($viewInclude['header']);
                @else
                <h5 class="modal-title" id="{{$this->id}}ModalLabel">{{$modal_title}}</h5>
                <button type="button" class="btn-close" wire:hideModal="hideModal()" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            @endif
            <div class="modal-body">
                @includeIf($viewInclude['content'])
            </div>
            @if(!$hideFooter)
            <div class="modal-footer">
                @if($viewInclude['footer'])
                @includeIf($viewInclude['footer']);
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@else
<div>
</div>
@endif