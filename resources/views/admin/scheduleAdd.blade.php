<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Schedule Add
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col items-center  shadow-sm sm:rounded-lg p-5">
                <h2 class="text-xl font-semibold">
                    Schedule new class:
                </h2>
                <form id="newBatch" class="flex gap-3 flex-col p-5 w-11/12 max-w-xl" method="POST" action="{{ route('schedule.add')}}">
                    @csrf

                    <div class="pb-3">
                        <label for="course_id">
                            Course:
                        </label>
                        <select class="w-full" id="course_id" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->code}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-3">
                        <label for="subject_id">
                            Subject:
                        </label>
                        <select class="w-full" id="subject_id" name="subject_id">
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->code}} - {{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-3">
                        <label for="instructor_id">
                            Instructor:
                        </label>
                        <select class="w-full" id="instructor_id" name="instructor_id">
                            @foreach ($instructors as $instructor)
                                <option value="{{$instructor->id}}">{{$instructor->matric_no}} - {{$instructor->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pb-3">
                        <label for="location">
                            Location:
                        </label>
                        <select class="w-full" id="location" name="location_id">
                            @foreach ($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-3">
                        <label for="day_id">
                            Day:
                        </label>
                        <select class="w-full" id="day_id" name="day_id">
                            @foreach ($days as $day)
                                <option value="{{$day->id}}">{{$day->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div2 class="flex gap-5 w-full justify-center">
                        <div class="w-1/2">
                            <label for="start">Start Time:</label>
                            <input class="w-full" type="time" id="start" name="start" required>
                        </div>

                        <div class="w-1/2">
                            <label for="end">End Time:</label>
                            <input class="w-full" type="time" id="end" name="end" required>
                        </div>
                    </div2>

                    <div class="flex w-full justify-center p-3" style="flex-direction: row">
                        <input type="submit" value="Assign Class">
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>