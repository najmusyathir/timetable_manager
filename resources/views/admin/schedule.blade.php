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

        #newBatch {
            flex-wrap: wrap;

            input {
                min-width: 100px;
            }
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Scheduled Class
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center">
                <div class="w-full p-10 flex justify-center flex-wrap">
                    <a href="{{route('schedule.addPage')}}" class="btn"> Add Schedule </a>
                </div>
                <table class="w-11/12">
                    <tbody>
                        <div class="hidden">
                            <?= $counter=1 ?>
                        </div>
                        <tr>
                            <td>No.</td>
                            <td>Class</td>
                            <td>Subject</td>
                            <td>Location</td>
                            <td>Instructor</td>
                            <td>Day</td>
                            <td colspan="2">Time</td>

                        </tr>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td class="w-min">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="text-nowrap">{{$schedule->course->code}} - S{{$schedule->course->semester}}</td>
                                <td class="text-center">{{$schedule->subject->code}}</td>
                                <td>{{$schedule->location->name}}</td>
                                <td class="text-nowrap">{{$schedule->instructor->name}}</td>
                                <td>{{$schedule->day->name}}</td>
                                <td class="text-nowrap">{{$schedule->start->time}} - {{$schedule->end->time}}</td>

                                <td class="gap-3 flex">

                                    <a class="btn" href="{{route("schedule.updatePage", ['id' => $schedule->id])}}">Update</a>

                                    <form class="w-fit" method="POST"
                                        action="{{ route('schedule.delete', ['id' => $schedule->id]) }}">
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