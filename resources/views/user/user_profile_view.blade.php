@extends('user.user_master')
@section('title', 'Profile')
@section('user')

<div class="section-block mb-5"></div>
<div class="dashboard-heading mb-5">
    <h3 class="fs-22 font-weight-semi-bold">My Profile</h3>
</div>
<div class="profile-detail mb-5">
    <ul class="generic-list-item generic-list-item-flash">
        <li><span class="profile-name">Name:</span><span class="profile-desc">{{ $user->name ?? 'Not available' }}</span></li>
        <li><span class="profile-name">User Name:</span><span class="profile-desc">{{ $user->username ?? 'Not available' }}</span></li>
        <li><span class="profile-name">Email:</span><span class="profile-desc">{{ $user->email ?? 'Not available' }}</span></li>
        <li><span class="profile-name">Phone Number:</span><span class="profile-desc">{{ $user->phone_number ?? 'Not available' }}</span></li>
        <li>
            <span class="profile-name">Bio:</span>
            <span class="profile-desc">{{ $user->bio ?? 'Not available' }}</span>
        </li>
        
        <li><span class="profile-name">Registration Date:</span><span class="profile-desc">
            {{ optional($user->created_at)->format('D d M Y, h:i:s A') ?? 'Not available' }}
        </span></li>
    </ul>
</div>

<div class="section-block mb-5"></div>
@endsection
