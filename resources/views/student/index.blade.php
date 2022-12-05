@extends('layout.app')
@section('title', 'Student')
@section('main')
    <div class="container-fluid p-4">
        @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-3">
                <div class="jumbotron text-center">
                    <h2>{{ $totalStudents }}</h2>
                    <p class="lead">Total Students </p>
                </div>
            </div>
        </div>
        <a href="{{ route('student.add') }}" class="btn btn-success">&plus;</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->password }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->className }}</td>
                        <td>
                            <form action="{{ route('student.delete', $item->id) }}" method="post">
                                <a href="{{ route('student.edit', $item->id) }}" class="btn btn-success">Update</a>
                                @method('DELETE') @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Do You Want to delete This Student ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $students->links() }}
    </div>
@endsection
