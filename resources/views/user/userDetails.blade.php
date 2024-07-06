<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex items-center flex-col p-5 shadow-sm sm:rounded-lg">
                <form class="user-form w-full lg:w-1/2 flex flex-col p-5 gap-5">
                    <div>
                        <label for="name">
                            Name:
                        </label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" disabled>
                    </div>

                    <div>
                        <label for="user_type">
                            User Type:
                        </label>
                        <select class="input" id="user_type" name="user_type" disabled>
                            <option value="teacher" {{ $user->user_type == 'teacher' ? 'selected' : '' }}>Teacher
                            </option>
                            <option value="student" {{ $user->user_type == 'student' ? 'selected' : '' }}>Student
                            </option>
                        </select>
                    </div>


                    <div>
                        <label for="matric_no">
                            Matric No:
                        </label>
                        <input type="text" id="matric_no" name="matric_no" value="{{ $user->matric_no }}">
                    </div>

                    <div>
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" disabled>
                    </div>

                    <div>
                        <label for="phone_no">
                            Phone No:
                        </label>
                        <input type="text" id="phone_no" name="phone_no" value="{{ $user->phone_no }}" disabled>
                    </div>

                    @if (auth()->user()->user_type == 'student')

                        <div>
                            <label for="batch_id">
                                Batch:
                            </label>
                            <select id="batch_id" name="batch_id" disabled>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        {{ $user->batch_id == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->intake }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="course_id">
                                Course:
                            </label>
                            <select id="course_id" name="course_id" disabled>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $user->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    @endif
            </div>
        </div>
    </div>
</x-app-layout>
