<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ulam Sari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#FAF8F5] flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl border border-stone-200 shadow-sm space-y-6">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 bg-[#C86D3B] text-white font-bold rounded-xl flex items-center justify-center mx-auto text-lg">US</div>
            <h1 class="text-xl font-bold text-[#2D1A12]">Admin Ulam Sari</h1>
            <p class="text-xs text-stone-500">Silakan masuk menggunakan akun admin Anda</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:outline-none focus:border-[#C86D3B]" placeholder="admin@ulamsari.com" value="{{ old('email') }}">
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:outline-none focus:border-[#C86D3B]" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-[#2D1A12] text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-[#C86D3B] transition">
                Masuk ke Dashboard
            </button>
        </form>
    </div>

</body>
</html>