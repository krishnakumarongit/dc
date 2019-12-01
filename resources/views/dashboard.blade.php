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

			<!-- Notice -->
			<div class="notification notice closeable margin-bottom-40">
				<p>Please enter your ad details below and click on 'Next' button to save the ad and continue to the location page. Fields marked with an asterisk (*) are mandatory.</p>
			</div>


			<!-- Email -->
			<div class="form">
				<h5>Dog Bread *</h5>
				<select name="bread" id="bre" class="chosen-select-no-single">
				<option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>

			</div>

			<!-- Title -->
			<div class="form" >
				<h5>Dogs Age *</h5>
				<div class="one-third column" style="margin-left:0px;">
					<select name="years" id="years" class="chosen-select-no-single">
						<option value=""></option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="one-third column">
					<select name="month" id="month" class="chosen-select-no-single">
						<option value=""></option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div style="width:100%;">&nbsp;</div>
			</div>

			<!-- Location -->
			<div class="form">
				<h5>Ad Headline / Title *</span></h5>
				<input maxlength="75" name="title" id="title" class="search-field" type="text" placeholder="Ad Headline / Title" title="Please enter your ad title. Ad title can have maximum of 75 characters." value=""/>
			</div>
			
             <div class="form">
				<h5>Ad Description *</h5>
				<textarea title="Please enter a detail description of your dog. Ad description should have minimum character length of 100."  name="description" cols="40" rows="12" placeholder="Ad Description"  id="description" ></textarea>
			</div>
			
			 <div class="form">
				<h5>Asking Price (&#8377;)*</h5>
				<input name="price" id="price" class="search-field" type="text" title="Please enter the asking price in rupee, must be numeric only" placeholder="Asking price" value=""/>
			</div>
			
	
			<div class="divider margin-top-0"></div>
			<a href="#" class="button big margin-top-5" style="float:right;">Next <i class="fa fa-arrow-circle-right"></i></a>



		</div>
	</div>

</div>




    <!-- link rel="stylesheet" type="text/css" href="{{ asset('croppie.css') }}" >

	<div class="container" id="div1">
		<form method="post" action="{{ route('add.param', ['id' => $id]) }}" id="step1">
		    @csrf
			<br />
			<select name="years" id="years">
				<option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<select name="month" id="month">
				<option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select><br />
			<input type="text" name="title" id="title" /><br />
			<textarea name="description" id="description"></textarea><br />
			<input type="submit" value="submit">
		</form>
		<a href="javascript:void(0);" onclick="show('div2')">Next >></a>
	</div>
	
	<div class="container" id="div2" style="display:none;">
		<form method="post" action="{{ route('add.location', ['id' => $id]) }}" id="step2">
		    @csrf
			<select name="state" id="state">
				<option value=""></option>
				<option value="1">s1</option>
				<option value="2">s2</option>
			</select><br />
			<select name="district" id="district">
				<option value=""></option>
				<option value="1">d1</option>
				<option value="2">d2</option>
			</select><br />
			<select name="locality" id="locality">
				<option value=""></option>
				<option value="1">l1</option>
				<option value="2">l2</option>
			</select><br />
			<input type="submit" value="submit">
		</form>
		<a href="javascript:void(0);" onclick="show('div1')"><< Previous</a>&nbsp;
		<a href="javascript:void(0);" onclick="show('div3')">Next >></a>
	</div>
	
	<div class="container" id="div3" style="display:none;">
	    <span id="xyz">
			<form method="post" action="{{ route('add.image', ['id' => $id]) }}" enctype="multipart/form-data" id="step3">
				@csrf
				<input type="file" name="image" id="image" />
				<input type="submit" value="submit">
			</form>
		</span>
		<span id="abc"></span>
		<a href="javascript:void(0);" onclick="show('div2')"><< Previous</a>&nbsp;
	</div>
	<style>
.select-field{
   height:44px;
   outline: none;
		font-size: 15px;
		color: #909090;
		margin: 0;
		max-width: 100%;
		width: 100%;
		box-sizing: border-box;
		display: block;
		background-color: #fcfcfc;
		font-weight: 500;
		border: 1px solid #e0e0e0;
		opacity: 1;
}
</style>
@endsection

@section('dynamicjs')
<script src="{{ asset('jqueryform.js') }}"></script>

<script src="{{ asset('croppie.js') }}"></script>

<script type="text/javascript">


var el = document.getElementById('abc');
var resize = new Croppie(el, {
    viewport: { width: 100, height: 100 },
    boundary: { width: 300, height: 300 },
    showZoomer: false,
    enableResize: false,
    enableOrientation: true,
    mouseWheelZoom: 'ctrl'
});


$(document).ready(function() { 
    var options = { 
        beforeSubmit: showRequest,
        success: showResponse,
		dataType: "json", 
    }; 
    $('#step1').ajaxForm(options); 
	
	
	var options2 = { 
        beforeSubmit: showRequestStep2,
        success: showResponseStep2,
		dataType: "json", 
    }; 
    $('#step2').ajaxForm(options2); 
	
	var options3 = { 
        beforeSubmit: showRequestStep3,
        success: showResponseStep3,
		dataType: "json", 
    }; 
    $('#step3').ajaxForm(options3); 
}); 


function show (a) {
	$('#div1').hide();
	$('#div2').hide();
	$('#'+a).show();	
}
 

function showRequest(formData, jqForm, options) { 
	let bre = $('#bre').val();
	let years = $('#years').val();
	let month = $('#month').val();
	let title = $('#title').val();
	let description = $('#description').val();
    if (bre =="" || years =="" || month =="" || title == "" || description =="" ) {
		alert('helooo....');
		return false;
	} else {
		return true; 
	}
} 

function showResponse(responseText, statusText, xhr, $form)  { 
    if (responseText.result == 1) {
		$('#div1').hide(function(){
		    $('#div2').show();
		});
	}		
} 


function showRequestStep2(formData, jqForm, options) { 
	let state = $('#state').val();
	let district = $('#district').val();
	let locality = $('#locality').val();

    if (state =="" || district =="" || locality =="" ) {
		alert('helooo....');
		return false;
	} else {
		return true; 
	}
} 

function showResponseStep2(responseText, statusText, xhr, $form)  { 
    if (responseText.result == 1) {
		$('#div1').hide();
		$('#div2').hide();
		$('#div3').show();
	}	
} 


function showRequestStep3(formData, jqForm, options) { 
	let image = $('#image').val();

    if (image =="") {
		alert('helooo....');
		return false;
	} else {
		return true; 
	}
} 

function showResponseStep3(responseText, statusText, xhr, $form)  { 
    if (responseText.result == 1) {
		$('#div1').hide();
		$('#div2').hide();
		$('#div3').show();
		resize.bind({
			url: responseText.image,
		});
	}	
} 

</script -->


@endsection

