@extends('layouts.app')
@section('content')



<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ad Location & Contact Details</h2>
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
			
			

	<form method="post" action="{{ route('post.ad') }}" onsubmit="return validate()">
	@csrf
			<!-- Notice -->
			<div class="notification notice closeable margin-bottom-40">
				<p>Please enter your contact and location information below and click on 'Next' button to save the ad and continue to the image upload page. Fields marked with an asterisk (*) are mandatory.</p>
			    <p class="note">.</p>
			</div>


			<!-- Email -->
			<div class="form">
				<h5>State</h5>
				<select name="state" id="state" onchange="getDistrict(this.value)" class="chosen-select-no-single">
				 <option value=""></option>
				 @foreach($state as $row)
				  <option @if(old('state') == $row->state) {{'selected'}} @endif value="{{$row->state}}">{{ ucwords($row->state) }}</option>
				 @endforeach
			    </select>
			</div>
			
			<div class="form">
				<h5>District</h5>
				<select name="district" id="district" onchange="getLocation(this.value)" class="chosen-select-no-single">
				 <option value=""></option>
			    </select>
			</div>
			<div class="form">
				<h5>Location</h5>
				<select name="location" id="location" class="chosen-select-no-single">
				 <option value=""></option>
			    </select>
			</div>

			<div class="divider margin-top-5 margin-bottom-15"></div>
			<div class="form">
				<h5><b>How would you like to be contacted for this Ad ?</b></span></h5>
			</div>
			<!-- Location -->
			<div class="form">
				<h5>Email </span></h5>
				<input maxlength="100" name="email" id="email" class="search-field" type="text" placeholder="enter your email" value="{{ old('email') }}"/>
			   <p class="note">Email is optional and can be left empty, but if entered, it will be displayed in the Ad.</p>
			</div>
			
             <div class="form">
				<h5>Main Telephone Number</h5>
				<input maxlength="100" name="main_phone_number" id="main_phone_number" class="search-field" type="text" placeholder="Enter Main Telephone Number" value="{{ old('main_phone_number') }}"/>
			    <p class="note">Main Telephone number is optional and can be left empty, but if entered, it must contain only numbers and will be displayed in the Ad.</p>
			</div>
			
			 <div class="form">
				<h5>Other Telephone Number</h5>
				<input name="other_phone_number" id="other_phone_number" class="search-field" type="text"  placeholder="Enter Other Telephone Number" value="{{ old('other_phone_number') }}"/>
			    <p class="note">Main Telephone number is optional and can be left empty, but if entered, it must contain only numbers and will be displayed in the Ad.</p>
			</div>
				
			<div class="divider margin-top-0"></div>
			<button type="submit" class="button big margin-top-5" style="float:right;">Next <i class="fa fa-arrow-circle-right"></i></button>

</form>

		</div>
	</div>

</div>
@endsection

@section('dynamicjs')

<script type="text/javascript">
function validate () {	
$('#error_mess').hide();
var breed = $('#breed').val();
var years = $('#years').val();
var month = $('#month').val();
var title = $('#title').val();
var description = $('#description').val();
var price = $('#price').val();
var error = '';
if (breed == "") {
  error = error + 'Breed is a required field.<br />';
}

if (years == "" && month =="") {
  error = error + 'The Year/Months field is required.<br />';
}

if (title == "") {
  error = error + 'The Title field is required.<br />';
}

if (description == "" ) {
  error = error + 'The Description field is required.<br />';
}

if (price == "" ) {
  error = error + 'The Asking Price field is required.<br />';
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
      $("#price").bind("keypress keyup blur", function (event) {
		 $(this).val($(this).val().replace(/[^\d].+/, ""));	            
         if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
      });    
 });
 
 
 
 function getDistrict (a) {
  
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
  });
}
 }
 
 function getLocation (a) {
	if (a!="") {
	  $.post("{{ route('post.getlocation') }}",
	  {
		"_token": "{{ csrf_token() }}",
		"district": a
	  },
	  function(data, status) {
		 $('#location').html(data);
		 $('#location').trigger("chosen:updated");
	  });
	}
 }
  

</script>


@endsection

