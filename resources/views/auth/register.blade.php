<x-auth-split-layout>
    <div class="auth-stagger flex flex-col gap-6">
        <x-auth-split-header
            title="Create an account"
            description="Fill in the details below to get started"
        />

        <form method="POST" action="{{ route('register') }}" class="auth-stagger-item space-y-4">
            @csrf

            <div>
                <label for="name" class="auth-label">Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="auth-input"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="email" class="auth-label">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@example.com"
                    required
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
                    autocomplete="new-password"
                    class="auth-input"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="auth-label">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••••••"
                    required
                    autocomplete="new-password"
                    class="auth-input"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="auth-button">
                Continue
            </button>
        </form>

        <p class="auth-stagger-item px-8 text-center text-sm text-neutral-400">
            Already have an account?
            <a href="{{ route('login') }}" class="auth-link">
                Sign in here
            </a>.
        </p>
    </div>
</x-auth-split-layout>
