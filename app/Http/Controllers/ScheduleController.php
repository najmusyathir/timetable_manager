<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Day;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view("admin.schedule", compact("schedules"));
    }
    function getData()
    {
        $schedule = Schedule::all();
        return response()->json($schedule);
    }
    public function tableCourse($c_id)
    {
        DB::enableQueryLog();
        $schedules = Schedule::where('course_id', $c_id)->get();
        $course = Course::findOrFail($c_id);
        $days = Day::all();
        $timeslots = TimeSlot::all();
        $queries = DB::getQueryLog();

        return view("table.course", compact("schedules", 'course', 'days', 'timeslots'));
    }
    public function studentTable()
    {
        DB::enableQueryLog();
        $schedules = Schedule::all();
        $course = Course::findOrFail(1);
        $days = Day::all();
        $timeslots = TimeSlot::all();
        $queries = DB::getQueryLog();

        return view("table.user_table", compact("schedules", 'course', 'days', 'timeslots'));
    }

    public function tableCourseData($c_id)
    {
        $schedules = Schedule::where('course_id', $c_id)->get();
        return response()->json($schedules);
    }

    public function tableTeacher($u_id)
    {
        $schedules = Schedule::where('user_id', $u_id);
        return view("admin.schedule", compact("schedules"));
    }

    public function scheduleAddPage($c_id)
    {
        $course = Course::findOrFail($c_id);
        $subjects = Subject::orderBy('code', 'asc')->get();
        $instructors = User::where("user_type", "teacher")->get();
        $locations = Classroom::orderBy('name', 'asc')->get();
        $days = Day::all();
        $timeslots = TimeSlot::all();

        return view("admin.scheduleAdd", compact("course", "subjects", "instructors", "locations", "days", 'timeslots'));
    }

    public function scheduleUpdatePage($id)
    {
        $courses = Course::orderBy('code', 'asc')->get();
        $subjects = Subject::orderBy('code', 'asc')->get();
        $instructors = User::where("user_type", "teacher")->get();
        $locations = Classroom::orderBy('name', 'asc')->get();
        $days = Day::all();
        $timeslots = TimeSlot::all();
        $schedule = Schedule::findOrFail($id);

        return view("admin.scheduleUpdate", compact("courses", "subjects", "instructors", "locations", "days", 'timeslots', "schedule"));
    }


    public function scheduleAdd(Request $request)
    {
        // Validate request data
        $request->validate([
            'course_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'instructor_id' => 'required|integer',
            'location_id' => 'required|integer',
            'day_id' => 'required|integer',
            'start_id' => 'required|integer',
            'end_id' => 'required|integer|gt:start_id',
        ], [
            'end_id.gt' => 'The End Time must be greater than the Start Time.',
        ]);

        $course_id = $request->input('course_id');
        $instructor_id = $request->input('instructor_id');
        $day_id = $request->input('day_id');
        $start_id = $request->input('start_id');
        $end_id = $request->input('end_id');

        // Check for overlapping schedules
        $overlappingSchedule = Schedule::where(function ($query) use ($course_id, $day_id, $start_id, $end_id) {
            $query->where('course_id', $course_id)
                ->where('day_id', $day_id)
                ->where(function ($query) use ($start_id, $end_id) {
                    $query->whereBetween('start_id', [$start_id, $end_id - 1])
                        ->orWhereBetween('end_id', [$start_id + 1, $end_id])
                        ->orWhere(function ($query) use ($start_id, $end_id) {
                            $query->where('start_id', '<=', $start_id)
                                ->where('end_id', '>=', $end_id);
                        });
                });
        })
            ->orWhere(function ($query) use ($instructor_id, $day_id, $start_id, $end_id) {
                $query->where('instructor_id', $instructor_id)
                    ->where('day_id', $day_id)
                    ->where(function ($query) use ($start_id, $end_id) {
                        $query->whereBetween('start_id', [$start_id, $end_id - 1])
                            ->orWhereBetween('end_id', [$start_id + 1, $end_id])
                            ->orWhere(function ($query) use ($start_id, $end_id) {
                                $query->where('start_id', '<=', $start_id)
                                    ->where('end_id', '>=', $end_id);
                            });
                    });
            })
            ->exists();

        if ($overlappingSchedule || $start_id === $end_id) {
            return redirect()->route('schedule.addPage', ['c_id' => $course_id])->with('error', 'Error 409: The schedule overlaps with an existing one.');
        }

        // Save the new schedule
        $schedule = new Schedule();
        $schedule->course_id = $request->input('course_id');
        $schedule->subject_id = $request->input('subject_id');
        $schedule->instructor_id = $request->input('instructor_id');
        $schedule->location_id = $request->input('location_id');
        $schedule->day_id = $request->input('day_id');
        $schedule->start_id = $request->input('start_id');
        $schedule->end_id = $request->input('end_id');
        $schedule->save();

        return redirect()->route('schedule.tableCourse', ['c_id' => $schedule->course_id])->with('success', 'Submit success');
    }




    public function scheduleUpdate(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'course_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'instructor_id' => 'required|integer',
            'location_id' => 'required|integer',
            'day_id' => 'required|integer',
            'start_id' => 'required|integer',
            'end_id' => 'required|integer|gt:start_id',
        ], [
            'end_id.gt' => 'The End Time must be greater than the Start Time.',
        ]);

        $course_id = $request->input('course_id');
        $instructor_id = $request->input('instructor_id');
        $day_id = $request->input('day_id');
        $start_id = $request->input('start_id');
        $end_id = $request->input('end_id');

        // Check for overlapping schedules excluding the current schedule
        $overlappingSchedule = Schedule::where('id', '!=', $id)
            ->where(function ($query) use ($course_id, $day_id, $start_id, $end_id) {
                $query->where('course_id', $course_id)
                    ->where('day_id', $day_id)
                    ->where(function ($query) use ($start_id, $end_id) {
                        $query->whereBetween('start_id', [$start_id, $end_id - 1])
                            ->orWhereBetween('end_id', [$start_id + 1, $end_id])
                            ->orWhere(function ($query) use ($start_id, $end_id) {
                                $query->where('start_id', '<=', $start_id)
                                    ->where('end_id', '>=', $end_id);
                            });
                    });
            })
            ->orWhere(function ($query) use ($instructor_id, $day_id, $start_id, $end_id) {
                $query->where('instructor_id', $instructor_id)
                    ->where('day_id', $day_id)
                    ->where(function ($query) use ($start_id, $end_id) {
                        $query->whereBetween('start_id', [$start_id, $end_id - 1])
                            ->orWhereBetween('end_id', [$start_id + 1, $end_id])
                            ->orWhere(function ($query) use ($start_id, $end_id) {
                                $query->where('start_id', '<=', $start_id)
                                    ->where('end_id', '>=', $end_id);
                            });
                    });
            })
            ->exists();

        if ($overlappingSchedule || $start_id === $end_id) {
            return redirect()->route('schedule.updatePage', ['id' => $id])->with('error', 'Error 409: The schedule overlaps with an existing one.');
        }

        // Update the schedule
        $schedule = Schedule::find($id);
        $schedule->course_id = $request->input("course_id");
        $schedule->subject_id = $request->input("subject_id");
        $schedule->instructor_id = $request->input("instructor_id");
        $schedule->location_id = $request->input("location_id");
        $schedule->day_id = $request->input("day_id");
        $schedule->start_id = $request->input("start_id");
        $schedule->end_id = $request->input("end_id");
        $schedule->save();

        return redirect()->route('schedule.tableCourse', ['c_id' => $schedule->course_id])->with('success', 'Update success');
    }





    public function scheduleDeletefromCourse($s_id)
    {
        $schedule = Schedule::findOrFail($s_id);
        $c_id = $schedule->course_id;
        $schedule->delete();

        return redirect()->route('schedule.tableCourse', ['c_id' => $c_id]);
    }

}
