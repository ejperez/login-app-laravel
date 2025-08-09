<x-layout>
    <div class="p-8 bg-white rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

        <div class="text-sm text-red-500 mb-4">{{ $errors->first('general') }}</div>

        <form action="" method="POST" class="space-y-4">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2 text-blue-600">
                <label class="text-sm select-none" for="remember">Remember me</label>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Login</button>
            <div class="text-sm">Don't have an account? <a class="text-blue-700" href="/register">Sign up</a></div>
        </form>
    </div>
</x-layout>
