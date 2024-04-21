<?php

use App\Models\Channel;
use App\Models\User;

use function Livewire\Volt\mount;
use function Livewire\Volt\state;
use function Livewire\Volt\title;

state(['channel', 'channels', 'users', 'subscribers']);

mount(function (Channel $channel) {
    $this->channels = Channel::all();
    $this->users = User::orderBy('name')->get();
    $this->subscribers = $this->channel->getSubscribers();
});

title(fn () => "#{$this->channel->name}");

?>

<div
    class="flex w-full rounded-lg bg-fuchsia-800"
    style="height: calc(100vh - 40px)"
>
    <!-- Channels -->
    <div class="shrink-0 overflow-y-scroll rounded-l-lg bg-sidebar">
        <div class="flex h-14 items-center gap-x-32 border-b p-4">
            <h1 class="text-xl font-bold">Laravel</h1>

            <x-icons.pencil class="h-6 w-6 text-gray-500" />
        </div>

        <div class="flex flex-col gap-y-6 p-2 text-lg text-gray-700">
            <ul class="flex flex-col gap-y-3">
                <li class="flex items-center gap-x-2 rounded-md px-4 py-1">
                    <x-icons.message class="h-6 w-6 text-gray-700" />

                    Threads
                </li>

                <li class="flex items-center gap-x-2 rounded-md px-4 py-1">
                    <x-icons.airplane class="h-6 w-6 text-gray-700" />

                    Drafts & sent
                </li>
            </ul>

            <ul
                class="flex flex-col gap-y-2"
                x-data="{ open: true }"
            >
                <li>
                    <button
                        @click="open = !open"
                        class="flex w-full items-center gap-x-2 rounded-md px-4 py-1 hover:bg-white/30"
                    >
                        <x-icons.chevron-down class="h-3 w-3 text-gray-700" />

                        Channels
                    </button>
                </li>

                <li>
                    <ul x-cloak x-show="open">
                        @foreach ($channels as $sidebar)
                            <li>
                                <a
                                    href="{{ route("workspace", $sidebar) }}"
                                    class="{{ $channel->name === $sidebar->name ? "bg-fuchsia-900 text-white" : "" }} flex items-center gap-x-2 rounded-md px-4 py-1 hover:bg-fuchsia-900 hover:text-white"
                                >
                                    <x-icons.hashtag
                                        class="text:inherit h-4 w-4"
                                    />

                                    {{ $sidebar->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <ul
                class="flex flex-col gap-y-2"
                x-data="{ open: true }"
            >
                <li>
                    <button
                        @click="open = !open"
                        class="flex w-full items-center gap-x-2 rounded-md px-4 py-1 hover:bg-white/30"
                    >
                        <x-icons.chevron-down class="h-3 w-3 text-gray-700" />

                        Direct messages
                    </button>
                </li>

                <li>
                    @include('components.users')
                </li>
            </ul>
        </div>
    </div>

    <div class="flex w-full flex-col rounded-r-lg bg-white">
        <div class="flex h-14 items-center justify-between border-b p-3">
            <h1 class="text-xl font-bold"># {{ $channel->name }}</h1>

            <div class="flex rounded border p-1" wire:ignore>
                <div class="flex items-center -space-x-1">
                    @foreach ($subscribers->take(3) as $subscriber)
                        <img
                            src="{{ $subscriber->avatar }}"
                            alt="{{ $subscriber->name }}"
                            class="h-5 w-5 rounded-md border border-white"
                        />
                    @endforeach
                </div>

                <span class="px-2">{{ $subscribers->count() }}</span>
            </div>
        </div>

        <!-- Channel -->
        <livewire:channel :channel="$channel" />
    </div>
</div>