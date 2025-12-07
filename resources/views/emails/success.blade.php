<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبكم بنجاح</title>
</head>
<body style="font-family: 'Tajawal', sans-serif; background: #f7f7f7; padding: 20px; direction: rtl; text-align: right;">

    <div style="max-width: 700px; margin: auto; background: white; padding: 20px; border-radius: 8px;">

        <h2 style="text-align: center; color: #333;">تم إرسال طلبكم بنجاح</h2>
        <p style="text-align: center; color: #666;">فيما يلي المعطيات التي قمتم بإدخالها:</p>

        <!-- SECTION TITLE -->
        <h3 style="margin-top: 30px; color: #444;">المعلومات الشخصية</h3>

        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
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
                <tr>
                    <th style="background: #f0f0f0; width: 35%; border: 1px solid #ddd;">{{ $label }}</th>
                    <td style="border: 1px solid #ddd;">{{ $value }}</td>
                </tr>
            @endforeach

            @if(in_array($data['social_security_type'], ['cnss','cnrps']))
                <tr>
                    <th style="background: #f0f0f0; border: 1px solid #ddd;">رقم الانخراط</th>
                    <td style="border: 1px solid #ddd;">{{ $data['cnss_number'] }}</td>
                </tr>
            @endif

            @if($data['marital_status'] === 'married')
                <tr><th style="background: #f0f0f0; border:1px solid #ddd;">اسم الزوج/الزوجة</th><td style="border:1px solid #ddd;">{{ $data['spouse_name'] }}</td></tr>
                <tr><th style="background: #f0f0f0; border:1px solid #ddd;">مهنة الزوج/الزوجة</th><td style="border:1px solid #ddd;">{{ $data['spouse_profession'] }}</td></tr>
                <tr><th style="background: #f0f0f0; border:1px solid #ddd;">مكان العمل</th><td style="border:1px solid #ddd;">{{ $data['spouse_workplace'] }}</td></tr>
                <tr><th style="background: #f0f0f0; border:1px solid #ddd;">عدد الأطفال</th><td style="border:1px solid #ddd;">{{ $data['children_count'] }}</td></tr>
            @endif
        </table>

        <!-- Education -->
        <h3 style="margin-top: 30px; color: #444;">المؤهلات العلمية</h3>

        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
            @if(isset($data['degree']))
                <tr><th style="background:#f0f0f0;border:1px solid #ddd;">الشهادة</th><td style="border:1px solid #ddd;">{{ $data['degree'] }}</td></tr>
            @endif

            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">الاختصاص</th><td style="border:1px solid #ddd;">{{ $data['specialty'] }}</td></tr>
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">سنة التخرج</th><td style="border:1px solid #ddd;">{{ $data['graduation_year'] }}</td></tr>
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">قرار المعادلة</th><td style="border:1px solid #ddd;">{{ $data['equivalence_decision'] }}</td></tr>
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">تاريخ قرار المعادلة</th><td style="border:1px solid #ddd;">{{ $data['equivalence_date'] }}</td></tr>
        </table>

        <!-- Bac -->
        <h3 style="margin-top: 30px; color: #444;">نتائج الباكالوريا والدراسة</h3>

        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">معدل الباكالوريا</th><td style="border:1px solid #ddd;">{{ $data['bac_average'] }}</td></tr>
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">شعبة الباكالوريا</th><td style="border:1px solid #ddd;">{{ $data['bac_specialty'] }}</td></tr>
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">سنة الباكالوريا</th><td style="border:1px solid #ddd;">{{ $data['bac_year'] }}</td></tr>
            <tr><th style="background:#f0f0f0;border:1px solid #ddd;">المعدل النهائي في التخرج</th><td style="border:1px solid #ddd;">{{ $data['grad_average'] }}</td></tr>
        </table>

        <p style="text-align: center; margin-top: 40px; color: #888;">
            هذا البريد آلي — الرجاء عدم الرد عليه.
        </p>

    </div>

</body>
</html>

