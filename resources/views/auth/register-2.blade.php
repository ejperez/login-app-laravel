<x-layout>
    <div class="w-full max-w-md px-6 py-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Create Username & Password (2/2)</h1>

        <div class="text-sm text-red-500 mb-4">{{ $errors->first('general') }}</div>

        <form id="registration-form" action="" method="POST">
            @csrf
            @foreach ($sessionData as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">User Name</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('name') ? 'border-red-500' : '' }}">
                <p id="name-error" class="text-xs text-red-500 pt-2">{{ $errors->first('name') }}</p>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('password') ? 'border-red-500' : '' }}">
                <p class="text-xs text-red-500 pt-2">{{ $errors->first('password') }}</p>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}">
                <p class="text-xs text-red-500 pt-2">{{ $errors->first('password_confirmation') }}</p>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mb-4">Finish</button>
            <a href="/register?backed=true"
                class="block text-center w-full bg-gray-300 py-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mb-4">Back</a>
            <div class="text-sm">Already have an account? <a class="text-blue-700" href="/">Sign in</a></div>
        </form>

        @if ($success ?? false)
            <div id="success-modal" class="fixed bg-blue-300/50 inset-0 flex items-center justify-center"
                data-redirect-to="{{ $redirectTo ?? '/' }}">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                    <p class="text-center text-xl">Successfully signed up!</p>
                    <p class="text-xs text-center">Redirecting you to the login page...</p>
                </div>
            </div>
        @endif
    </div>
</x-layout>
