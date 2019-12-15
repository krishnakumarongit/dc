@extends('layouts.app')
@section('content')



<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Upload Ad Image's</h2>
		</div>

	</div>
</div>


<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">
			
    <div id="error_mess" style="display:none;" class="notification error closeable margin-bottom-40">
		<p style="padding-bottom:10px;"><B>We found the following errors in your form.</B></p>
		<p id="error_p"></p>
	</div>			
			
	@if ($errors->any())
		<div class="notification error closeable margin-bottom-10">
			<p style="padding-bottom:10px;"><B>We found the following errors in your form.</B></p>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif


	@if( session('status') )
		<div class="notification success closeable margin-bottom-10">
			<p style="padding-bottom:10px;"><B></B></p>
			<ul>
				<li>{{ session('status') }}</li>
			</ul>
		</div>		
	@else
		<!-- Notice -->
		<div class="notification notice closeable margin-bottom-40">
			<p>Please upload Ad images and click on 'Save' button to publish your ad. Fields marked with an asterisk (*) are mandatory.</p>
		</div>
    @endif
    
    
    	@if(($image1 != "" && file_exists(public_path().'/ads/'.$image1)) or ($image2 != "" && file_exists(public_path().'/ads/'.$image2)) or ($image3 != "" && file_exists(public_path().'/ads/'.$image3))   )
		<a href="{{ route('publish',['id' => $id])}}" onclick="return confirm('Are you sure to publish this ad ?')"><button type="button" class="button big margin-top-5" style="float:right;">Save & Publish<i class="fa fa-arrow-circle-up"></i></button></a>
		@endif

	<!-- Email -->
	<div class="form">
		<h5>Upload Ad Images</h5>
	</div>

<div class="sixteen columns" style="padding-top:15px;">
	
<div class="form">
<div class="one-forth column" style="background:#ccc;padding:10px;">
@if($image1 != "" && file_exists(public_path().'/ads/'.$image1))
    <img src="{{ asset('ads/'.$image1) }}" style="width:46px;height:56px;">
@else
	<i onclick="callUpload(1)" style="font-size:45px;color:green;" class="ln ln-icon-File-Upload"></i>
@endif
</div>
<h5>&nbsp;Image 1</h5>
	<form method="post" action="{{ route('post.image-check',['id' => $id]) }}" onsubmit="return validate(1)" enctype="multipart/form-data">
	<input type="hidden" name="input_check" value="1" />
			@csrf
<span>&nbsp;<input accept=".png, .jpg, .jpeg" type="file" name="image" id="image_1" style="margin-top:5px;">&nbsp;
<input type="submit" class="button small" value="Upload" >
@if($image1 != "" && file_exists(public_path().'/ads/'.$image1))
<a href="{{ route('delete-image',['adid' =>$id, 'id' => 1])}}" onclick="return confirm('Are you sure to delete ?')" title="Delete Image"><i style="font-size:21px;color:red;" class="ln ln-icon-File-Trash"></i></a>
@endif
</span>
</form>
</div>

<div class="form">
<div class="one-forth column" style="background:#ccc;padding:10px;">
	@if($image2 != "" && file_exists(public_path().'/ads/'.$image2))
    <img src="{{ asset('ads/'.$image2) }}" style="width:46px;height:56px;">
@else
	<i onclick="callUpload(2)" style="font-size:45px;color:green;" class="ln ln-icon-File-Upload"></i>
@endif
	</div>
<h5>&nbsp;Image 2</h5>
<form method="post" action="{{ route('post.image-check',['id' => $id]) }}" onsubmit="return validate(2)" enctype="multipart/form-data">
<input type="hidden" name="input_check" value="2" />
			@csrf
<span>&nbsp;<input accept=".png, .jpg, .jpeg" type="file" name="image" id="image_2" style="margin-top:5px;">&nbsp;
<input type="submit" class="button small" value="Upload" >
@if($image2 != "" && file_exists(public_path().'/ads/'.$image2))
<a href="{{ route('delete-image',['adid' =>$id, 'id' => 2])}}" onclick="return confirm('Are you sure to delete ?')" title="Delete Image"><i style="font-size:21px;color:red;" class="ln ln-icon-File-Trash"></i></a>
@endif
</span>
</form>
</div>

<div class="form">
<div class="one-forth column" style="background:#ccc;padding:10px;">
	
	@if($image3 != "" && file_exists(public_path().'/ads/'.$image3))
    <img src="{{ asset('ads/'.$image3) }}" style="width:46px;height:56px;">
@else
	<i onclick="callUpload(3)" style="font-size:45px;color:green;" class="ln ln-icon-File-Upload"></i>
@endif
	</div>
<h5>&nbsp;Image 3</h5>
<form method="post"  action="{{ route('post.image-check',['id' => $id]) }}" onsubmit="return validate(3)" enctype="multipart/form-data">
<input type="hidden" name="input_check" value="3" />
			@csrf
<span>&nbsp;<input accept=".png, .jpg, .jpeg" type="file" name="image" id="image_3" style="margin-top:5px;" >&nbsp;
<input type="submit" class="button small" value="Upload" >
@if($image3 != "" && file_exists(public_path().'/ads/'.$image3))
<a href="{{ route('delete-image',['adid' =>$id, 'id' => 3])}}" onclick="return confirm('Are you sure to delete ?')" title="Delete Image"><i style="font-size:21px;color:red;" class="ln ln-icon-File-Trash"></i></a>
@endif
</span>
</form>


</div>

</div>
		@if(($image1 != "" && file_exists(public_path().'/ads/'.$image1)) or ($image2 != "" && file_exists(public_path().'/ads/'.$image2)) or ($image3 != "" && file_exists(public_path().'/ads/'.$image3))   )
			<a href="{{ route('publish',['id' => $id])}}" onclick="return confirm('Are you sure to publish this ad ?')"><button type="button" class="button big margin-top-5" style="float:right;">Save & Publish<i class="fa fa-arrow-circle-up"></i></button></a>
		@endif		
			</div>

			</div>
			<div class="divider margin-top-0"></div>
			
		

		</div>
	</div>

</div>
@endsection

@section('dynamicjs')
<script src="{{ asset('block.js') }}"></script>
<script type="text/javascript">
function validate (a) {	
$('#error_mess').hide();
var img1 = $('#image_1').val();
var img2 = $('#image_2').val();
var img3 = $('#image_3').val();

var error = '';
if(a == 1) {
if (img1 == "") {
  error = error + 'Please upload an Image in Image 1 filed.<br />';
}
}

if(a == 2) {
if (img2 == "") {
  error = error + 'Please upload an Image in Image 2 filed.<br />';
}
}
if(a == 3) {
if (img3 == "") {
  error = error + 'Please upload an Image in Image 3 filed.<br />';
}
}

if (error == "") {
 return true;
}
else {
 $('#error_p').html(error);
 $('#error_mess').show();
 window.scrollTo(0, 0); 
 return false;
}
}

function callUpload(a) {
	$('#image_'+a).trigger('click');
}
</script>
@endsection
