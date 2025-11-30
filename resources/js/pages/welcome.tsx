import { dashboard, login } from '@/routes';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { RecruitmentForm } from '@/components/recruitment-form';

export default function Welcome({
    deadline,
    currentlyRecruiting
}: {
    deadline: string, currentlyRecruiting: boolean;
}) {

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net"/>
                <link href="https://fonts.bunny.net/css?family=tajawal:200,300,400,500,700,800,900" rel="stylesheet" />
            </Head>
            <div
                className="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 ">

                <div className={'mb-3'}>
                    <a href="/app/login"
                       className="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg text-center
              hover:bg-blue-700 transition font-medium">
                        تسجيل الدخول
                    </a>
                </div>

                {currentlyRecruiting ? <RecruitmentForm deadlineDate={deadline}></RecruitmentForm> :
                    <div className={"font-mono text-lg"}>لا توجد اي مناظرة عمل في الوقت الحالي</div>}
            </div>
        </>
    );
}
