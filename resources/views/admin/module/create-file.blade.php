<div x-data="{ file_type:  @entangle('file_type').defer,file_name:@entangle('file_name').defer }">
    <div class="mb-3 p-1">
        <label for="file_type" class="form-label">File Type</label>
        <select x-model="file_type" wire:model.defer="file_type" class="form-select" id="file_type">
            @foreach($array_type as $item)
            <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3 p-1">
        <label for="file_name" class="form-label">Tên File</label>
        <input x-model="file_name" wire:model.defer="file_name" type="text" class="form-control" id="file_name" placeholder="name file">
    </div>
    <div class="form-control text-warning fw-bold fs-6" style="background-color: rgb(56, 43, 95);">
        php artisan module:make-<span x-text="file_type"></span>  <span x-text="file_name"></span> {{$module_name}}
    </div>

    <div class="text-center p-1 mt-1"><button class="btn btn-primary btn-sm" wire:click="DoCreate()">Tạo File</button></div>
</div>