@extends('layout.app')
@section('title', 'Add Class')
@section('main')
    <div class="container p-4">
        <h2 class="text-center">
            Form Add New Class
        </h2>

        <form action="{{ route('class.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Class's Name">
                @error('name')
                    <p class="badge badge-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status1" value="1"
                            checked>
                        Display
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status1" value="0">
                        Hidden
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
