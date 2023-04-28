<?php

namespace App\Http\Controllers;

use App\Models\Meetup;
use App\Http\Requests\StoreMeetupRequest;
use App\Http\Requests\UpdateMeetupRequest;
use App\Models\Faculty;
use App\Models\ProjectAllocation;
use App\Models\Role;
use App\Models\Student;
use Illuminate\Http\Request;

class MeetupController extends Controller
{
    public static function getProjectId()
    {
        $user = auth()->user();
        $projectId = null;
        try {
            if ($user->hasRole(Role::ROLE_STUDENT)) {
                $student = Student::where('user_id', $user->id)->first();
                $group = $student->group;
                $projectAllocation = ProjectAllocation::where('group_id', $group->id)->first();
                $projectId = $projectAllocation->project->id;
            } else {
                $faculty = Faculty::where('user_id', $user->id)->first();
                $projectAllocation = ProjectAllocation::where('supervisor_id', $faculty->id)->first();
                $projectId = $projectAllocation->project->id;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $projectId;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetups = Meetup::where('project_id', $this->getProjectId())
            ->orderBy('id', 'desc')
            ->get();

        return view('meetups.index', [
            'meetups' => $meetups,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function meetupRequests(Request $request)
    {
        $projectId = $this->getProjectId();
        if ($request->ajax()) {

            $meetups = Meetup::whereDate('event_start', '>=', $request->start)
                ->whereDate('event_end',   '<=', $request->end)
                ->where('project_id', $projectId)
                ->get();

            $data = array();
            foreach ($meetups as $key => $meetup) {
                $data[] = [
                    'id' => $key,
                    'title' => $meetup->title,
                    'start' => $meetup->event_start,
                    'end' => $meetup->event_end,
                ];
            }

            return response()->json($data);
        }

        return view('meetups.requests', [
            'projectId' => $projectId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeetupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetupRequest $request)
    {
        /******************* check if previous same days event exists *******************/

        $meetupExists = Meetup::where('project_id', $request->project_id)
            ->whereBetween('event_start', [$request->event_start, $request->event_end])
            ->whereBetween('event_end', [$request->event_start, $request->event_end])
            ->first();

        if ($meetupExists) {
            return response()->json([
                'status' => 409,
            ], 200);
        }

        Meetup::create([
            'project_id' => $request->project_id,
            'title' =>  $request->title,
            'description' =>  $request->description,
            'meet_link' => $request->meet_link,
            'event_start' =>  $request->event_start,
            'event_end' =>  $request->event_end,
        ]);

        return response()->json([
            'status' => 201,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meetup  $meetup
     * @return \Illuminate\Http\Response
     */
    public function show(Meetup $meetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meetup  $meetup
     * @return \Illuminate\Http\Response
     */
    public function edit(Meetup $meetup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeetupRequest  $request
     * @param  \App\Models\Meetup  $meetup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeetupRequest $request, Meetup $meetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meetup  $meetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meetup $meetup)
    {
        $meetup->delete();
        return redirect()->route('faculty.meetups.index')
            ->with('success_message', 'Event Deleted');
    }
}
