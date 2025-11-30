<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم إرسال النموذج بنجاح</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-xl p-8 max-w-md text-center">

    <!-- Icon -->
    <div class="flex items-center justify-center w-20 h-20 mx-auto bg-green-100 rounded-full mb-4">
        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
        </svg>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-bold text-gray-800 mb-2">
        تم إرسال النموذج بنجاح!
    </h1>

    <!-- Message -->
    <p class="text-gray-600 mb-6">
        شكرًا لك! تم استلام معلوماتك وسنقوم بمراجعتها والرد عليك قريبًا.
    </p>

    @if (session('email'))
        <div class="bg-gray-50 border p-4 rounded-lg mb-4">
            <p class="text-gray-700">
                <strong>البريد الإلكتروني:</strong>
            </p>
            <div dir="ltr" class="bg-white p-2 mt-1 rounded text-left break-all">
                {{ session('email') }}
            </div>
        </div>
    @endif

    <!-- Password -->
    @if (session('password'))
        <div class="bg-gray-50 border p-4 rounded-lg mb-6">
            <p class="text-gray-700">
                <strong>كلمة المرور:</strong>
            </p>
            <div dir="ltr" class="bg-white p-2 mt-1 rounded text-left break-all">
                {{ session('password') }}
            </div>
        </div>
    @endif

    <!-- Button -->
    <a href="/"
       class="inline-block px-6 py-3 text-white bg-green-600 hover:bg-green-700 rounded-lg transition">
        العودة إلى الصفحة الرئيسية
    </a>

</div>

</body>
</html>

