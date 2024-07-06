<x-app-layout>
    <style>
        td form [type=text],
        td input[type=text] {
            min-width: 100px;
            border: none !important;
        }

        .add-btn {
            border: 2px #818cf8 solid;
            border-radius: 15px;
            padding: 5px 10px;
            color: #818cf8;
            transition: 300ms ease-in-out;
        }

        .add-btn:hover {
            cursor: pointer;
            background: #818cf8;
            color: white;
        }

        #newCourse {
            flex-wrap: wrap;

            input {
                min-width: 100px;
            }
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List of Classes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center">
                <div class="w-full p-10 flex justify-center flex-wrap">

                    <form id="newCourse" class="flex gap-3" method="POST" action="{{ route('course.add')}}">
                        @csrf
                        <input style="border: 2px solid #818cf8 !important" type="text" name="code"
                            placeholder="Code: CS230" required>
                        <input style="border: 2px solid #818cf8 !important" type="text" name="semester"
                            placeholder="Semester: 1" required>
                        <input type="submit" value="Add Course" class=" add-btn flex justify-center items-center">
                    </form>
                </div>
                <table class="w-11/12">
                    <tbody>
                        <div class="hidden">
                            <?= $counter=1 ?>
                        </div>
                        <tr>
                            <td>No.</td>
                            <td>Code</td>
                            <td>Semester</td>
                            <td colspan="3"></td>
                        </tr>
                        @foreach ($courses as $course)
                            <tr>
                                <td class="w-min">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <form class="flex w-full gap-3" method="POST"
                                        action="{{ route('course.update', $course->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="code" value="{{$course->code}}" required>
                                </td>

                                <td class="w-full">
                                    <input type="text" name="semester" value="{{$course->semester}}" required>
                                </td>

                                <td class="gap-3 flex">
                                    <input type="submit" value="Update">
                                    </form>
                                </td>
                                <td>
                                    <a class="btn text-nowrap h-full text-lg" href="{{route('schedule.tableCourse', ['c_id'=>$course->id])}}">Timetable</a>
                                </td>

                                <td>
                                    <form class="w-fit" method="POST"
                                        action="{{ route('course.delete', ['id' => $course->id]) }}">

                                        @csrf
                                        @method('DELETE')
                                        <input class="btn dlt" type="submit" value="Remove">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>