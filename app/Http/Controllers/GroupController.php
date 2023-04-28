<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\FypRegistrationNumber;
use App\Models\RequestLog;
use App\Models\Student;
use App\Models\StudentHasGroup;
use App\Models\User;
use App\Notifications\GroupInvitationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student =  Student::where('user_id', auth()->user()->id)->first();
        $group = $student->group;
        $approvedStudent = FypRegistrationNumber::where('student_id', $student->id)
            ->where('is_approved', '1')
            ->exists();

        $invitations = RequestLog::where('type', 'GroupInvitationNotification')
            ->where('user_id', auth()->user()->id)
            ->where('marked_check', '0')
            ->get();

        return view('groups.index', [
            'group' => $group,
            'invitations' => $invitations,
            'approvedStudent' => $approvedStudent
        ]);
    }

    public function indexAll()
    {
        return view('groups.index-all', [
            'groups' => Group::all(),
        ]);
    }

    public function sendGroupInvitation(Request $request)
    {
        $student = Student::where('roll_number', $request->roll_number)->first();

        if ($student->group) {
            return response([
                'status' => 404,
            ], 200);
        }

        $user = User::find($student->user_id);

        if (!$user) {
            return response(404);
        }

        if (!FypRegistrationNumber::where('student_id', $student->id)->where('is_approved', '1')->exists()) {
            return response([
                'status' => 405,
            ], 200);
        }

        if (RequestLog::where('user_id', $user->id)->where('marked_check', '1')->exists()) {
            return response([
                'status' => 402,
            ], 200);
        }

        if (RequestLog::where('user_id', $user->id)->where('marked_check', '0')->exists()) {
            return response([
                'status' => 401,
            ], 200);
        }

        $fromStudent = Student::where('user_id', auth()->user()->id)->first();

        if (StudentHasGroup::where('group_id', $fromStudent->group->id)->count() >= (int)$fromStudent->department->group_limit) {
            return response([
                'status' => 403,
            ], 200);
        }


        $jsonContent = [
            'student_id' => $fromStudent->id,
            'name' => $fromStudent->user->name,
            'roll_number' => $fromStudent->roll_number,
            'group_id' => $fromStudent->group->id,
            'group_name' => $fromStudent->group->name
        ];

        RequestLog::create([
            'user_id' => $user->id,
            'type' => 'GroupInvitationNotification',
            'content' => $jsonContent,
        ]);

        Notification::send($user, new GroupInvitationNotification(auth()->user()));

        return response([
            'status' => 200,
            'message' => 'Invitation Sent'
        ], 200);
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
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $student = Student::where('user_id', auth()->user()->id)->first();

        $group = Group::create([
            'name' => $request->group_name,
            'bio' => $request->group_bio
        ]);

        StudentHasGroup::create([
            'student_id' => $student->id,
            'group_id' => $group->id
        ]);

        return redirect()->route('groups.index')
            ->with('success_message', 'Group Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    public function acceptGroupInvitation($id)
    {
        $invitation = RequestLog::find($id);

        if (!$invitation) {
            return back()->with('error_message', 'Bad Request');
        }

        $student = Student::where('user_id', $invitation->user_id)->first();

        if (StudentHasGroup::where('group_id', $invitation->content->group_id)->count() >= (int)$student->department->group_limit) {
            return back()->with('error_message', 'Group has reached max limit');
        }

        StudentHasGroup::create([
            'student_id' => $student->id,
            'group_id' => $invitation->content->group_id
        ]);

        $invitation->update([
            'marked_check' => 1
        ]);

        return back()->with('success_message', 'Request Accepted');
    }

    public function rejectGroupInvitation($id)
    {
        $invitation = RequestLog::find($id);

        if (!$invitation) {
            return back()->with('error_message', 'Bad Request');
        }

        $invitation->update([
            'marked_check' => 1
        ]);

        return back()->with('success_message', 'Request Rejected');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
