<x-layout>
    <div class="w-full max-w-md px-6 py-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Hello, World!</h2>
        <div class="text-sm text-center">Welcome {{ $user->name }}! <a class="text-blue-700" href="/logout">Sign out</a></div>
    </div>
</x-layout>