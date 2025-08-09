<x-layout>
    <div class="w-full max-w-md px-6 py-8 bg-white shadow-lg rounded-lg">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold">Personal Information</h1>
            <p>Step 1 of 2</p>
        </div>

        <form id="registration-form" action="" method="POST">
            @csrf
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="first_name" name="first_name" required
                    value="{{ old('first_name', $sessionData['first_name'] ?? '') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('first_name') ? 'border-red-500' : '' }}">
                <p class="text-xs text-red-500 pt-2">{{ $errors->first('first_name') }}</p>
            </div>

            <div class="mb-4">
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name"
                    value="{{ old('middle_name', $sessionData['middle_name'] ?? '') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('middle_name') ? 'border-red-500' : '' }}">
                <p class="text-xs text-red-500 pt-2">{{ $errors->first('middle_name') }}</p>
            </div>

            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" id="surname" name="surname" required
                    value="{{ old('surname', $sessionData['surname'] ?? '') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('surname') ? 'border-red-500' : '' }}">
                <p class="text-xs text-red-500 pt-2">{{ $errors->first('surname') }}</p>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    value="{{ old('email', $sessionData['email'] ?? '') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('email') ? 'border-red-500' : '' }}">
                <p id="email-error" class="text-xs text-red-500 pt-2">{{ $errors->first('email') }}</p>
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" required
                    value="{{ old('phone_number', $sessionData['phone_number'] ?? '') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('phone_number') ? 'border-red-500' : '' }}">
                <p class="text-xs text-red-500 pt-2">{{ $errors->first('phone_number') }}</p>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mb-4">Next</button>
            <div class="text-sm">Already have an account? <a class="text-blue-700" href="/">Sign in</a></div>
        </form>
    </div>
</x-layout>
