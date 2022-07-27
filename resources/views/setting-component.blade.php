<div class="border p-2 rounded-1 border-primary">
    <div class="mb-2">
        @if($viewInclude['content'])
        @includeIf($viewInclude['content'])
        @else
        {!!\DevHau\Modules\Builder\Form\FormBuilder::Render($this,$option,false)!!}
        @endif
    </div>
    <div class="my-2">
        <button wire:click="doSave()" class="btn btn-primary btn-sm"><i class="bi bi-gear"></i> <span>Save Setting</span></button>
    </div>
</div>