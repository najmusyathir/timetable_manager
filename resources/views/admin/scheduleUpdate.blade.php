<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Schedule
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col items-center  shadow-sm sm:rounded-lg p-5">
                <h2 class="text-xl font-semibold">
                    Update Schedule : {{ $schedule->course->code }} {{ $schedule->subject->code }}
                </h2>
                <form id="newBatch" class="flex gap-3 flex-col p-5 w-11/12 max-w-xl" method="POST"
                    action="{{ route('schedule.update', ['id' => $schedule->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="pb-3">
                        <label for="course_id">Class:</label>
                        <select class="w-full" id="course_id" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $course->id == $schedule->course->id ? 'selected' : '' }}>
                                    {{ $course->code }} - S{{ $course->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-3">
                        <label for="subject_id">
                            Subject:
                        </label>
                        <select class="w-full" id="subject_id" name="subject_id">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $subject->id == $schedule->subject->id ? 'selected' : '' }}>
                                    {{ $subject->code }} - {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-3">
                        <label for="instructor_id">
                            Instructor:
                        </label>
                        <select class="w-full" id="instructor_id" name="instructor_id">
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}"
                                    {{ $instructor->id == $schedule->instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->matric_no }} - {{ $instructor->name }}
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
                                <option value="{{ $location->id }}"
                                    {{ $location->id == $schedule->location->id ? 'selected' : '' }}>
                                    {{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-3">
                        <label for="day_id">
                            Day:
                        </label>
                        <select class="w-full" id="day_id" name="day_id">
                            @foreach ($days as $day)
                                <option value="{{ $day->id }}"
                                    {{ $day->id == $schedule->day->id ? 'selected' : '' }}>{{ $day->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div2 class="flex gap-5 w-full justify-center">
                        <div class="w-1/2">
                            <label for="start_id">
                                Start Time:
                            </label>
                            <select class="w-full" id="start_id" name="start_id">
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}"
                                        {{ $slot->id == $schedule->start->id ? 'selected' : '' }}>{{ $slot->time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-1/2">
                            <label for="end_id">
                                End Time:
                            </label>
                            <select class="w-full" id="end_id" name="end_id">
                                @foreach ($timeslots as $slot)
                                    <option value="{{ $slot->id }}"
                                        {{ $slot->id == $schedule->end->id ? 'selected' : '' }}>{{ $slot->time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div2>

                    <div class="flex w-full justify-center p-3" style="flex-direction: row">
                        <input type="submit" value="Update Class">
                    </div>

                </form>
            </div>
        </div>
    </div>

    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
</x-app-layout>
