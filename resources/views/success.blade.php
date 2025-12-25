
@php
    $data = session('data') ?? [];
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبكم بنجاح</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }

        /* 🖨️ إعدادات الطباعة */
        @media print {

            /* إخفاء زر الطباعة والعودة */
            .no-print {
                display: none !important;
            }

            /* تصغير حجم النص قليلاً لتلاؤم المحتوى */
            body {
                font-size: 12px !important;
                background: white !important;
            }

            /* تقليل الهوامش */
            @page {
                margin: 10mm;
            }

            /* تقليل المسافات */
            h2, h3 {
                margin-top: 5px !important;
                margin-bottom: 5px !important;
            }

            table th, table td {
                padding: 4px 6px !important;
            }
            .goog {
                display: none;
            }
        }
    </style>

</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto px-4 py-10">

    <!-- زر الطباعة -->
    <div class="text-center mb-6 no-print">
        <button onclick="window.print()"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
            🖨️ طباعة
        </button>
    </div>

    <div class="text-center goog mb-10">
        <h2 class="text-3xl font-bold text-gray-800">تم إرسال طلبكم بنجاح</h2>
        <p class="text-gray-500 mt-2">طباعة استمارة الترشح وامضائها لتضمينها
            بالملف الورقي في صورة قبول المترشح في
            الفرز الأولي.</p>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-md rounded-lg p-6">

        <!-- Personal Info -->
        <h3 class="text-xl font-semibold text-gray-700 mb-4">المعلومات الشخصية</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right border border-gray-200 rounded-lg bg-white">
                <tbody class="divide-y divide-gray-200">

                @php
                    $rows = [
                        'رمز المناظرة المزمع المشاركة فيها' => $data['position'],
                        'اسم ولقب' => $data['name'],
                        'الجنس' => $data['gender'],
                        'تاريخ الولادة' => $data['birth_date'],
                        'العنوان الحالي' => $data['address'],
                        'الولاية' => $data['governorate'],
                        'الرقم البريدي' => $data['postal_code'],
                        'رقم بطاقة التعريف' => $data['cin'],
                        'تاريخ إصدار بطاقة التعريف' => $data['cin_date'],
                        'الهاتف' => $data['tel'],
                        'البريد الإلكتروني' => $data['email'],
                    ];
                @endphp

                @foreach($rows as $label => $value)
                    <tr class="hover:bg-gray-50">
                        <th class="py-3 px-4 font-medium text-gray-700 w-1/3 bg-gray-100">{{ $label }}</th>
                        <td class="py-3 px-4 text-gray-800">{{ $value }}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>

        <!-- Education -->
        <h3 class="text-xl font-semibold text-gray-700 mt-10 mb-4">المستوى التعليمي</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right border border-gray-200 rounded-lg bg-white">
                <tbody class="divide-y divide-gray-200">

                @if(isset($data['degree']))
                    <tr><th class="py-3 px-4 bg-gray-100">الشهادة</th><td class="py-3 px-4">{{ $data['degree'] }}</td></tr>
                @endif

                <tr><th class="py-3 px-4 bg-gray-100">الاختصاص</th><td class="py-3 px-4">{{ $data['specialty'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">سنة التخرج</th><td class="py-3 px-4">{{ $data['graduation_year'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">قرار المعادلة</th><td class="py-3 px-4">{{ $data['equivalence_decision'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">تاريخ قرار المعادلة</th><td class="py-3 px-4">{{ $data['equivalence_date'] }}</td></tr>

                </tbody>
            </table>
        </div>

        <!-- Bac -->
        <h3 class="text-xl font-semibold text-gray-700 mt-10 mb-4">نتائج</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right border border-gray-200 rounded-lg bg-white">
                <tbody class="divide-y divide-gray-200">

                <tr><th class="py-3 px-4 bg-gray-100">معدل الباكالوريا</th><td class="py-3 px-4">{{ $data['bac_average'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">معدل سنة التخرج</th><td class="py-3 px-4">{{ $data['grad_average'] }}</td></tr>

                </tbody>
            </table>
        </div>
        <div class="mt-12 flex justify-start">
    <div class="w-1/2 border-2 border-dashed border-gray-400 p-6 text-center">
        <p class="text-gray-700 font-semibold mb-12">الإمضاء</p>
    </div>
</div>

    </div>

</div>

</body>
</html>
