<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'position' => 'required|numeric|exists:positions,code',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:500',
            'governorate' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|numeric|digits:4',
            'cin' => 'required|numeric|digits:8|unique:applications,cin',
            'cin_date' => 'required|date',
            'tel' => 'required|string|max:8',
            'email' => 'required|email|max:255|unique:applications,email',

            'degree' => 'nullable|string|max:255',
            'specialty' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:2100',
            'equivalence_decision' => 'nullable:string|max:255',
            'equivalence_date' => 'required_with:equivalence_decision|nullable|date',
            'agreement' => 'accepted',

            'bac_average' => 'required|numeric|max:20|min:9',
            'grad_average' => 'required|numeric|max:20|min:9',
        ];
    }

    public function messages()
    {
        return [
            'position.required' => 'حقل الخطة الوظيفية إلزامي.',
            'position.numeric' => 'قيمة الخطة الوظيفية يجب أن تكون رقمًا.',
            'position.exists' => 'الخطة الوظيفية المختارة غير موجودة.',

            'name.required' => 'حقل الاسم إلزامي.',
            'name.string' => 'الاسم يجب أن يكون نصاً.',
            'name.max' => 'الاسم يجب ألا يتجاوز 255 حرفاً.',

            'gender.required' => 'حقل الجنس إلزامي.',
            'gender.string' => 'الجنس يجب أن يكون نصاً.',
            'gender.max' => 'الجنس يجب ألا يتجاوز 10 أحرف.',

            'birth_date.required' => 'حقل تاريخ الولادة إلزامي.',
            'birth_date.date' => 'تاريخ الولادة غير صالح.',

            'birth_place.required' => 'حقل مكان الولادة إلزامي.',
            'birth_place.string' => 'مكان الولادة يجب أن يكون نصاً.',
            'birth_place.max' => 'مكان الولادة يجب ألا يتجاوز 255 حرفاً.',

            'address.required' => 'حقل العنوان إلزامي.',
            'address.string' => 'العنوان يجب أن يكون نصاً.',
            'address.max' => 'العنوان يجب ألا يتجاوز 500 حرفاً.',

            'governorate.required' => 'حقل الولاية إلزامي.',
            'governorate.string' => 'الولاية يجب أن تكون نصاً.',
            'governorate.max' => 'الولاية يجب ألا تتجاوز 255 حرفاً.',

            'postal_code.required' => 'حقل الرمز البريدي إلزامي.',
            'postal_code.integer' => 'الرمز البريدي يجب أن يكون رقماً.',
            'postal_code.digits' => 'الرمز البريدي يجب أن يحتوي على 4 أرقام.',

            'cin.required' => 'حقل رقم بطاقة التعريف الوطنية إلزامي.',
            'cin.unique' => 'تم استعمال رقم بطاقة التعريف من قبل',
            'agreement.accepted' => 'يجب المصادقة على صحة البيانات',
            'cin.integer' => 'رقم بطاقة التعريف يجب أن يكون رقماً.',
            'cin.digits' => 'رقم بطاقة التعريف يجب أن يحتوي على 8 أرقام.',

            'cin_date.required' => 'حقل تاريخ إصدار بطاقة التعريف إلزامي.',
            'cin_date.date' => 'تاريخ إصدار بطاقة التعريف غير صالح.',

            'tel.required' => 'رقم الهاتف إلزامي.',
            'tel.string' => 'رقم الهاتف يجب أن يكون نصاً.',
            'tel.max' => 'رقم الهاتف يجب ألا يتجاوز 8 أرقام.',
            'grad_average.max' => 'المعدل التخرج يجب الا يتجاوز 20',
            'grad_average.min' => 'معدل التخرج يجب الا يقل عن 9',
            'bac_average.min' => 'معدل الباكالوريا يجب الا يقل عن 9',
            'bac_average.max' => 'معدل الباكالوريا يجب الا يتجاوز عن 20',

            'email.required' => 'البريد الإلكتروني إلزامي.',
            'email.email' => 'صيغة البريد الإلكتروني غير صالحة.',
            'email.max' => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرفاً.',
            'email.unique' => 'تم استعمال البريد الالكتروني من قبل',

            'degree.string' => 'الشهـادة يجب أن تكون نصاً.',
            'degree.max' => 'الشهـادة يجب ألا تتجاوز 255 حرفاً.',

            'specialty.required' => 'الاختصاص إلزامي.',
            'specialty.string' => 'الاختصاص يجب أن يكون نصاً.',
            'specialty.max' => 'الاختصاص يجب ألا يتجاوز 255 حرفاً.',

            'graduation_year.required' => 'سنة التخرج إلزامية.',
            'graduation_year.integer' => 'سنة التخرج يجب أن تكون رقماً.',
            'graduation_year.min' => 'سنة التخرج لا يمكن أن تكون أقل من 1900.',
            'graduation_year.max' => 'سنة التخرج لا يمكن أن تتجاوز 2100.',

            'equivalence_decision.string' => 'قرار المعادلة يجب أن يكون نصاً.',
            'equivalence_decision.max' => 'قرار المعادلة يجب ألا يتجاوز 255 حرفاً.',

            'equivalence_date.required_with' => 'تاريخ المعادلة إلزامي.',
            'equivalence_date.date' => 'تاريخ المعادلة غير صالح.',

            'bac_average.required' => 'معدل البكالوريا إلزامي.',
            'bac_average.numeric' => 'معدل البكالوريا يجب أن يكون رقماً.',

            'grad_average.required' => 'معدل التخرج إلزامي.',
            'grad_average.numeric' => 'معدل التخرج يجب أن يكون رقماً.',
        ];
    }
}
