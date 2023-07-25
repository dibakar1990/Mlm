<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Mail\UserVerificationMail;
use App\Services\LevelDistributionWithFindSponsor;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Generation;
use Mail;

class RegisterController extends Controller
{
    private $levelDistribution;

    public function __construct(LevelDistributionWithFindSponsor $levelDistribution)
    {
        $this->levelDistribution = $levelDistribution;
    }
    
    public function index(Request $request)
    {
        $code = isset($request->ref_code) ? ($request->ref_code) : null;
        $countries = Country::get();
        return view('frontend.auth.signup',compact(
            'countries',
            'code'
        ));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'country_id' => 'required',
            'state_id' => 'required',
            'city' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'email.required' => 'This field is required',
            'phone.required' => 'This field is required',
            'country_id.required' => 'This field is required',
            'state_id.required' => 'This field is required',
            'city.required' => 'This field is required',
            'password.required' => 'This field is required',
            'confirm_password.required' => 'This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $unique_code = 'ML' .random_int(100000, 999999);
        $ref_code = isset($request->code) ? ($request->code) : null;
        $checkRefCode = User::where('unique_code', $ref_code)->first();
        if(!$checkRefCode){
            return redirect()->back()->with(['error' => "Enter a valid referal code"]);
        }
        $user = new User();
        $user->type = 2;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city = $request->city;
        $user->password =  bcrypt($request->password);
        $user->unique_code = $unique_code;
        $user->sponser_code = $ref_code;
        $user->date_of_joning =  now();
        $user->status = 0;
        $user->assignRole('user');
        $user->save();
        if($ref_code!=''){
            $checkRefCode->direct_group = $checkRefCode->direct_group+1;
            $checkRefCode->level = $checkRefCode->level+1;
            $checkRefCode->save();
            $userLevelGroup = User::where('unique_code',$user->unique_code)->where('type',2)->first();
            $userLevelGroup->level_group = $checkRefCode->level;
            $userLevelGroup->save();

            //generation level
            $generation = new Generation();
            $generation->main_id = $checkRefCode->id;
            $generation->member_id = $user->id;
            $generation->gen_type = $userLevelGroup->level_group;
            $generation->save();
            
        }else{
            $userLevelGroup = User::where('unique_code',$user->unique_code)->where('type',2)->first();
            $userLevelGroup->level_group = 1;
            $userLevelGroup->save();
        }
        $data = $this->level_distribution($user->unique_code);
        //$data = $this->levelDistribution->level_distribution($user->unique_code);
        //if($data){
            //$mainArray = [];
            //$uniqueUser = User::where('unique_code',$data)->first();
            
            
            //for($i = 1 ; $i < 100 && $uniqueUser->sponser_code!=null; $i++){
                //dd($uniqueUser);
            //}
        //}
        $activationLink = route('user.activation',['id' => encrypt($user->id)]);
        $request_sent = [
            'name' => $request->name,
            'activationLink' => $activationLink,
        ];
        Mail::to($user->email)->send(new UserVerificationMail($request_sent));
        return redirect()->route('user.login')->with(['success' => "Registration successfully"]);
    }

    
     function level_distribution($unique_code)
    {
        
        //$currentUniqueCode = $unique_code;
       
         for($i = 0 ; $i < 100 && $unique_code!=null; $i++)
        //if($unique_code!=null)
        {
           
            $data = [];
            $next_id = $this->find_sponser_id($unique_code);
            $unique_code = $next_id;
            //return $data['unique_code'] = $unique_code;
            
        }
    }

    private function find_sponser_id($unique_code)
    {
       
        $currentUser = User::where('unique_code',$unique_code)->where('type',2)->first();
        
        $sponser_code = $currentUser->sponser_code;
       
        //$currenSponsorUser = User::where('sponser_code',$currentUniqueCode)->where('type',2)->first();
        //if(!empty($currenSponsorUser)){
            // if($currentUser->sponser_code!=null){
            //     $parentUser = User::where('unique_code',$unique_code)->where('type',2)->first();
               
            //     $parentUser->total_group =  $parentUser->total_group+1;
            //     $parentUser->save();
            // }
        //}
        return $sponser_code;
        
    }
    
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
  
        return response()->json($data);
    }

    public function activation($id)
    {
        $id = decrypt($id);
        $user = User::where('id',$id)->where('status',0)->first();
            if($user){
              $user = User::find($id);
              $user->status = 1;
              $user->is_active = 1;
              $user->email_verified_at =  now();
              $user->save();
              return redirect()->route('user.login')->with(['success' => "Your account has been activated"]);
            }
            else{
                return redirect()->back()->with(['error' => "Your email already activated Session expired ! token is invalid"]);
            }
    }

    
}
