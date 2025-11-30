<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'birth_place' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'governorate' => 'required|string|max:255',
            'postal_code' => 'required|integer|digits:4',
            'cin' => 'required|integer|digits:8',
            'cin_date' => 'required|date',
            'social_security_type' => 'required|string|in:cnss,cnrps,none',
            'cnss_number' => Rule::requiredIf(fn () => in_array($this->input('social_security_type'), ['cnss', 'cnrps'])),
            'tel' => 'required|string|max:8',
            'email' => 'required|email|max:255',
            'marital_status' => 'required|string|max:50',
            'military_status' => 'required|string|max:50',

            'spouse_name' => 'required_if:marital_status,married,|string|max:255',
            'spouse_profession' => 'required_if:marital_status,married|string|max:255',
            'spouse_workplace' => 'required_if:marital_status,married|string|max:255',
            'children_count' => 'required_if:marital_status,married|integer',

            'degree' => 'nullable|string|max:255',
            'specialty' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:2100',
            'equivalence_decision' => 'required|string|max:255',
            'equivalence_date' => 'required|date',

            'bac_average' => 'required|numeric',
            'bac_specialty' => 'required|string|max:255',
            'bac_year' => 'required|integer|min:1900|max:2100',
            'grad_average' => 'required|numeric',
        ];
    }
}
