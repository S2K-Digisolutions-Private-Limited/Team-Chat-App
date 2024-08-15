<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat With Team Mates') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row bg-gray-100" style="max-height: 500px;">
                        <!-- Sidebar -->
                        <livewire:chat.users />
                        <!-- Content -->
                        <livewire:chat.chat_view />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
