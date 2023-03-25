<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <Link href="{{ route('users.index') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                    Back</Link>

                    <x-splade-form method="PATCH" :action="route('users.update', $users)" :default="$users" class="my-4">
                        <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus />
                        <x-splade-input id="email" type="email" name="email" :label="__('Email')" required />
                        <x-splade-select name="roles" :label="__('Roles')" :options="$roles" :placeholder="__('Roles')" />
                        <x-splade-submit class="my-3" />
                    </x-splade-form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>