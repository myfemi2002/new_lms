@extends('admin.admin_master')
@section('title', 'SMTP Settings')
@section('admin')

<div class="content container-fluid">
    <div class="page-header">
        <div class="content-page-header">
            <h5>@yield('title')</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.smtp') }}" method="POST">@csrf

                    <input type="hidden" name="id" value="{{ $smtp->id }}">

                        <div class="form-group-item border-0 mb-0">
                            <div class="row align-item-center">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Mailer</label>
                                        <input type="text" name="mailer" class="form-control" value="{{ $smtp->mailer }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Host</label>
                                        <input type="text" name="host" class="form-control"  value="{{ $smtp->host }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Port</label>
                                        <input type="text" name="port" class="form-control"  value="{{ $smtp->port }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Username </label>
                                        <input type="text" name="username" class="form-control"  value="{{ $smtp->username }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" value="{{ $smtp->password }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Encryption</label>
                                        <input type="text" name="encryption" class="form-control" value="{{ $smtp->encryption}}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>From Address</label>
                                        <input type="text" name="from_address" class="form-control" value="{{ $smtp->from_address}}">
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="add-customer-btns text-end">
                            <button type="submit" class="btn customer-btn-save">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection