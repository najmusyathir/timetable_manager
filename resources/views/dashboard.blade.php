<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .card {
            transition: 400ms;

            &:hover {
                cursor: pointer;
                transform: translate(0, -3px);
                box-shadow: 0px 9px 13px -1px #818cf877;
            }
        }

        .btns {
            border: #0b459b 1px solid !important;
            font-size: 1.2reml;
            color: #0b459b;
            padding: 10px 20px;
            transition: 500ms;
            border-radius: 10px;

            &:hover {
                cursor: pointer;
                background: #0b459b;
                color: white
            }
        }
    </style>


    @if (auth()->user() && auth()->user()->user_type == 'admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 gap-3">

                        <h2 class="text-3xl font-semibold py-5">Statistics</h2>
                        <div class="flex gap-3 justify-center flex-wrap">

                            <div
                                class="card border border-[#818cf8] p-5 w-60 h-80 rounded-xl flex flex-col items-center justify-between">
                                <div class="flex items-center h-full">
                                    <div class="'flex flex-row items-end flex-nowrap">
                                        <p class="text-[#5359a0]"> <strong class="text-7xl text-nowrap font-semibold">
                                                <?php echo \App\Models\User::count() - 1; ?></strong>users</p>
                                    </div>
                                </div>
                                <a class="btn" href="{{ route('admin.index') }}"> Check Users</a>
                            </div>

                            <div
                                class="card border border-[#c484e9] p-5 w-60 h-80 rounded-xl flex flex-col items-center justify-between">
                                <div class="flex items-center h-full">
                                    <div class="'flex flex-row items-end flex-nowrap">
                                        <p class="text-[#7b31a7]"> <strong class="text-7xl text-nowrap font-semibold">
                                                <?php echo \App\Models\Subject::count(); ?></strong>Subjects</p>
                                    </div>
                                </div>
                                <a class="btn hover:bg-[#7b31a7] text-[#7b31a7] border-[#7b31a7]"
                                    href="{{ route('subject.index') }}"> Check Subjects</a>
                            </div>

                            <div
                                class="card border border-[#cf5b86] p-5 w-60 h-80 rounded-xl flex flex-col items-center justify-between">
                                <div class="flex items-center h-full">
                                    <div class="'flex flex-row items-end flex-nowrap">
                                        <p class="text-[#b83565]"> <strong class="text-7xl text-nowrap font-semibold">
                                                <?php echo \App\Models\Classroom::count(); ?></strong>Classrooms</p>
                                    </div>
                                </div>
                                <a class="btn hover:bg-[#b83565] text-[#b83565] border-[#b83565]"
                                    href="{{ route('classroom.index') }}"> Check Classrooms</a>
                            </div>

                        </div>
                        <div class="flex gap-3 my-5 justify-center flex-wrap">
                            <div
                                class="card border border-[#A2D2FF] p-5 w-60 h-80 rounded-xl flex flex-col items-center justify-between">
                                <div class="flex items-center h-full">
                                    <div class="'flex flex-row items-end flex-nowrap">
                                        <p class="text-[#2566a3]"> <strong class="text-7xl text-nowrap font-semibold">
                                                <?php echo \App\Models\Course::count(); ?></strong>Classes</p>
                                    </div>
                                </div>
                                <a class="btn hover:bg-[#2566a3] text-[#2566a3] border-[#2566a3]"
                                    href="{{ route('course.index') }}"> Check Classes</a>
                            </div>

                            <div
                                class="card border border-[#e2b77e] p-5 w-60 h-80 rounded-xl flex flex-col items-center justify-between">
                                <div class="flex items-center h-full">
                                    <div class="'flex flex-row items-end flex-nowrap">
                                        <p class="text-[#f48c06]"> <strong class="text-7xl text-nowrap font-semibold">
                                                <?php echo \App\Models\Batch::count(); ?></strong>Batches</p>
                                    </div>
                                </div>
                                <a class="btn hover:bg-[#f48c06] hover:shadow-[#f48c06] text-[#f48c06] border-[#f48c06]"
                                    href="{{ route('batch.index') }}"> Check Batches</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @elseif (auth()->user() && auth()->user()->user_type == 'student')
        <div class="py-12">
            <div class="max-w-7xl bg-white  flex flex-col items-center mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden p-5 shadow-sm sm:rounded-lg flex flex-col items-center">
                    <h1 class="text-3xl font-semibold">Welcome back, {{ auth()->user()->name }}</h1>
                </div>

                <div class="grid bg-white grid-cols-2 h-full my-5 rounded-xl flex-wrap justify-center w-11/12 "
                    style="min-height:65vh;">
                    <div class="flex justify-center items-center flex-col">
                        <h1 class="text-blue-900 text-4xl font-bold py-5">
                            Streamlined Scheduling
                        </h1>
                        <p class="text-blue-700 font-semibold text-center">Simplifying schedule management by providing
                            real-time
                            data and advanced automation for a smoother and more efficient operation.</p>

                        <div class="p-5 gap-5 w-full justify-center flex">
                            <a class="flex justify-center items-center p-5 btns w-fit"
                                href="{{ route('student.table') }}">Check Your Timetable</a>
                            <a class="flex justify-center items-center p-5 btns w-fit"
                                href="{{ route('user.add', ['id' => auth()->user()->id]) }}">Check Your
                                Information
                                Details</a>
                        </div>

                    </div>
                    <div class="">
                        <img src="{{ asset('assets/images/dashboard_img.png') }}">
                    </div>
                </div>



            </div>

        </div>
    @elseif (auth()->user() && auth()->user()->user_type == 'teacher')
        <div class="py-12">
            <div class="max-w-7xl bg-white  flex flex-col items-center mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden p-5 shadow-sm sm:rounded-lg flex flex-col items-center">
                    <h1 class="text-3xl font-semibold">Welcome back, {{ auth()->user()->name }}</h1>
                </div>

                <div class="grid bg-white grid-cols-2 h-full my-5 rounded-xl flex-wrap justify-center w-11/12 "
                    style="min-height:65vh;">
                    <div class="flex justify-center items-center flex-col">
                        <h1 class="text-blue-900 text-4xl font-bold py-5">
                            Streamlined Scheduling
                        </h1>
                        <p class="text-blue-700 font-semibold text-center">Simplifying schedule management by providing
                            real-time
                            data and advanced automation for a smoother and more efficient operation.</p>

                        <div class="p-5 gap-5 w-full justify-center flex">
                            <a class="flex justify-center items-center p-5 btns w-fit"
                                href="{{ route('student.table') }}">Check Your Timetable</a>
                            <a class="flex justify-center items-center p-5 btns w-fit"
                                href="{{ route('user.userDetails', ['id' => auth()->user()->id]) }}">Check Your
                                Information
                                Details</a>
                        </div>

                    </div>
                    <div class="">
                        <img src="{{ asset('assets/images/dashboard_img.png') }}">
                    </div>
                </div>



            </div>

        </div>
    @endif
</x-app-layout>
