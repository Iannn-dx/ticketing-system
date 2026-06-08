<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Profile</h1>
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <div class="dash-card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="dash-card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="dash-card">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
