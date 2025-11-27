import React, { useState, useCallback, useEffect } from 'react';
import { CandidateData, INITIAL_DATA, TUNISIAN_GOVERNORATES, BAC_SPECIALTIES } from './types';
import { InputGroup, SelectGroup } from './InputGroup';
import { SectionHeader } from './SectionHeader';
import { Check, Send, Mail, Clock, AlertTriangle, XCircle, CheckCircle, Info } from 'lucide-react';
import { db, StoredCandidate, Position, ScoreConfig } from './utils/storage';
import { Form } from '@inertiajs/react';

export const RecruitmentForm: React.FC = (deadlineDate) => {
    const [data, setData] = useState<CandidateData>(INITIAL_DATA);
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [savedCandidate, setSavedCandidate] = useState<StoredCandidate | null>(null);

    // Position Validation State

    // Config State
    const [scoreConfig, setScoreConfig] = useState<ScoreConfig | null>(null);

    // Countdown State
    const [deadline] = useState<Date>(() => {
        return new Date(deadlineDate.deadlineDate);
    });

    const [timeLeft, setTimeLeft] = useState({
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0,
        isExpired: false
    });


    useEffect(() => {
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const distance = deadline.getTime() - now;

            if (distance < 0) {
                clearInterval(timer);
                setTimeLeft(prev => ({ ...prev, isExpired: true }));
            } else {
                setTimeLeft({
                    days: Math.floor(distance / (1000 * 60 * 60 * 24)),
                    hours: Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                    minutes: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                    seconds: Math.floor((distance % (1000 * 60)) / 1000),
                    isExpired: false
                });
            }
        }, 1000);

        return () => clearInterval(timer);
    }, [deadline]);


    const handleChange = useCallback((e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value } = e.target;
        setData((prev) => ({ ...prev, [name]: value }));
    }, []);

    const handleSocialTypeChange = useCallback((e: React.ChangeEvent<HTMLInputElement>) => {
        const value = e.target.value as any;
        setData(prev => ({
            ...prev,
            socialSecurityType: value,
            cnssNumber: value === 'none' ? '' : prev.cnssNumber
        }));
    }, []);

    return (
        <Form  action="/apply" method={"POST"} className="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            {/* Header */}
            <div className="bg-gradient-to-l from-primary-800 to-primary-600 p-8 text-white text-center">
                <h1 className="text-3xl font-extrabold mb-2">استمارة الترشح</h1>
                <p className="opacity-90">يرجى ملء جميع البيانات بدقة وعناية</p>
            </div>

            {/* Deadline Countdown Banner */}
            <div className={`p-4 border-b flex flex-col md:flex-row items-center justify-between gap-4 transition-colors ${timeLeft.isExpired ? 'bg-red-50 border-red-200' : 'bg-orange-50 border-orange-200'}`}>
                <div className="flex items-center gap-3">
                    <div className={`p-3 rounded-full ${timeLeft.isExpired ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600'}`}>
                        {timeLeft.isExpired ? <AlertTriangle size={24} /> : <Clock size={24} />}
                    </div>
                    <div>
                        <p className={`text-sm font-bold ${timeLeft.isExpired ? 'text-red-800' : 'text-orange-800'}`}>
                            {timeLeft.isExpired ? 'انتهت فترة التسجيل' : 'تاريخ غلق باب الترشحات'}
                        </p>
                        <p className={`text-lg font-bold ${timeLeft.isExpired ? 'text-red-900' : 'text-orange-900'}`}>
                            {deadline.toLocaleDateString('ar-TN', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}
                        </p>
                    </div>
                </div>

                {!timeLeft.isExpired && (
                    <div className="flex items-center gap-2" dir="ltr">
                        <div className="bg-white p-2 rounded-lg border border-orange-200 shadow-sm text-center min-w-[60px]">
                            <span className="block text-xl font-bold text-orange-600 leading-none">{timeLeft.days}</span>
                            <span className="text-[10px] text-gray-500 uppercase font-bold">يوم</span>
                        </div>
                        <span className="font-bold text-orange-300">:</span>
                        <div className="bg-white p-2 rounded-lg border border-orange-200 shadow-sm text-center min-w-[60px]">
                            <span className="block text-xl font-bold text-orange-600 leading-none">{timeLeft.hours}</span>
                            <span className="text-[10px] text-gray-500 uppercase font-bold">ساعة</span>
                        </div>
                        <span className="font-bold text-orange-300">:</span>
                        <div className="bg-white p-2 rounded-lg border border-orange-200 shadow-sm text-center min-w-[60px]">
                            <span className="block text-xl font-bold text-orange-600 leading-none">{timeLeft.minutes}</span>
                            <span className="text-[10px] text-gray-500 uppercase font-bold">دقيقة</span>
                        </div>
                        <span className="font-bold text-orange-300">:</span>
                        <div className="bg-white p-2 rounded-lg border border-orange-200 shadow-sm text-center min-w-[60px]">
                            <span className="block text-xl font-bold text-orange-600 leading-none">{timeLeft.seconds}</span>
                            <span className="text-[10px] text-gray-500 uppercase font-bold">ثانية</span>
                        </div>
                    </div>
                )}
            </div>

            {scoreConfig && (
                <div className="mx-6 md:mx-10 mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 flex flex-col md:flex-row gap-4 items-start animate-fadeIn">
                    <div className="bg-blue-100 p-2 rounded-full text-blue-600 shrink-0">
                        <Info size={24} />
                    </div>
                    <div>
                        <h3 className="font-bold text-blue-900 mb-2">طاقة الاستيعاب ومراحل المناظرة</h3>
                        <ul className="list-disc list-inside text-sm text-blue-800 space-y-1">
                            <li>
                                سيتم دعوة أفضل <strong>{scoreConfig.writtenExamCount}</strong> مترشحاً (N) لاجتياز <strong>الاختبار الكتابي</strong>، وذلك حسب الترتيب التفاضلي للمجموع الشخصي.
                            </li>
                            <li>
                                سيتم دعوة أفضل <strong>{scoreConfig.oralExamCount}</strong> مترشحين (M) لاجتياز <strong>الاختبار الشفوي</strong>، وذلك حسب نتائج الاختبار الكتابي.
                            </li>
                        </ul>
                    </div>
                </div>
            )}

            <div className="p-6 md:p-10 space-y-12">

                {/* Section I: Personal Info */}
                <section>
                    <SectionHeader number="I" title="المعطيات الشخصية" />

                    <div className="grid grid-cols-1 md:grid-cols-12 gap-6">
                        {/* Row 1: Name & Gender */}
                        <div className="md:col-span-8">
                            <InputGroup
                                label="اسم ولقب المترشح"
                                name="fullName"
                                value={data.fullName}
                                onChange={handleChange}
                                required
                                placeholder="الاسم واللقب كما هو في بطاقة التعريف"
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                        <div className="md:col-span-4">
                            <label className="text-sm font-bold text-gray-700 flex items-center gap-2 mb-3">
                                الجنس <span className="text-red-500">*</span>
                            </label>
                            <div className="flex gap-4">
                                <label className={`flex-1 flex items-center justify-center gap-2 p-2.5 rounded-lg border cursor-pointer transition-all ${data.gender === 'male' ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-gray-300 hover:bg-gray-50'}`}>
                                    <input
                                        type="radio"
                                        name="gender"
                                        value="male"
                                        checked={data.gender === 'male'}
                                        onChange={handleChange}
                                        className="w-4 h-4 accent-primary-600"
                                        disabled={timeLeft.isExpired}
                                    />
                                    <span>ذكر</span>
                                </label>
                                <label className={`flex-1 flex items-center justify-center gap-2 p-2.5 rounded-lg border cursor-pointer transition-all ${data.gender === 'female' ? 'bg-pink-50 border-pink-500 text-pink-700' : 'border-gray-300 hover:bg-gray-50'}`}>
                                    <input
                                        type="radio"
                                        name="gender"
                                        value="female"
                                        checked={data.gender === 'female'}
                                        onChange={handleChange}
                                        className="w-4 h-4 accent-pink-500"
                                        disabled={timeLeft.isExpired}
                                    />
                                    <span>أنثى</span>
                                </label>
                            </div>
                        </div>

                        {/* Row 2: Birth Info */}
                        <div className="md:col-span-6">
                            <InputGroup
                                label="تاريخ الولادة"
                                name="birthDate"
                                type="date"
                                value={data.birthDate}
                                onChange={handleChange}
                                required
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                        <div className="md:col-span-6">
                            <SelectGroup
                                label="مكان الولادة (الولاية)"
                                name="birthPlace"
                                value={data.birthPlace}
                                onChange={handleChange}
                                required
                                options={TUNISIAN_GOVERNORATES.map(g => ({ value: g, label: g }))}
                                disabled={timeLeft.isExpired}
                            />
                        </div>

                        {/* Row 3: Address */}
                        <div className="md:col-span-12">
                            <div className="bg-gray-50 p-4 rounded-lg border border-gray-200 grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div className="md:col-span-12">
                                    <h3 className="text-sm font-bold text-gray-700 mb-2">العنوان الشخصي</h3>
                                </div>
                                <div className="md:col-span-6">
                                    <InputGroup
                                        label="العنوان (النهج / الحي)"
                                        name="address"
                                        value={data.address}
                                        onChange={handleChange}
                                        required
                                        placeholder="رقم المنزل، اسم النهج، الحي..."
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                                <div className="md:col-span-3">
                                    <SelectGroup
                                        label="الولاية"
                                        name="governorate"
                                        value={data.governorate}
                                        onChange={handleChange}
                                        required
                                        options={TUNISIAN_GOVERNORATES.map(g => ({ value: g, label: g }))}
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                                <div className="md:col-span-3">
                                    <InputGroup
                                        label="الترقيم البريدي"
                                        name="postalCode"
                                        type="tel"
                                        pattern="[0-9]*"
                                        maxLength={4}
                                        value={data.postalCode}
                                        onChange={handleChange}
                                        required
                                        placeholder="XXXX"
                                        className="tracking-widest font-mono text-center"
                                        dir="ltr"
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                            </div>
                        </div>

                        {/* Row 4: ID Card */}
                        <div className="md:col-span-6">
                            <InputGroup
                                label="رقم بطاقة التعريف الوطنية"
                                name="cin"
                                type="tel"
                                pattern="[0-9]*"
                                maxLength={8}
                                value={data.cin}
                                onChange={handleChange}
                                required
                                placeholder="XXXXXXXX"
                                className="tracking-widest font-mono text-left"
                                dir="ltr"
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                        <div className="md:col-span-6">
                            <InputGroup
                                label="تاريخ الإصدار"
                                name="cinDate"
                                type="date"
                                value={data.cinDate}
                                onChange={handleChange}
                                required
                                disabled={timeLeft.isExpired}
                            />
                        </div>

                        {/* Row 5: CNSS/CNRPS */}
                        <div className="md:col-span-12">
                            <div className="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <h3 className="text-sm font-bold text-gray-700 mb-3">التغطية الاجتماعية</h3>
                                <div className="flex flex-wrap gap-4 mb-4">
                                    <label className={`flex-1 min-w-[120px] flex items-center justify-center gap-2 p-3 rounded-lg border cursor-pointer transition-all ${data.socialSecurityType === 'cnss' ? 'bg-blue-50 border-blue-500 text-blue-700' : 'bg-white border-gray-300 hover:bg-gray-50'}`}>
                                        <input
                                            type="radio"
                                            name="socialSecurityType"
                                            value="cnss"
                                            checked={data.socialSecurityType === 'cnss'}
                                            onChange={handleSocialTypeChange}
                                            className="w-4 h-4 accent-blue-600"
                                            disabled={timeLeft.isExpired}
                                        />
                                        <span className="font-medium">CNSS</span>
                                    </label>

                                    <label className={`flex-1 min-w-[120px] flex items-center justify-center gap-2 p-3 rounded-lg border cursor-pointer transition-all ${data.socialSecurityType === 'cnrps' ? 'bg-blue-50 border-blue-500 text-blue-700' : 'bg-white border-gray-300 hover:bg-gray-50'}`}>
                                        <input
                                            type="radio"
                                            name="socialSecurityType"
                                            value="cnrps"
                                            checked={data.socialSecurityType === 'cnrps'}
                                            onChange={handleSocialTypeChange}
                                            className="w-4 h-4 accent-blue-600"
                                            disabled={timeLeft.isExpired}
                                        />
                                        <span className="font-medium">CNRPS</span>
                                    </label>

                                    <label className={`flex-1 min-w-[120px] flex items-center justify-center gap-2 p-3 rounded-lg border cursor-pointer transition-all ${data.socialSecurityType === 'none' ? 'bg-gray-100 border-gray-400 text-gray-700' : 'bg-white border-gray-300 hover:bg-gray-50'}`}>
                                        <input
                                            type="radio"
                                            name="socialSecurityType"
                                            value="none"
                                            checked={data.socialSecurityType === 'none'}
                                            onChange={handleSocialTypeChange}
                                            className="w-4 h-4 accent-gray-600"
                                            disabled={timeLeft.isExpired}
                                        />
                                        <span className="font-medium">لا ينطبق (Néant)</span>
                                    </label>
                                </div>

                                {(data.socialSecurityType === 'cnss' || data.socialSecurityType === 'cnrps') && (
                                    <div className="animate-fadeIn">
                                        <InputGroup
                                            label={`رقم الانخراط (${data.socialSecurityType.toUpperCase()})`}
                                            name="cnssNumber"
                                            type="text"
                                            value={data.cnssNumber}
                                            onChange={handleChange}
                                            required
                                            placeholder="رقم المعرف الوحيد"
                                            className=" tracking-wide bg-white"
                                            disabled={timeLeft.isExpired}
                                        />
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Row 6: Contact */}
                        <div className="md:col-span-6">
                            <InputGroup
                                label="رقم الهاتف الجوال"
                                name="mobile"
                                type="tel"
                                pattern="[0-9]*"
                                maxLength={8}
                                value={data.mobile}
                                onChange={handleChange}
                                required
                                placeholder="XXXXXXXX"
                                className="tracking-widest text-left"
                                dir="ltr"
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                        <div className="md:col-span-6">
                            <InputGroup
                                label="البريد الإلكتروني"
                                name="email"
                                type="email"
                                value={data.email}
                                onChange={handleChange}
                                required
                                placeholder="example@email.com"
                                className="text-left"
                                dir="ltr"
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                    </div>
                </section>

                {/* Section II: Civil Status */}
                <section>
                    <SectionHeader number="II" title="الحالة الاجتماعية" />
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div className="md:col-span-6">
                            <SelectGroup
                                label="الحالة المدنية"
                                name="maritalStatus"
                                value={data.maritalStatus}
                                onChange={handleChange}
                                disabled={timeLeft.isExpired}
                                options={[
                                    { value: 'single', label: 'أعزب / عزباء' },
                                    { value: 'married', label: 'متزوج(ة)' },
                                    { value: 'divorced', label: 'مطلق(ة)' },
                                    { value: 'widowed', label: 'أرمل(ة)' },
                                ]}
                            />
                        </div>
                        <div className="md:col-span-6">
                            <SelectGroup
                                label="الوضعية العسكرية"
                                name="militaryStatus"
                                value={data.militaryStatus}
                                onChange={handleChange}
                                disabled={timeLeft.isExpired}
                                options={[
                                    { value: 'completed', label: 'أدى الخدمة' },
                                    { value: 'exempt', label: 'معفى' },
                                    { value: 'postponed', label: 'مؤجل' },
                                    { value: 'not_concerned', label: 'غير معني' },
                                ]}
                            />
                        </div>

                        {data.maritalStatus === 'married' && (
                            <>
                                <div className="md:col-span-6">
                                    <InputGroup
                                        label="اسم ولقب القرين"
                                        name="spouseName"
                                        value={data.spouseName}
                                        onChange={handleChange}
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                                <div className="md:col-span-6">
                                    <InputGroup
                                        label="مهنة القرين"
                                        name="spouseProfession"
                                        value={data.spouseProfession}
                                        onChange={handleChange}
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                                <div className="md:col-span-12">
                                    <InputGroup
                                        label="مكان عمله"
                                        name="spouseWorkplace"
                                        value={data.spouseWorkplace}
                                        onChange={handleChange}
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                                <div className="md:col-span-6">
                                    <InputGroup
                                        label="عدد الأبناء"
                                        name="childrenCount"
                                        type="number"
                                        min={0}
                                        value={data.childrenCount}
                                        onChange={handleChange}
                                        disabled={timeLeft.isExpired}
                                    />
                                </div>
                            </>
                        )}
                    </div>
                </section>

                {/* Section III: Education */}
                <section>
                    <SectionHeader number="III" title="المستوى التعليمي" />
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-6">
                        {/* Bac Info */}
                        <div className="md:col-span-12 bg-blue-50 p-4 rounded-lg border border-blue-100 grid grid-cols-1 md:grid-cols-12 gap-4">
                            <div className="md:col-span-12">
                                <h3 className="text-sm font-bold text-blue-800 mb-1">بيانات البكالوريا</h3>
                            </div>
                            <div className="md:col-span-4">
                                <SelectGroup
                                    label="شعبة البكالوريا"
                                    name="bacSpecialty"
                                    value={data.bacSpecialty}
                                    onChange={handleChange}
                                    required
                                    options={BAC_SPECIALTIES}
                                    disabled={timeLeft.isExpired}
                                />
                            </div>
                            <div className="md:col-span-4">
                                <InputGroup
                                    label="سنة الحصول عليها"
                                    name="bacYear"
                                    type="number"
                                    min={1970}
                                    max={new Date().getFullYear()}
                                    value={data.bacYear}
                                    onChange={handleChange}
                                    required
                                    disabled={timeLeft.isExpired}
                                />
                            </div>
                            <div className="md:col-span-4">
                                <InputGroup
                                    label="معدل البكالوريا"
                                    name="bacAverage"
                                    type="number"
                                    step="0.01"
                                    min={0}
                                    max={20}
                                    value={data.bacAverage}
                                    onChange={handleChange}
                                    className="font-mono"
                                    placeholder="--.--"
                                    required
                                    disabled={timeLeft.isExpired}
                                />
                            </div>
                        </div>

                        {/* University Info */}
                        <div className="md:col-span-12 mt-4">
                            <h3 className="text-sm font-bold text-gray-700 mb-3">بيانات الشهادة الجامعية</h3>
                        </div>
                        <div className="md:col-span-12">
                            <SelectGroup
                                label="الشهادة العلمية"
                                name="degree"
                                value={data.degree}
                                onChange={handleChange}
                                required
                                disabled={timeLeft.isExpired}
                                options={[
                                    { value: 'license', label: 'إجازة' },
                                    { value: 'master', label: 'ماجستير' },
                                    { value: 'engineer', label: 'شهادة مهندس' },
                                    { value: 'doctorate', label: 'دكتوراه' },
                                    { value: 'technician', label: 'تقني سامي' },
                                ]}
                            />
                        </div>
                        <div className="md:col-span-8">
                            <InputGroup
                                label="الاختصاص"
                                name="specialty"
                                value={data.specialty}
                                onChange={handleChange}
                                required
                                placeholder="مثال: إعلامية، تصرف، قانون..."
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                        <div className="md:col-span-4">
                            <InputGroup
                                label="سنة التخرج"
                                name="graduationYear"
                                type="number"
                                min={1980}
                                max={new Date().getFullYear()}
                                value={data.graduationYear}
                                onChange={handleChange}
                                required
                                disabled={timeLeft.isExpired}
                            />
                        </div>

                        <div className="md:col-span-8">
                            <InputGroup
                                label="قرار المعادلة رقم (إن وجد)"
                                name="equivalenceDecision"
                                value={data.equivalenceDecision}
                                onChange={handleChange}
                                helperText="لخريجي الجامعات الأجنبية أو الخاصة"
                                disabled={timeLeft.isExpired}
                            />
                        </div>
                        <div className="md:col-span-4">
                            <InputGroup
                                label="بتاريخ"
                                name="equivalenceDate"
                                type="date"
                                value={data.equivalenceDate}
                                onChange={handleChange}
                                disabled={timeLeft.isExpired}
                            />
                        </div>

                        <div className="md:col-span-12">
                            <InputGroup
                                label="معدل أعداد سنة التخرج"
                                name="gradAverage"
                                type="number"
                                step="0.01"
                                min={0}
                                max={20}
                                value={data.gradAverage}
                                onChange={handleChange}
                                className="font-mono w-full md:w-1/3"
                                placeholder="--.--"
                                disabled={timeLeft.isExpired}
                                required
                            />
                        </div>

                        <div className="md:col-span-12">
                            <div className={`
                 p-6 rounded-xl border transition-colors duration-300
               `}>
                                <label className="block text-sm font-bold text-gray-700 mb-2">رقم الخطة المزمع المشاركة فيها <span className="text-red-500">*</span></label>
                                <div className="flex flex-col md:flex-row gap-4 items-start md:items-center">
                                    <div className="w-full md:w-1/3">
                                        <input
                                            type="text"
                                            name="targetPositionNumber"
                                            value={data.targetPositionNumber}
                                            onChange={handleChange}
                                            className={`
                          w-full p-3 border rounded-lg text-center text-xl font-bold font-mono outline-none
                          bg-white
                          focus:ring-2
                        `}
                                            placeholder="رقم الخطة"
                                            disabled={timeLeft.isExpired}
                                            autoComplete="off"
                                        />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Footer Actions */}
                <div className="pt-6 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p className="text-sm text-gray-500">
                        أشهد بصحة المعلومات المدلاة أعلاه وأتحمل المسؤولية القانونية في حالة ثبوت عكس ذلك.
                    </p>
                    <button
                        type="submit"
                        disabled={isSubmitting || timeLeft.isExpired }
                        className={`
              flex items-center gap-2 px-8 py-3 rounded-lg font-bold text-white shadow-lg
              transition-all duration-200 transform hover:-translate-y-1
              ${(isSubmitting || timeLeft.isExpired ) ? 'bg-gray-400 cursor-not-allowed hover:transform-none' : 'bg-primary-600 hover:bg-primary-700'}
            `}
                    >
                        {isSubmitting ? (
                            'جاري الإرسال...'
                        ) : timeLeft.isExpired ? (
                            'التسجيل مغلق'
                        ) : (
                            <>
                                <span>تأكيد الترشح</span>
                                <Send size={18} className="rtl:rotate-180" />
                            </>
                        )}
                    </button>
                </div>
            </div>
        </Form>
    );
};
