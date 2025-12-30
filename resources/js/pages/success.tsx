import React from 'react'
import { Head } from '@inertiajs/react'

export default function Success({ data = {} }) {
  const personalRows = {
    'رمز المناظرة المزمع المشاركة فيها': data.position.concat(" - ", data.position_name),
    'الاسم واللقب': data.name,
    'الجنس': data.gender,
    'تاريخ الولادة': data.birth_date,
    'العنوان الحالي': data.address,
    'المعتمدية': data.city,
    'الولاية': data.governorate,
    'الترقيم البريدي': data.postal_code,
    'رقم بطاقة التعريف الوطنية': data.cin,
    'تاريخ إصدار بطاقة التعريف الوطنية': data.cin_date,
    'رقم الهاتف الجوال': data.tel,
    'البريد الإلكتروني': data.email,
  }

  return (
    <div lang="ar" dir="rtl" className="bg-gray-100 min-h-screen">
      <Head title="تم استلام طلبكم بنجاح" />

      {/* Print Button */}
      <div className="text-center mb-6 no-print pt-10">
        <button
          onClick={() => window.print()}
          className="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-semibold"
        >
          🖨️ طباعة
        </button>
      </div>

      <div className="max-w-5xl text-gray-800 mx-auto px-4 pb-10">

        <div className="text-center goog mb-10">
          <h2 className="text-3xl font-bold text-gray-800">
            تم إرسال طلبكم بنجاح
          </h2>
          <p className="text-gray-500 mt-2">
            طباعة استمارة الترشح وامضائها لتضمينها بالملف الورقي
            في صورة قبول المترشح في الفرز الأولي.
          </p>
        </div>

        {/* Card */}
        <div className="bg-white shadow-md rounded-lg p-6 relative">
        <div className="absolute top-6 left-6 border-2 border-gray-800 px-4 py-2 text-center font-semibold text-gray-800 bg-white">
            رقم التسجيل: {data.id}
        </div>
        <div className="absolute top-6 right-6 border-2 border-gray-800 px-4 py-2 text-center font-semibold text-gray-800 bg-white">
            مجموع النقاط: {data.score}
        </div>

            <h2 class="text-3xl mb-2 font-bold text-center">استمارة الترشح </h2>
            <h2 class="text-base mb-2 font-bold text-center">المناظرة الخارجية للمركز الوطني للتكوين المستمر والترقية المهنية</h2>

          {/* Personal Info */}
          <h3 className="text-xl font-semibold text-gray-700 mb-4">
            المعلومات الشخصية
          </h3>

          <table className="w-full text-right border border-gray-200 rounded-lg bg-white">
            <tbody className="divide-y divide-gray-200">
              {Object.entries(personalRows).map(([label, value]) => (
                <tr key={label} className="hover:bg-gray-50">
                  <th className="py-1 px-4 font-medium text-gray-700 w-1/3 bg-gray-100">
                    {label}
                  </th>
                  <td className="py-1 px-4 text-gray-800">
                    {value ?? ''}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>

          {/* Education */}
          <h3 className="text-xl font-semibold text-gray-700 mt-5 mb-4">
            المستوى التعليمي
          </h3>

          <table className="w-full text-right border border-gray-200 rounded-lg bg-white">
            <tbody className="divide-y divide-gray-200">
              {data.degree && (
                <tr>
                  <th className="py-1 px-4 bg-gray-100">الشهادة العلمية</th>
                  <td className="py-1 px-4">{data.degree}</td>
                </tr>
              )}
              <tr>
                <th className="py-1 px-4 bg-gray-100">الاختصاص</th>
                <td className="py-1 px-4">{data.specialty}</td>
              </tr>
              <tr>
                <th className="py-1 px-4 bg-gray-100">سنة التخرج</th>
                <td className="py-1 px-4">{data.graduation_year}</td>
              </tr>
              <tr>
                <th className="py-1 px-4 bg-gray-100">قرار وتاريخ المعادلة</th>
                <td className="py-1 px-4">{data.equivalence_decision} - {data.equivalence_date}</td>
              </tr>
            </tbody>
          </table>

          {/* Results */}
          <h3 className="text-xl font-semibold text-gray-700 mt-5 mb-4">المعدلات المطلوبة</h3>

          <table className="w-full text-right border border-gray-200 rounded-lg bg-white">
            <tbody className="divide-y divide-gray-200">
              <tr>
                <th className="py-1 px-4 font-bold bg-gray-100">معدل البكالوريا</th>
                <td className="py-1 px-4">{data.bac_average}</td>
                <th className="py-1 px-4 font-bold bg-gray-100">معدل سنة التخرج</th>
                <td className="py-1 px-4">{data.grad_average}</td>
              </tr>
            </tbody>
          </table>

          {/* Signature */}
          <div className="mt-12 flex justify-start">
            <div className="w-1/2 border-2 border-dashed border-gray-400 p-6 text-center">
              <p className="text-gray-700 font-semibold mb-12">الإمضاء</p>
            </div>
          </div>

        </div>
      </div>

      {/* Print styles */}
      <style>{`
        @media print {
          .no-print, .goog {
            display: none !important;
          }

          body {
            font-size: 12px !important;
            background: white !important;
          }

          @page {
            margin: 10mm;
          }
        }
        th {
            font-weight:500;
        }
      `}</style>
    </div>
  )
}

