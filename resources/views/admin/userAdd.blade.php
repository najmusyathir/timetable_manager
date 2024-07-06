<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Add New User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex items-center flex-col p-5 shadow-sm sm:rounded-lg">
                <form class="user-form w-full lg:w-1/2 flex flex-col p-5 gap-5" method="POST"
                    action="{{ route('user.add') }}">
                    @csrf

                    <div>
                        <label for="name">
                            Name:
                        </label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div>
                        <label for="user_type">
                            User Type:
                        </label>
                        <select class="input" id="user_type" name="user_type" required>
                            <option value="teacher">Teacher </option>
                            <option value="student">Student </option>
                        </select>
                    </div>


                    <div>
                        <label for="matric_no">
                            Matric No:
                        </label>
                        <input type="text" id="matric_no" name="matric_no" required>
                    </div>

                    <div>
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div>
                        <label for="password">
                            Password:
                        </label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div>
                        <label for="phone_no">
                            Phone No:
                        </label>
                        <input type="text" id="phone_no" name="phone_no">
                    </div>

                    <div>
                        <label for="batch_id">
                            Batch:
                        </label>
                        <select id="batch_id" name="batch_id">
                            <option value="">
                                null
                            </option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">
                                    {{ $batch->intake }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="course_id">Class:</label>
                        <select id="course_id" name="course_id">
                            <option value="">
                                null
                            </option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->code }} - Semester {{ $course->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">
                        <input type="submit" value="Add new User">
                    </div>


                </form>
            </div>
        </div>
    </div>
</x-app-layout>
