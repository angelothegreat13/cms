@extends('app')
@section('title')
	Create Home Page
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div id="validation-errors" class="card text-white shadow mb-3 bg-danger card-body d-none">
</div>
<div class="card shadow mb-4">
	<div class="card-body">
        <form id="homePageForm">
        	@csrf
        	<div class="form-group">
        		<label for="title">Title</label>
		        <input type="text" name="title" id="title" class="form-control" placeholder="Enter page title..." value={{ old('title') }}>
        	</div>
		    <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
		    		<label for="website_link">Website Link</label>
                    <input type="text" class="form-control" name="website_link" id="websiteLink" placeholder="e.g. example.com" value={{ old('website_link') }}>
                </div>
                <div class="col-sm-6">
		    		<label for="banner">Banner</label>
                    <div class="input-group">
						<div class="custom-file">
						    <input type="file" class="custom-file-input" name="banner" id="banner">
						    <label class="custom-file-label" for="banner">Choose file</label>
						</div>
					</div>
                </div>
            </div>
            <div class="form-group">
            	<label for="title">Content</label>
            	<div id="webContent" class="content"></div>
	        </div>
	        <div class="text-right">
	        	<a href="{{ route('home-pages.index') }}" class="btn btn-secondary mr-1">Back to Home Page</a>
                <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
		</form>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('js/home-page-content.js') }}"></script>
<script type="text/javascript">
const storeHomePageURL = {!! json_encode(route('home-pages.store')) !!};

$('#homePageForm').submit(function(e) {
    e.preventDefault();    
    let formData = new FormData(this);
    formData.append('content', $('#webContent').summernote('code'));

    $.ajax({
        url: storeHomePageURL,
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) 
        {
        	if (res.success) {
        		window.location.href = {!! json_encode(route('home-pages.index')) !!};
        	} else {
        		alert('Something went wrong!');
        	}
        },
        error: function (xhr) {
        	let errors = xhr.responseJSON.data.errors;
        	$('#validation-errors').removeClass('d-none');
        	$('#validation-errors').html('');
		   	$.each(errors, function(key,value) {
		    	$('#validation-errors').append('<li>'+value+'</li');
		 	}); 
        }
    });
});
</script>
@endsection