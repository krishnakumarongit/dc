<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Bread;
use App\Models\Pincode;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('dashboard',['breads' => Bread::all()]);
    }
	
	public function location(Request $request, $id=0)
    {
		$user_id = 1;
		if ($request->isMethod('post')) {
			$dbResult = Ads::find($id);
			$dbResult->state = $request->input('state');
			$dbResult->district = $request->input('district');
			$dbResult->locality = $request->input('locality');
			$dbResult->save();
			return json_encode(['result' => '1']);
		}
		
	}
	
	public function image(Request $request, $id=0)
    {
		$user_id = 1;
		if ($request->isMethod('post')) {		
			$validator = Validator::make($request->all(), [
				'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
			]);
			if ($validator->fails()) {
				return json_encode(['result' => '0']);
			} else {
				$imageName = time().'.'.$request->image->getClientOriginalExtension();
				$request->image->move(public_path('images'), $imageName);
				return json_encode(['result' => '1', 'image' => 'http://localhost/dogscart/public/images/'.$imageName ]);
			}
		}
		
	}
	
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stepOne(Request $request)
    {
		if ($request->isMethod('post')) {	
			$validator = Validator::make($request->all(), [
				'breed' => 'required|max:100|min:3',
				'years' => 'required_without:month',
				'month' => 'required_without:years',
				'title' => 'required|max:100|min:10',
				'description' => 'required|max:1500|min:10',
				'price' => 'required|integer'
			]);	
			
			if ($validator->fails()) {
				  return redirect(route('ad'))
                        ->withErrors($validator)
                        ->withInput();
			} else {
				//insert here
				$result = new Ads();
				$result->breed = $request->input('breed');
				$result->user_id = 1;
				$result->year = $request->input('years');
				$result->month = $request->input('month');
				$result->title = $request->input('title');
				$result->description = $request->input('description');
				$result->price = $request->input('price');
				$result->save();
				return redirect(route('post.location',['id' => $result->id]));
			}
		}
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stepTwo(Request $request, $id)
    {
		//check if this add belongs to current user
		$result = Ads::find($id);
		if ($result->count() > 0 && $result->user_id == 1) {
			return view('location', ['state' => Pincode::distinct()->orderBy('state')->get(['state']), 'id' => $id]);
		}	
	}
	
	public function getdistrict(Request $request) {
		if ($request->isMethod('post')) {	
			$state = $request->input('state');
			$option = '<option value=""></option>';
			$out = Pincode::distinct()->where([['state', '=', $state]])->orderBy('district')->get(['district']);
			if ($out->count() > 0) {
				foreach ($out as $row) {
					$option .='<option value="'.$row->district.'">'.ucwords($row->district).'</option>';
				}
			}
		    echo $option;
		    exit;
		}
	}
	
	public function getlocation(Request $request) {
		if ($request->isMethod('post')) {	
			$district = $request->input('district');
			$option = '<option value=""></option>';
			$out = Pincode::distinct()->where([['district', '=', $district]])->orderBy('location')->get(['location']);
			if ($out->count() > 0) {
				foreach ($out as $row) {
					$option .='<option value="'.$row->location.'">'.ucwords($row->location).'</option>';
				}
			}
		    echo $option;
		    exit;
		}
	}
	
	
	
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stepThree(Request $request, $id = 0)
    {
		if ($request->isMethod('post')) {	
			$result = Ads::find($id);
		    if ($result->count() > 0 && $result->user_id == 1) {
				$validator = Validator::make($request->all(), [
					'state' => 'required|max:100|min:3',
					'district' => 'required_without:month',
					'location' => 'required_without:years',
					'email' => 'nullable|max:100|email',
					'main_phone_number' => 'nullable|max:15|min:9',
					'other_phone_number' => 'nullable|max:15|min:9'
				]);	
				if ($validator->fails()) {
					  return redirect(route('post.location',['id' => $id]))
							->withErrors($validator)
							->withInput();
				} else {
					//insert here
					$result = Ads::find($id);
					$result->state = $request->input('state');
					$result->district = $request->input('district');
					$result->location = $request->input('location');
					$result->email = $request->input('email');
					$result->other_phone_number = $request->input('other_phone_number');
					$result->main_phone_number = $request->input('main_phone_number');
					$result->save();
					return redirect(route('post.image',['id' => $result->id]));
				}
		    }
		}
	}
	
	
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stepFour(Request $request, $id)
    {
		//check if this add belongs to current user
		$result = Ads::find($id);
		if ($result->count() > 0 && $result->user_id == 1) {
			return view('image', ['id' => $id, 
			'image1' => $result->image_1,
			'image2' => $result->image_2,
			'image3' => $result->image_3]);
		}	
	}
	
	public function stepFourCheck(Request $request, $id)
	{
		//check if this add belongs to current user
		if ($request->isMethod('post')) {	
			$result = Ads::find($id);
			if ($result->count() > 0 && $result->user_id == 1) {
				
				$validator = Validator::make($request->all(), [
					'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
				]);	
				
				if ($validator->fails()) {
					  return redirect(route('post.image',['id' => $id]))
							->withErrors($validator)
							->withInput();
				} else {
				    
				    $imageName = time().'.'.$request->image->getClientOriginalExtension();
					$request->image->move(public_path('ads'), $imageName);
					$checkPost = $request->input('input_check');
					if ($checkPost == 1) {
						$result->image_1 = $imageName;
						$result->save();
					} else if ($checkPost == 2) {
						$result->image_2 = $imageName;
						$result->save();
					} else if  ($checkPost == 3) {
					   $result->image_3 = $imageName;
					   $result->save();
					} else {
					
					}
					$request->session()->flash('status', 'Image uploaded successfully, you can publish your ad or can upload more images.');
					return redirect(route('post.image',['id' => $id]));
			    }	
			}
		}
	}
	
	
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteimage(Request $request, $adid, $id)
    {
		//check if this add belongs to current user
		$result = Ads::find($adid);
		if ($result->count() > 0 && $result->user_id == 1) {
			if ($id == 3) {
				$img3 = $result->image_3;
				$result->image_3 = '';
				$result->save();
				@unlink(public_path().'/ads/'.$img3);
			}
			
			if ($id == 2) {
				$img3 = $result->image_2;
				$result->image_2 = '';
				$result->save();
				@unlink(public_path().'/ads/'.$img3);
			}
			
			if ($id == 1) {
				$img3 = $result->image_1;
				$result->image_1 = '';
				$result->save();
				@unlink(public_path().'/ads/'.$img3);
			}
			$request->session()->flash('status', 'Image delete successfully, you can publish your ad or can upload more images.');
			return redirect(route('post.image',['id' => $adid]));
		}	
	}
	
	public function publish(Request $request, $id)
    {
		//check if this add belongs to current user
		$result = Ads::find($id);
		if ($result->count() > 0 && $result->user_id == 1) {
			$result->status = 'published';
			$result->save();
			echo "hi";
			exit;
		}	
	}
	
	
}
