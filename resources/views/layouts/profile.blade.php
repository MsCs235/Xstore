@extends('dashboard')
@section('content')

                    <div class="row">
                        @if(Session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <!-- print msg -->
                                {{Session()->get('error')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <!-- print msg -->
                                {{Session()->get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="col-md-3">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                                    <p class="text-muted text-center">{{Auth::user()->rule}}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Account from</b> <a class="float-right">{{Auth::user()->created_at}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Last Upate</b> <a class="float-right">{{Auth::user()->updated_at}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <form class="card p-2" action=" {{route('edit.password')}} " method="post">
                                @csrf
                                <div class="card-head mb-2">
                                    <h6>Change Password</h6>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control"  autocomplete="off"  placeholder="YourPassword" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="newpassword" class="form-control"  autocomplete="off"  placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="confirmpassword" class="form-control"  placeholder="Confarm Password" required>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-danger">Change</button>
                                </div>

                            </form>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                            <div class="tab-content">
                                <!-- right side -->
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{route('update.profile')}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{Auth::user()->name}}" name="name" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="mail"  class="form-control" value="{{Auth::user()->email}}" id="inputEmail" placeholder="Email" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="phone"  class="form-control" value="{{Auth::user()->phone}}" id="inputPhone" placeholder="Phone">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="address"  id="inputExperience" placeholder="Address">{{Auth::user()->address}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="rule" value="{{Auth::user()->rule}}" class="form-control" id="inputRole" placeholder="Role" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" required> I agree to Update my information.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        </div>
                    </div>




@endsection