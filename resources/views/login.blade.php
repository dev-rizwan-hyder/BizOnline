<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6">Login to your account</h2>
    <form class="space-y-6" method="post" action="{{ route('login') }}">
      <!-- Email -->
      @csrf
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input
          type="email"
          id="email"
          name="email"
          required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          placeholder="you@example.com"
        />
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          placeholder="••••••••"
        />
      </div>

      <!-- Options -->
      <div class="flex items-center justify-between">
        <label class="flex items-center text-sm">
          <input type="checkbox" class="form-checkbox text-blue-600" />
          <span class="ml-2 text-gray-700">Remember me</span>
        </label>
        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
      </div>

      <!-- Submit Button -->
      <div>
        <button
          type="submit"
          class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
        >
          Sign in
        </button>
      </div>
    </form>
  </div>
</body>
</html>
