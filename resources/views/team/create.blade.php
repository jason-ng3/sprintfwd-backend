@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Create a New Team</h1>
    <form action="/teams" method="POST">
        @csrf

        <div class="form-group">
            <label for="team-name">Team Name:</label>
            <input type="text" class="form-control" id="team-name" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Team</button>
    </form>
</div>

@endsection
