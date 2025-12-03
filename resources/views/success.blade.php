
@php
    $data = session('data') ?? [];
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبكم بنجاح</title>

    <!-- Tailwind CDN (remove if you are using Vite build) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto px-4 py-10">

    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">تم إرسال طلبكم بنجاح</h2>
        <p class="text-gray-500 mt-2">فيما يلي المعطيات التي قمتم بإدخالها:</p>
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
                        'المنصب' => $data['position'],
                        'الاسم الكامل' => $data['name'],
                        'الجنس' => $data['gender'],
                        'تاريخ الولادة' => $data['birth_date'],
                        'مكان الولادة' => $data['birth_place'],
                        'العنوان' => $data['address'],
                        'الولاية' => $data['governorate'],
                        'الرمز البريدي' => $data['postal_code'],
                        'رقم بطاقة التعريف' => $data['cin'],
                        'تاريخ إصدار بطاقة التعريف' => $data['cin_date'],
                        'نوع التغطية الاجتماعية' => $data['social_security_type'],
                        'الهاتف' => $data['tel'],
                        'البريد الإلكتروني' => $data['email'],
                        'الحالة المدنية' => $data['marital_status'],
                        'الوضعية العسكرية' => $data['military_status'],
                    ];
                @endphp

                @foreach($rows as $label => $value)
                    <tr class="hover:bg-gray-50">
                        <th class="py-3 px-4 font-medium text-gray-700 w-1/3 bg-gray-100">{{ $label }}</th>
                        <td class="py-3 px-4 text-gray-800">{{ $value }}</td>
                    </tr>
                @endforeach

                @if(in_array($data['social_security_type'], ['cnss','cnrps']))
                    <tr>
                        <th class="py-3 px-4 bg-gray-100">رقم الانخراط</th>
                        <td class="py-3 px-4">{{ $data['cnss_number'] }}</td>
                    </tr>
                @endif

                @if($data['marital_status'] === 'married')
                    <tr><th class="py-3 px-4 bg-gray-100">اسم الزوج/الزوجة</th><td class="py-3 px-4">{{ $data['spouse_name'] }}</td></tr>
                    <tr><th class="py-3 px-4 bg-gray-100">مهنة الزوج/الزوجة</th><td class="py-3 px-4">{{ $data['spouse_profession'] }}</td></tr>
                    <tr><th class="py-3 px-4 bg-gray-100">مكان العمل</th><td class="py-3 px-4">{{ $data['spouse_workplace'] }}</td></tr>
                    <tr><th class="py-3 px-4 bg-gray-100">عدد الأطفال</th><td class="py-3 px-4">{{ $data['children_count'] }}</td></tr>
                @endif

                </tbody>
            </table>
        </div>

        <!-- Education -->
        <h3 class="text-xl font-semibold text-gray-700 mt-10 mb-4">المؤهلات العلمية</h3>

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
        <h3 class="text-xl font-semibold text-gray-700 mt-10 mb-4">نتائج الباكالوريا والدراسة</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right border border-gray-200 rounded-lg bg-white">
                <tbody class="divide-y divide-gray-200">

                <tr><th class="py-3 px-4 bg-gray-100">معدل الباكالوريا</th><td class="py-3 px-4">{{ $data['bac_average'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">شعبة الباكالوريا</th><td class="py-3 px-4">{{ $data['bac_specialty'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">سنة الباكالوريا</th><td class="py-3 px-4">{{ $data['bac_year'] }}</td></tr>
                <tr><th class="py-3 px-4 bg-gray-100">المعدل النهائي في التخرج</th><td class="py-3 px-4">{{ $data['grad_average'] }}</td></tr>

                </tbody>
            </table>
        </div>

    </div>

    <div class="text-center mt-8">
        <a href="{{ url('/') }}"
           class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
            العودة إلى الصفحة الرئيسية
        </a>
    </div>

</div>

</body>
</html>
