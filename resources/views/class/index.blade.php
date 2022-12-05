@extends('layout.app')
@section('title', 'Classes')
@section('main')
    <div class="container p-4">
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
                    <h2>{{ $totalClasses }}</h2>    
                    <p class="lead">Total Classes </p>
                </div>
            </div>
        </div>
        <a href="{{ route('class.add') }}" class="btn btn-success">&plus;</a>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Total Students</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <p class="badge {{ $item->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                {{ $item->ClassStatus }}
                            </p>
                        </td>
                        <td>{{ $item->total }}</td>
                        <td>
                            <form action="{{ route('class.delete', $item->id) }}" method="post">
                                <a href="{{ route('class.edit', $item->id) }}" class="btn btn-success">Update</a>
                                @method('DELETE') @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Do You Want to delete This Class ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $classes->links() }}
    </div>
@endsection
