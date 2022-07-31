<div x-data="{ module_name:  @entangle('module_name').defer }">
    <div class="mb-3 p-1">
        <label for="module_name" class="form-label">Tên Module</label>
        <input  x-model="module_name"  wire:model.defer="module_name" type="text" class="form-control" id="module_name" placeholder="name module">
    </div>
    <div class="form-control text-warning fw-bold fs-6" style="background-color: rgb(56, 43, 95);">
        php artisan module:make <span x-text="module_name"></span>
    </div>
    <div class="text-center p-1"><button class="btn btn-primary btn-sm" wire:click="DoCreate()">Tạo module</button></div>
</div>