import { Head } from '@inertiajs/react';
import { RecruitmentForm } from '@/components/recruitment-form';

export default function Welcome({
    deadline,
    currentlyRecruiting,
    positions
}: {
    deadline: string, currentlyRecruiting: boolean;
}) {

    console.log(positions);
    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net"/>
                <link href="https://fonts.bunny.net/css?family=tajawal:200,300,400,500,700,800,900" rel="stylesheet" />
            </Head>
            <div
                className="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 ">
                {currentlyRecruiting ? <RecruitmentForm positions={positions} deadlineDate={deadline}></RecruitmentForm> :
                    <div className={"font-mono text-lg"}>لا توجد اي مناظرة عمل في الوقت الحالي</div>}
            </div>
        </>
    );
}
