@extends('layouts.Dashboard.main')
@section('title', 'افزودن ماژول جدید | سیستم ارتباط با مشتریان آرگون')

@section('pageContent')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.modules.installModule', ['type' => $type]) }}" method="POST" @isset( $type ) enctype="multipart/form-data" @endisset>
                @csrf

                @error('not-exist')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-air-baloon"></i></span>
                        <span class="alert-text">
                            <strong>Error!</strong>
                            <span>This below files does not exist in uploaded module</span>
                            <br>
                            <div style="display: grid; grid-template-columns: repeat(3 ,1fr)">
                                @foreach(explode(',', $message) as $file)
                                    <span>{{ $file }}</span>
                                @endforeach
                            </div>
                        </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror

                @isset( $type )
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label"><strong>Module File</strong></label>
                        <input name="module" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" type="file" required>
                        @error('module')
                            <small id="required" class="form-text text-danger text-capitalize">{{ $message }}</small>
                        @enderror
                    </div>
                @else
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label"><strong>Module name</strong></label>
                        <input name="name"
                               class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                               placeholder="Write department name here" id="example-text-input" required>
                        @error('name')
                            <small id="required" class="form-text text-danger text-capitalize">{{ $message }}</small>
                        @enderror
                    </div>
                @endisset
                <button class="btn btn-icon btn-primary" type="submit">
                    <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                    <span class="btn-inner--text">Add New Module</span>
                </button>
            </form>
        </div>
    </div>
@endsection
