<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
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
    public function index(Request $request, $id=0)
    {
		$user_id = 1;
		
		if ($request->isMethod('post')) {
			$dbResult = Ads::find($id);
			$dbResult->edited = 1;
			$dbResult->bread = $request->input('bread');
			$dbResult->year = $request->input('years');
			$dbResult->month = $request->input('month');
			$dbResult->title = $request->input('title');
			$dbResult->description = $request->input('description');
			$dbResult->save();
			return json_encode(['result' => '1']);
		}
		
		//check if already not edited record
		if ($id == 0) {
			$result = Ads::where('edited','!=',1)->where('user_id','=', $user_id)->first();
			if ($result == "") {
				$db = new Ads;
				$db->user_id = $user_id;
				$db->type = 'test';
				$db->edited = 0;
				$db->save();
				$id = $db->id;
			} else {
				$id = $result->id;
			}
		}
        return view('dashboard', ['id' => $id]);
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
	
	
}
