<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    @if (Session::get('fail'))
        <div class="alert alert-danger">{!! Session::get('fail') !!}</div>
    @endif

    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Reset Password</h2>
            <form method="POST" autocomplete="off" novalidate wire:submit.prevent="ResetHandler()">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Enter email or username" wire:model="email" disabled>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        New Password
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control"  placeholder="New password" wire:model="new_password">
                        <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                        </a>
                        </span>
                    </div>
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">
                    Confirm Password
                    </label>
                    <div class="input-group input-group-flat">
                    <input type="password" class="form-control" placeholder="Confirm Your password" wire:model="confirm_new_password">
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                        </a>
                    </span>
                    </div>
                    @error('confirm_new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-check">
                        <a href="{{ route('author.login') }}">Back to login page</a>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
