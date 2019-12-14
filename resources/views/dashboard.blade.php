@extends('layouts.app')
@section('content')



<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Post New Ad</h2>
		</div>

	</div>
</div>


<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">
			
    <div id="error_mess" style="display:none;" class="notification error closeable margin-bottom-40">
		<p style="padding-bottom:10px;"><B>We found the following errors in your ad. Please correct the errors below and save the ad again.</B></p>
		<p id="error_p"></p>
	</div>			
			
	 @if ($errors->any())
    <div class="notification error closeable margin-bottom-10">
		<p style="padding-bottom:10px;"><B>We found the following errors in your ad. Please correct the errors below and save the ad again</B></p>
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
				<p>Please enter your ad details below and click on 'Next' button to save the ad and continue to the Location and Contact Details. Fields marked with an asterisk (*) are mandatory.</p>
			</div>


			<!-- Email -->
			<div class="form">
				<h5>Dog Bread *</h5>
				<select name="breed" id="breed" class="chosen-select-no-single">
				<option value=""></option>
				@foreach($breads as $row)
				  <option @if(old('breed') == $row->breed) {{'selected'}} @endif value="{{$row->breed}}">{{$row->breed}}</option>
				@endforeach
			</select>

			</div>

			<!-- Title -->
			<div class="form" >
				<h5>Dogs Age *</h5>
				<div class="one-third column" style="margin-left:0px;">
					<select name="years" id="years" class="chosen-select-no-single">
						<option value="">Years</option>
						<option @if(old('years') == 1) {{'selected'}} @endif  value="1">1 Year</option>
						<option @if(old('years') == 2) {{'selected'}} @endif  value="2">2 Years</option>
						<option @if(old('years') == 3) {{'selected'}} @endif  value="3">3 Years</option>
						<option @if(old('years') == 4) {{'selected'}} @endif  value="4">4 Years</option>
						<option @if(old('years') == 5) {{'selected'}} @endif  value="5">5 Years</option>
						<option @if(old('years') == 6) {{'selected'}} @endif  value="6">6 Years</option>
						<option @if(old('years') == 7) {{'selected'}} @endif value="7">7 Years</option>
						<option @if(old('years') == 8) {{'selected'}} @endif value="8">8 Years</option>
						<option @if(old('years') == 9) {{'selected'}} @endif value="9">9 Years</option>
						<option @if(old('years') == 10) {{'selected'}} @endif value="10">10 Years</option>
						<option @if(old('years') == '10+') {{'selected'}} @endif value="10+">10+ Years</option>
					</select>
				</div>
				<div class="one-third column">
					<select name="month" id="month" class="chosen-select-no-single">
						<option value="">Months</option>
						<option @if(old('month') == 1) {{'selected'}} @endif  value="1">1 Month</option>
						<option @if(old('month') == 2) {{'selected'}} @endif  value="2">2 Months</option>
						<option @if(old('month') == 3) {{'selected'}} @endif  value="3">3 Months</option>
						<option @if(old('month') == 4) {{'selected'}} @endif  value="4">4 Months</option>
						<option @if(old('month') == 5) {{'selected'}} @endif  value="5">5 Months</option>
						<option @if(old('month') == 6) {{'selected'}} @endif  value="6">6 Months</option>
						<option @if(old('month') == 7) {{'selected'}} @endif value="7">7 Months</option>
						<option @if(old('month') == 8) {{'selected'}} @endif value="8">8 Months</option>
						<option @if(old('month') == 9) {{'selected'}} @endif value="9">9 Months</option>
						<option @if(old('month') == 10) {{'selected'}} @endif value="10">10 Months</option>
						<option @if(old('month') == 11) {{'selected'}} @endif value="11">11 Months</option>
					</select>
				</div>
				<div style="width:100%;">&nbsp;</div>
			</div>

			<!-- Location -->
			<div class="form">
				<h5>Ad Headline / Title *</span></h5>
				<input maxlength="100" name="title" id="title" class="search-field" type="text" placeholder="Ad Headline / Title" value="{{ old('title') }}"/>
			   <p class="note">Please enter your ad title. Ad title can have maximum of 100 characters.</p>
			</div>
			
             <div class="form">
				<h5>Ad Description *</h5>
				<textarea   name="description" cols="40" rows="12" placeholder="Ad Description"  id="description" >{{ old('description') }}</textarea>
			    <p class="note">Please enter a detail description of your dog. Ad description should have minimum character length of 100.</p>
			</div>
			
			 <div class="form">
				<h5>Asking Price (&#8377;)*</h5>
				<input name="price" id="price" class="search-field" type="text"  placeholder="Asking price" value="{{ old('price') }}"/>
			    <p class="note">Please enter the asking price in rupee, must be numeric only.</p>
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

    

</script>


@endsection

