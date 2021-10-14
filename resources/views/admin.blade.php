<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success_message'))
                <div class="bg-green-100 text-green-800 rounded px-4 py-2 mb-6">
                    {{ session('success_message') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl">All Appointments</h3>
                    <ul class="space-y-6 mt-4">
                        @foreach ($appointments as $appointment)
                            <li class="flex items-center justify-between">
                                <div>
                                    <span>{{ $appointment->user->name }} | </span>
                                    <span>{{ $appointment->appointment_date->format('M d, Y, h:i:s A') }}</span>
                                    @if (! $appointment->confirmed_at)
                                        <span class="bg-red-100 text-red-800 rounded-full px-4 py-1">
                                            Unconfirmed
                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-800 rounded-full px-4 py-1">
                                            Confirmed
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    @if (! $appointment->confirmed_at)
                                        <form action="{{ route('email', $appointment) }}" method="POST">
                                            @csrf
                                            <button class="border border-gray-300 hover:bg-gray-100 rounded-full px-4 py-2" type="submit">Send Email</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
