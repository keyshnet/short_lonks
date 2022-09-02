@extends('layouts.admin')

@section('title', 'Links')

@section('title_block')
    <a href="{{ route('links.create') }}" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Link </a>
@endsection

@section('content')
<div class="card  card-primary card-outline">
    <div class="card-body p-0">
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
    <table class="table table-bordered table-striped projects" id="example2" style="width:100%">
        <thead>
        <tr>
            <th class="all">#</th>
            <th class="all">Short Link</th>
            <th class="desktop">URL</th>
            <th class="desktop">Used</th>
            <th class="desktop">Active</th>
            <th class="all"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($links as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                <div class="input-group mb-2">
                    <input type="text" id="copyblock-{{ $item->id }}" value="{{ config('app.url') }}/{{ $item->short_link }}" class="form-control" style="" readonly>
                    <div class="input-group-append">
                        <button class="btn copybtn input-group-text" data-clipboard-target="#copyblock-{{ $item->id }}" title="Copy Link">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <div class="input-group-append">
                        <a href="{{ config('app.url') }}/{{ $item->short_link }}" class="btn input-group-text" target="_blank" title="Show Link"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
                <small class=" d-sm-block d-md-none mb-2" style="word-break: break-all;">{{ config('app.url') }}/{{ $item->short_link }}<br/></small>
                <small>Created {{ $item->created_at }}</small></td>
            <td><span  style="word-break: break-all;">{{ $item->url }}</span></td>
            <td>{{ $item->clicks }}</td>
            <td>{{ $item->active ? 'Yes': 'No' }}</td>
            <td class="project-actions text-right">
                <a class="btn btn-info btn-sm" href="{{ route('links.edit', $item->id) }}">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a>
                <form method="POST" action="{{ route('links.destroy', $item->id) }}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger btn-sm delete-btn" href="{{ route('links.destroy', $item->id) }}"
                       onclick="event.preventDefault();
                                if(!confirm('Delete Link?')) return false;
                                this.closest('form').submit();">
                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                    </a>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection

@section('page-scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <style>
        .dataTables_length, .dataTables_filter{
            padding: 0 20px;
        }
    </style>
@endsection
