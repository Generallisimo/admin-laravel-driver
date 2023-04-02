@extends('admin.layouts')
@section('title', 'drivers')
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
    <div class="col-12">
        <div class="text-center">
            <h1 class="display-3">{{$driver->name}}</h1>
            <h1 class="display-5">{{$driver->phone}}</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Driver Card</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Files</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{ $file->filename }}</td>
                <td>{{ $file->created_at }}</td>
            </tr>
            @endforeach
            <tr>
            <form method="POST" action="{{ route('showDriverUpload', $driver->id) }}" enctype="multipart/form-data">
                @csrf
                    <td><input type="file" name="file[]" multiple></td>
                    <td><button type="submit" class="btn btn-primary">Add file</button></td>
                </form>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection