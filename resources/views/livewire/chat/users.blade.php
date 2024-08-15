<?php
use App\Models\User;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;
use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};
state('users', User::where('id', '!=', auth()->id())->get());
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
    if ($receiver_id) {
        $users = User::where('id', '!=', auth()->id())
            ->orderByRaw("id = $receiver_id DESC")
            ->get();
    }
    state('users', $users);
}
$change_user = function ($id) {
    $this->redirect(route('chat', ['receiver' => base64_encode($id)]), navigate: true);
};

?>
<div class="flex flex-col w-75 bg-white rounded-r-3xl overflow-hidden">
    <div class="flex items-center justify-between p-4 border-b">
        <h1 class="text-xl font-semibold">Users</h1>
        <button wire:click="logout" class="text-red-500">Logout</button>
    </div>
    <div class="flex flex-col p-1 overflow-y-auto overflow-x-hidden space-y-4">
        @foreach ($users as $user)
            <div class="flex items-center space-x-4 cursor-pointer p-1 rounded-lg hover:bg-gray-100"
                wire:click="change_user({{ $user->id }})">
                <img src="https://ui-avatars.com/api/?rounded=true&name={{ $user->name }}" alt="{{ $user->name }}"
                    class="w-12 h-12 rounded-full">
                <div>
                    <h1 class="font-semibold truncate">{{ $user->name }} </h1>
                    <span class="text-sm text-gray-500">
                        {{ substr($user->email, 0, 3) . '...' . substr($user->email, strpos($user->email, '@') - 2) }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
