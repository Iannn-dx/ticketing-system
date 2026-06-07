<x-auth-split-layout>
    <div class="auth-stagger flex flex-col gap-6">
        <x-auth-split-header
            title="Forgot password?"
            description="Enter your email and we'll send you a reset link"
        />

        <x-auth-session-status class="auth-stagger-item mb-2 text-sm text-green-400" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="auth-stagger-item space-y-4">
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

            <button type="submit" class="auth-button">
                Continue
            </button>
        </form>

        <p class="auth-stagger-item px-8 text-center text-sm text-neutral-400">
            Remember your password?
            <a href="{{ route('login') }}" class="auth-link">
                Back to sign in
            </a>.
        </p>
    </div>
</x-auth-split-layout>
