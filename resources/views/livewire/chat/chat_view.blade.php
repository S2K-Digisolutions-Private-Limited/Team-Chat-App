<?php
use App\Models\User;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state('sender', User::find(auth()->id()));
$receiver_id = request()->query('receiver');
state('receiver', null);
if (isset($receiver_id)) {
    try {
        $receiver_id = base64_decode($receiver_id);
    } catch (\Throwable $th) {
        $receiver_id = null;
    }
    state('receiver', User::find($receiver_id));
}
$close_Chat = function () {
    $this->redirectIntended('chat');
};
?>
<div class="flex flex-col flex-1 overflow-hidden">
    @if ($receiver)
        <div class="flex items-center justify-between p-4 bg-gray-200">
            <div class="flex items-center">
                <img src="https://ui-avatars.com/api/?rounded=true&name={{ $receiver->name }}" alt="{{ $receiver->name }}"
                    class="w-12 h-12 rounded-full">
                <div>
                    <span class="ml-2 text-sm font-medium">{{ $receiver->name }}</span> <br>
                    <span
                        class="ml-2 text-sm font-medium {{ $receiver->is_active ? 'text-green-500' : 'text-red-500' }}">
                        {{ $receiver->is_active ? 'Online' : 'Offline' }}
                    </span>
                </div>
            </div>
            <div class="flex items-center">
                <button class="text-red-500" wire:click="close_Chat">Close</button>
            </div>
        </div>
        <!-- Chat messages and input can be added here -->
    @else
        <div class="flex items-center justify-center p-4 py-32">
            <span class="text-gray-500">
                Welcome to Chat, {{ $sender->name }}
            </span>
        </div>
    @endif
</div>
