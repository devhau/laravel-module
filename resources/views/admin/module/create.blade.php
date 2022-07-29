<div>
    <div class="mb-3 p-1">
        <label for="module_name" class="form-label">Tên Module</label>
        <input wire:model.defer="module_name" type="text" class="form-control" id="module_name" placeholder="name module">
    </div>
    <div class="text-center p-1"><button class="btn btn-primary btn-sm" wire:click="DoCreate()">Tạo module</button></div>
</div>