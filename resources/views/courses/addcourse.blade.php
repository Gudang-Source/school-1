@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        @include('include.left-menu')
        <div class="col-md-8">

                @if( session()->exists('courseAdded') )
                <div class="alert alert-success text-center">course updated</div>
                @endif

            <div class="card">
            <div class="card-header"></div>
            <div class="card-body">

                    <form method="POST" action="{{ url('settings/addcourse')}}">
                        @csrf
                        
                        
                        <div class="form-group-row">

                            <ul>
                                @foreach ($suggestedCourses as $suggestedCourse)
                                    <li>{{$suggestedCourse .' : '}}<input name = "course_name[]" type="checkbox" @error('course_name') is-invalid @enderror value = "{{$suggestedCourse}}"></li>
                                @endforeach
                            </ul>
                            
                        </div>
                        

                        <div class="form-group row">
                            <label for="course_name" class="col-md-4 col-form-label text-md-right">{{ __('add course') }}</label>

                            <div class="col-md-6">
                                <input name="course_name[]" id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror"  value=""  autocomplete="course_name" autofocus placeholder="biology chemistry etc">

                                @error('course_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="class_id" name="class_id" type="hidden" class="form-control" value="{{ $class_id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="semester_id" class="col-md-4 col-form-label text-md-right">
                                        @foreach($schoolSession as $currentSession)
                                          {{ 'select semester for ' .$currentSession->session_name }}
                                        @endforeach
                                </label>
                                <div class="col-md-6">

                                    <select name="semester_id" id="semester_id" class="form-control @error('semester_id') is-invalid @enderror" required>
                                    <option value="">select semester</option>
                                  
                                                @foreach($schoolSession as $currentSession)
                                                    @foreach ($currentSession->semesters as $semester)
                                                        <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                                    @endforeach
                                                @endforeach
                            
                                    </select>

                                    @error('semester_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add course') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                    
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
