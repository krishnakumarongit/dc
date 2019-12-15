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
			
			

	<form method="post" action="{{ route('post.validatelocation',['id' => $id]) }}" onsubmit="return validate1()">
			@csrf
			<!-- Notice -->
			<div class="notification notice closeable margin-bottom-40">
				<p>Please upload Ad images and click on 'Save' button to publish your ad. Fields marked with an asterisk (*) are mandatory.</p>
			</div>
			<!-- Email -->
			<div class="form">
				<h5>Upload Ad Images</h5>
			</div>

<div class="sixteen columns" style="padding-top:15px;">
<div class="form">
<div class="one-forth column" style="background:#ccc;padding:10px;"><i style="font-size:45px;color:green;" class="ln ln-icon-File-Upload"></i></div>
<h5>&nbsp;Image 1</h5>
<span>&nbsp;<input type="file" style="margin-top:5px;"></span>
</div>

<div class="form">
<div class="one-forth column" style="background:#ccc;padding:10px;"><i style="font-size:45px;color:green;" class="ln ln-icon-File-Upload"></i></div>
<h5>&nbsp;Image 2</h5>
<span>&nbsp;<input type="file" style="margin-top:5px;"></span>
</div>

<div class="form">
<div class="one-forth column" style="background:#ccc;padding:10px;"><i style="font-size:45px;color:green;" class="ln ln-icon-File-Upload"></i></div>
<h5>&nbsp;Image 3</h5>
<span>&nbsp;<input type="file" style="margin-top:5px;" ></span>
</div>

</div>
				
			</div>

			</div>
			<div class="divider margin-top-0"></div>
			<button type="submit" class="button big margin-top-5" style="float:right;">Save <i class="fa fa-arrow-circle-up"></i></button>

</form>

		</div>
	</div>

</div>
@endsection

@section('dynamicjs')
<script src="{{ asset('block.js') }}"></script>
<script type="text/javascript">
function validate () {	
$('#error_mess').hide();
var state = $('#state').val();
var district = $('#district').val();
var location = $('#location').val();
var email = $('#email').val();
var main_phone_number = $('#main_phone_number').val();
var other_phone_number = $('#other_phone_number').val();

var error = '';
if (state == "") {
  error = error + 'The State field is required.<br />';
}

if (district == "" ) {
  error = error + 'The District field is required.<br />';
}

if (location == "") {
  error = error + 'The Location field is required.<br />';
}

if (email != "" ) {
  if (!ValidateEmail(email)) {
      error = error + 'Invalid Email address.<br />';
  }
}

if (main_phone_number != "" ) {
  if (main_phone_number.length < 9 ) {
      error = error + 'Invalid Main phone number.<br />';
  }
}

if (other_phone_number != "" ) {
  if (other_phone_number.length < 9 ) {
      error = error + 'Invalid Other phone number.<br />';
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

 $(document).ready(function() {
      $(".telphone").bind("keypress keyup blur", function (event) {
		 $(this).val($(this).val().replace(/[^\d].+/, ""));	            
         if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
      });    
 });
 
 
function ValidateEmail(mail) 
{
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return true;
  }
  return false;
}
 
 
 
 function getDistrict (a) {
	 
  $('.chosen-container').block({ message: null }); 
  if (a!="") {
  $.post("{{ route('post.getdistrict') }}",
  {
    "_token": "{{ csrf_token() }}",
    "state": a
  },
  function(data, status) {
	 $('#district').html(data);
	 $('#location').html('<option value=""></option>');
	 $('#location').trigger("chosen:updated");
     $('#district').trigger("chosen:updated");
     $('.chosen-container').unblock(); 
  });
  }
 }
 
 function getLocation (a) {
	$('.chosen-container').block({ message: null }); 
	if (a!="") {
	  $.post("{{ route('post.getlocation') }}",
	  {
		"_token": "{{ csrf_token() }}",
		"district": a
	  },
	  function(data, status) {
		 $('#location').html(data);
		 $('#location').trigger("chosen:updated");
		 $('.chosen-container').unblock(); 
	  });
	}
 } 
</script>


@endsection

