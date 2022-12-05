@extends('layout.app')
@section('title', 'Add Student')
@section('main')
    <div class="container p-4">
        <h2 class="text-center">
            Form Add New Student
        </h2>

        <form action="{{ route('student.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Student's Name">
                @error('name')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Student's Email">
                @error('email')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Student's Password">
                @error('password')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    placeholder="Student's Phone Number">
                @error('phone')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="10" placeholder="Student's Address"></textarea>
            </div>

            <div class="form-group">
                <label for="class_id">Class</label>
                <select class="form-control" name="class_id" id="class_id">
                    @foreach ($classes as $cls)
                        <option value="{{ $cls->id }}">{{ $cls->id }} - {{ $cls->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-4">Submit</button>
        </form>
    </div>
@endsection
