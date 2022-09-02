@extends('layouts.admin')

@section('title', 'Edit link: ' . config('app.url') . '/' . $link["short_link"])

@section('title_block')
    <a href="{{ route('links.index') }}" class="btn btn-primary float-sm-right"> All links </a>
@endsection

@section('content')
<div class="card  card-primary card-outline">
    <div class="card-body p-0">
<!-- general form elements disabled -->
<div class=" card-warning">
    <!-- /.card-header -->
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <div><i class="icon fa fa-check"></i> {{ session('success') }}</div>
            </div>
            <script defer>
                window.onload = function() {
                    $('.alert').delay(1000).slideUp(300);
                };
            </script>
        @endif

        <form action="{{ route('links.update', $link['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Url</label>
                        <input type="text" name="url" class="form-control" value="{{ $link["url"] }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Short Link</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ config('app.url') }}/</span>
                            </div>
                            <input type="text" name="short_link" class="form-control" value="{{ $link["short_link"] }}" required>
{{--                            <div class="input-group-append">--}}
{{--                                <div class="input-group-text">{{ config('app.url') }}/{{ $link["short_link"] }}</div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input type="checkbox"  name="active" class="form-check-input" id="active" {{ $link->active ? 'checked': '' }}>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
    </div>
</div>
@endsection
