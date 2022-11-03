<!DOCTYPE html>
<html>
<head>
    <title>Invitation email</title>
</head>
<div>
    <h1>You've been invited to join the {{ $invitation->organization->title }} team</h1>
    <p>Join forces with the team and help build your next website.</p>

    <a href="{{ $invitation->url() }}">Join now</a>

    <p>
        You were invited by: <br>
        {{ $invitation->user->name }} <br>
        {{ $invitation->user->email }}
    </p>
</div>
</html>
