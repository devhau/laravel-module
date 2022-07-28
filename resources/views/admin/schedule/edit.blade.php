<div class="p-2">
    <div class="row mb-4 mt-2">
        <div class="col">
            <select wire:model="command" class="form-select" @if($dataId>0) disabled @endif>
                @foreach($commands as $item)
                <option value="{{$item['name']}}">{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <div class="p-2 text-white rounded" style="background-color: rgb(56, 43, 95);">
                {{$commandChoose['signature']}}
            </div>
        </div>
    </div>
    <div class="p-2 bg-light">{!!$commandChoose['description']!!}</div>
    @if (count($commandChoose['arguments'])>0)
    <div class="">
        <span class="fw-bold">Arguments:</span>
        @foreach ($commandChoose['arguments'] as $arg)
        <div class="row">
            <div class="col-8">{{$arg['name']}}</div>
            <div class="col-4">Data type</div>
            <div class="col-8">
                <input class="form-control" wire:model.defer="params.{{ $loop->index }}.value" />
            </div>
            <div class="col-4">
                <select class="form-select" wire:model.defer="params.{{ $loop->index }}.type">
                    <option value="string">String</option>
                    <option value="function">Function</option>
                </select>
            </div>
        </div>
        <div>ATTENTION: parameters of the type 'function' are executed before the execution of the scheduling and its return is passed as parameter. Use with care, it can break your job</div>
        @endforeach
    </div>
    @endif
    <div class="row my-2">
        <div class="col-3 fw-bold"><a href="https://crontab.cronhub.io/" target="_blank">Cron</a> Expression</div>
        <div class="col-9">
            <input wire:model.defer="expression" class="form-control text-warning fw-bold fs-6" style="background-color: rgb(56, 43, 95);" />
        </div>
    </div>
    <div class="row my-2">
        <div class="col-3 fw-bold">Email for sending output</div>
        <div class="col-9">
            <input class="form-control" wire:model.defer="email_output" />
        </div>
    </div>
    <div class="row my-2">
        <div class="col-3 fw-bold">Url Before</div>
        <div class="col-9">
            <input class="form-control" wire:model.defer="webhook_before" />
        </div>
    </div>
    <div class="row my-2">
        <div class="col-3 fw-bold">Url After</div>
        <div class="col-9">
            <input class="form-control" wire:model.defer="webhook_after" />
        </div>
    </div>
    <div class="row my-2">
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="sendmail_error" id="sendmail_error">
                <label class="form-check-label" for="sendmail_error">
                    Send email in case of failure to execute the command
                </label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="even_in_maintenance_mode" id="even_in_maintenance_mode">
                <label class="form-check-label" for="even_in_maintenance_mode">
                    Even in maintenance mode
                </label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="without_overlapping" id="without_overlapping">
                <label class="form-check-label" for="without_overlapping">
                    Without overlapping
                </label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="on_one_server" id="on_one_server">
                <label class="form-check-label" for="on_one_server">
                    Execute scheduling only on one server
                </label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="status" id="status">
                <label class="form-check-label" for="status">
                    Status
                </label>
            </div>
        </div>
    </div>
</div>
<div class="text-center pt-1">
    <button class="btn btn-primary btn-sm" type="submit">
        <i class="bi bi-download"></i> <span>Save</span>
    </button>
</div>