export interface CandidateData {
    tel: string;
    position: string | readonly string[] | number | undefined;
    name: string;
    gender: 'male' | 'female' | '';
    birth_date: string;
    birth_place: string;
    address: string;
    governorate: string;
    postal_code: string;
    cin: string;
    cin_date: string;
    social_security_type: 'cnss' | 'cnrps' | 'none' | '';
    cnss_number: string;
    email: string;

// Section II: Civil Status
    marital_status: string;
    military_status: string;
    spouse_name: string;
    spouse_profession: string;
    spouse_workplace: string;
    children_count: string;

// Section III: Education
    degree: string;
    specialty: string;
    graduation_year: string;
    equivalence_decision: string;
    equivalence_date: string;

// Bac Details
    bac_average: string;
    bac_specialty: string;
    bac_year: string;

    grad_average: string;
}

export const INITIAL_DATA: CandidateData = {
    name: '',
    gender: '',
    birth_date: '',
    birth_place: '',
    address: '',
    governorate: '',
    postal_code: '',
    cin: '',
    tel: '',
    cin_date: '',
    social_security_type: '',
    cnss_number: '',
    email: '',
    marital_status: '',
    military_status: '',
    spouse_name: '',
    spouse_profession: '',
    spouse_workplace: '',
    children_count: '',
    degree: '',
    specialty: '',
    graduation_year: '',
    equivalence_decision: '',
    equivalence_date: '',
    bac_average: '',
    bac_specialty: '',
    bac_year: '',
    position: "",
    grad_average: '',
};

export const TUNISIAN_GOVERNORATES = [
    "أريانة", "باجة", "بن عروس", "بنزرت", "تطاوين", "توزر", "تونس",
    "جندوبة", "زغوان", "سليانة", "سوسة", "سيدي بوزيد", "صفاقس",
    "قابس", "قبلي", "قفصة", "القصرين", "القيروان", "الكاف",
    "مدنين", "المنستير", "منوبة", "المهدية", "نابل"
];

export const BAC_SPECIALTIES = [
    { value: 'math', label: 'رياضيات' },
    { value: 'science', label: 'علوم تجريبية' },
    { value: 'tech', label: 'علوم تقنية' },
    { value: 'eco', label: 'اقتصاد وتصرف' },
    { value: 'letters', label: 'آداب' },
    { value: 'sport', label: 'رياضة' },
    { value: 'info', label: 'علوم الإعلامية' },
];
