@extends('layouts.master')

@section('meta', 'Dashboard')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registration</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Registration </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>FYP Registration Form</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (isset($fypRegistration) && $fypRegistration->is_approved == '0' && $fypRegistration->is_rejected == '0')
                            <div class="alert alert-info">Your FYP Registration requets has been send, You will get your
                                registration number via Email</div>
                        @elseif (isset($fypRegistration) && $fypRegistration->is_approved == '1')
                            <div class="alert alert-success">Your FYP Registration requets has been Approved.</div>
                        @elseif (isset($fypRegistration) && $fypRegistration->is_approved == '0' && $fypRegistration->is_rejected == '1')
                            <div class="alert alert-danger">Your FYP Registration requets has been Rejected.</div>
                            <div class="py-3 mb-3 px-4">
                                <p><b>Remarks: </b> <span class="text-danger">{{ $fypRegistration->remarks }}</span></p>
                                <br />
                                <div>By:
                                    {{ $fypRegistration->is_rejected ? $fypRegistration->rejectedBy->name : 'Unknown' }}
                                </div>
                                <div>Date: {{ $fypRegistration->updated_at->format('M d, Y') }}</div>
                            </div>
                        @endif
                        @if (!isset($fypRegistration) || (isset($fypRegistration) && $fypRegistration->is_rejected == '1'))

                            <form action="{{ route('registration.store') }}" method="POST">
                                @csrf
                                <div id="step-1">

                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input disabled type="text" value="{{ $user->name }}" id="name"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Roll
                                                Number
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input disabled type="text" id="phone"
                                                    value="{{ $student->roll_number }}" class="form-control ">
                                                <input type="hidden" id="" value="{{ $student->id }}"
                                                    name="student_id" class="form-control ">
                                                <input type="hidden" id=""
                                                    value="{{ isset($fypRegistration) ? $fypRegistration->id : '' }}"
                                                    name="registration_id" class="form-control ">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <div id="gender" class="btn-group" data-toggle="buttons">

                                                    @if (!isset($user->gender))
                                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" required value="male"
                                                                class="join-btn">
                                                            &nbsp; Male
                                                            &nbsp;
                                                        </label>
                                                        <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" required value="female"
                                                                class="join-btn">
                                                            Female
                                                        </label>
                                                    @else
                                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" required
                                                                value="{{ $user->gender }}" class="join-btn">
                                                            &nbsp; {{ $user->gender == 'male' ? 'Male' : 'Female' }}
                                                            &nbsp;
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Session
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input disabled id="city" class=" form-control"
                                                    value="{{ $student->sessions->session_name }}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Personal Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="personal_email" class=" form-control" required
                                                    value="{{ isset($fypRegistration) ? $fypRegistration->personal_email : '' }}"
                                                    name="personal_email" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Phone
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="phone" class=" form-control" required
                                                    value="{{ isset($user->phone) ? $user->phone : '' }}" name="phone"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Passed Subjects
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="passed_subjects" title="Total Number of Passed Subjects"
                                                    class=" form-control" required name="passed_subjects" type="number">
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <div id="adddress" class="btn-group" data-toggle="buttons">


                                                <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio" name="address" required
                                                        value="current_residential" id="current_residential"
                                                        class="join-btn">
                                                    &nbsp; Current Residential
                                                    &nbsp;
                                                </label>
                                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio" name="address" required
                                                        value="permanent_address" id="permanent_address"
                                                        class="join-btn">
                                                    Permanent Address
                                                </label>

                                            </div>
                                        </div>
                                    </div> --}}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Current Address
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input title="Current residential address in Lahore"
                                                    id="current_residential" class=" form-control" value=""
                                                    name="current_residential" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Permanent Address
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="permanent_address"
                                                    title="Permanent address (Especially if you do not belong to Lahore)"
                                                    class=" form-control" value="" name="permanent_address"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="form-group row px-5">
                                    <label class="col-form-label label-align"> Agreement
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="">
                                        I hereby request the department of computer science to register me for my BSCS/MCS
                                        final
                                        year project so that I can start working on my FYP proposal. I declare that all data
                                        provided here is true and accurate. I understand the meaning and consequences of the
                                        act
                                        of
                                        plagiarism in academic works and I do solemnly declare and promise not to indulge
                                        directly
                                        or indirectly in any acts of plagiarism and other foul activities that are
                                        disallowed by
                                        the
                                        university. I understand that I have to complete my FYP within the instructed time.
                                        I
                                        have
                                        also attached my latest photograph and my latest transcript with this application.
                                    </div>
                                    <div class="m-3">
                                        <input type="checkbox" required class=" mr-2" name="agreement" class=""
                                            id="">
                                        <span>I Agree to all the above statments.</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif



                    </div>

                </div>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registration Details</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @if (isset($fypRegistration) && $fypRegistration->is_approved == '1')
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">FYP Registration ID
                                        </label>
                                        <div class="d-block">
                                            <input disabled type="text" id="phone"
                                                value="{{ $fypRegistration->registration_number }}" name="phone"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Registration Date
                                        </label>
                                        <div class="d-block">
                                            <input disabled type="text" id="phone"
                                                value="{{ $fypRegistration->registration_date->format('d/m/Y') }}"
                                                name="phone" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Agreement
                                        </label>
                                        <div class="d-block">
                                            <input disabled type="text" id="phone"
                                                value="{{ $fypRegistration->fyp_student_agreement == '1' ? 'Signed' : 'Not Signed' }}"
                                                name="phone" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Personal Email
                                        </label>
                                        <div class="d-block">
                                            <input disabled type="text" id="phone"
                                                value="{{ $fypRegistration->personal_email }}" name="phone"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Passed Subjects
                                        </label>
                                        <div class="d-block">
                                            <input disabled type="text" id="phone"
                                                value="{{ $fypRegistration->passed_subjects }}" name="phone"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Approval
                                        </label>
                                        <div class="d-block">
                                            <input disabled type="text" id="phone"
                                                value="{{ $fypRegistration->is_approved == '0' ? 'Pending' : $fypRegistration->approvedBy->name }}"
                                                name="phone" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Remarks
                                        </label>
                                        <div class="d-block">
                                            <textarea disabled class="form-control" name="" id="" rows="4">{{ $fypRegistration->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">current Residential
                                        </label>
                                        <div class="d-block">
                                            <textarea disabled class="form-control" name="" id="" rows="4">{{ $fypRegistration->current_residential }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                        <label class="d-block" for="phone">Permanent Address
                                        </label>
                                        <div class="d-block">
                                            <div class="d-block">
                                                <textarea disabled class="form-control" name="" id="" rows="4">{{ $fypRegistration->permanent_address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif



                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @error('personal_email')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('gender')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('agreement')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('phone')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('current_residential')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('permanent_address')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
@endsection
