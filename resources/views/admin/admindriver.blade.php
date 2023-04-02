@extends('admin.layouts')
@section('title', 'drivers')
@section('content')
<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <div class="col-12">
        <div class="text-center row">
            <h1 class="h1 col">{{$driver->name}}</h1>
            <h1 class="h1 col">{{$driver->phone}}</h1>
            <div class="col mt-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-default">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Driver Card</h3>
                    <div class="card-tools">
                        <!-- поиск по дате -->
                        <form method="GET" action="{{ route('searchDriverFiles', $driver->id) }}" role="form">
                                <div class="input-group input-group-sm">
                                    <input type="date" name="date" class="form-control float-right datepicker" placeholder="Date">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                        </form>
                    </div>
 
                </div>
            <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Files</th>
                    <th>Date</th>
                    <th><svg style="width:15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{ $file->filename }}</td>
                <td>{{ $file->data }}</td>
                <td>
                    <a href="{{ route('downloadFile', ['id' => $file->id]) }}">Download</a>
                </td>
                <td></td>
            </tr>
            @endforeach
            <tr>
                <!-- делаем провеку для админа и водителя -->
            @if(auth()->user()->hasRole('user'))
            @else
            <form  method="POST" action="{{ route('showDriverUpload', $driver->id) }}" enctype="multipart/form-data">
                @csrf
                    <td><input  type="file" name="file[]" multiple></td>
                    <td> <input type="date" name="date" class="form-control" id="date"></td>
                    <td><button type="submit" class="btn btn-dark">Add file</button></td>
                    <td><a href="{{ route('driver', ['id' => $driver->id]) }}" class="btn btn-dark">Back</a></td>
            </form>
            @endif
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection