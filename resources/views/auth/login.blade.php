<x-auth-split-layout>
    <div class="auth-stagger flex flex-col gap-6">
        <x-auth-split-header
            title="Welcome!"
            description="Sign in by entering the information below"
        />

        <x-auth-session-status class="auth-stagger-item mb-2 text-sm text-green-400" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="auth-stagger-item space-y-4">
            @csrf

            <div>
                <label for="email" class="auth-label">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@example.com"
                    required
                    autofocus
                    autocomplete="username"
                    class="auth-input"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="auth-label">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••••••"
                    required
                    autocomplete="current-password"
                    class="auth-input"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex cursor-pointer items-center gap-3">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 rounded-full border-neutral-600 bg-neutral-950 text-white focus:ring-neutral-500 focus:ring-offset-0"
                    />
                    <span class="text-sm font-normal text-white">Remember Me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-white hover:underline">
                        Forgotten Password
                    </a>
                @endif
            </div>

            <button type="submit" class="auth-button">
                Continue
            </button>
        </form>

        <p class="auth-stagger-item px-8 text-center text-sm text-neutral-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="auth-link">
                Create one here
            </a>.
        </p>
    </div>
</x-auth-split-layout>
