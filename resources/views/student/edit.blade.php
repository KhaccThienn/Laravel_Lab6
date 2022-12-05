@extends('layout.app')
@section('title', 'Add Student')
@section('main')
    <div class="container p-4">
        <h2 class="text-center">
            Form Update Student: {{ $student->name }}
        </h2>

        <form action="{{ route('student.update', $student->id) }}" method="post">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Student's Name"
                    value="{{ $student->name }}">
                @error('name')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Student's Email"
                    value="{{ $student->email }}">
                @error('email')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Student's Password"
                    value="{{ $student->password }}">
                @error('password')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    placeholder="Student's Phone Number" value="{{ $student->phone }}">
                @error('phone')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="10" placeholder="Student's Address">{{ $student->address }}</textarea>
            </div>

            <div class="form-group">
                <label for="class_id">Class</label>
                <select class="form-control" name="class_id" id="class_id">
                    @foreach ($classes as $cls)
                        @if ($student->class_id == $cls->id)
                            <option value="{{ $cls->id }}" selected>{{ $cls->id }} - {{ $cls->name }}
                            </option>
                        @else
                            <option value="{{ $cls->id }}">{{ $cls->id }} - {{ $cls->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-4">Submit</button>
        </form>
    </div>
@endsection
