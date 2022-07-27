<div class="{{$isPage?'page-login':'modal-login'}} p-3 w-100 m-auto">
    <form wire:submit.prevent="submit">
        <h1 class="h3 mb-3 text-center fw-normal">Login</h1>
        <div class="form-floating mb-3">
            <input type="email" wire:model.lazy="email" class="form-control" placeholder="name@example.com">
            @error('email') <span class="error">{{ $message }}</span> @enderror
            <label>Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" wire:model.lazy="password" class="form-control" placeholder="Password">
            @error('password') <span class="error">{{ $message }}</span> @enderror

            <label>Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" wire:model.lazy="isRememberMe" value="true"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
</div>
@push('styles')
<style>
    .page-login {
        max-width: 400px;
        padding-top: 80px !important;
    }

    .page-login form {
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 20px 0px rgb(0 0 0 / 10%);
        -moz-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0 3px 20px 0px rgb(0 0 0 / 10%);
        -o-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
@push('scripts')
<script>
</script>
@endpush