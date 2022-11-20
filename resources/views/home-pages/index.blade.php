@extends('app')
@section('title')
	Home Page
@endsection
@section('css')
<link href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@if (session()->has('message'))
	<x-alert type="success" :message="session()->get('message')" />
@endif 
<div class="text-right mb-3">
	<a href="{{ route('home-pages.create') }}" class="btn btn-primary">
	    <i class="fas fa-plus"></i> Create Home Page
	</a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="homePageTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Website Link</th>
                        <th width="20%">Title</th>
                        <th width="5%">Banner</th>
                        <th width="50%">Content</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($homePages as $homePage)
					    <tr>
	                        <td>{{ $homePage->id }}</td>
	                        <td><a href="https://{{ $homePage->website_link }}" target="_blank">{{ $homePage->website_link }}</a></td>
	                        <td>{{ $homePage->title }}</td>
	                        <td><img src="{{ $homePage->banner }}" width="65px" height="65px"></td>
	                        <td>{!! Str::limit($homePage->content, 250, ' ...') !!}</td>
	                        <td>
	                        	<a href="{{ route('home-pages.edit', $homePage->id) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
	                        	<form method="POST" class="d-inline" action="{{ route('home-pages.delete', $homePage->id) }}">
	                        		@csrf
	                        		@method('DELETE')
	                        		<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></button>
	                        	</form>
	                        </td>
	                    </tr>
					@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#homePageTable').DataTable();
});
</script>
@endsection