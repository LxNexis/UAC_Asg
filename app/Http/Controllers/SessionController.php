<?php

namespace App\Http\Controllers;

use App;
use App\Models\Interest;
use App\Rules\CheckBox;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{
    public function initL(){
        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('login');
    }

    public function initR(){
        $loc = session()->get('locale');
        App::setLocale($loc);

        $interests = Interest::all();
        return view('register', compact('interests'));
    }   

    public function login(Request $request){
        $loc = session()->get('locale');
        App::setLocale($loc);

        // Validate the request
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $message = [
            'required' => 'field harus diisi',
            'email' => 'isi field dengan email yang benar',
            'password.min' => 'field password minimal 6 huruf',
            ];

        $request->validate($rules, $message);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('home.index'); // Redirect to the intended page or a default page
        } else {
            // Authentication failed
            return redirect()->back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->withInput();
        }
    }

    public function register(Request $request){

        $loc = session()->get('locale');
        App::setLocale($loc);

        
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
            'experience' => 'required|numeric',
            'linkedin' => ['required', 'regex:/^http:\/\/www\.linkedin\.com\/[a-zA-Z0-9._]+$/'],
            'flexRadioDefault' => 'required|in:Male,Female',
            'checkboxes' => 'required|array|min:3',
        ];

        $message = [
            'required' => 'field harus diisi',
            'email' => 'isi field dengan email yang benar',
            'password.min' => 'field password minimal 6 huruf',
            'linkedin.regex' => 'The Instagram URL must be in the format http://www.linkedin.com/username.',
            'flexRadioDefault.in' => 'pilih diantara male dan female',
            'checkboxes.min' => 'isi minimal 3',
            'numeric' => 'field harus berupa angka',
            ];

        $request->validate($rules, $message);
        
        preg_match('/^http:\/\/www\.linkedin\.com\/([a-zA-Z0-9._]+)$/', $request['linkedin'], $matches);
        $linkedinUsername = $matches[1] ?? null;
        $selectedCheckBoxes = $request->input('checkboxes', []);
        $selectedRadio = $request->input('flexRadioDefault');

        if ($linkedinUsername) {
            $user = new User;
            $user->name = $linkedinUsername; // Assign the extracted LinkedIn username to the name field
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->phone = $request['phone'];
            $user->linkedin = $request['linkedin'];
            $user->hasPaid = 0;
            $user->work_years = $request['experience'];
            $user->registerFee = random_int(100000, 125000);
            $user->money = 0;
            $user->profile_pic = random_int(1, 3) . '.png';

            if($selectedRadio == 'Male'){
                $user->gender = 1;
            } else{
                $user->gender = 0;
            }
            
            $user->save();

            auth()->login($user);

            foreach($selectedCheckBoxes as $cb){
                DB::table('user_interests')->insert([
                    'user_id' => $user->id,
                    'interest_id' => $cb,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('pay.show');
        } else {
            return redirect()->back()->withErrors(['linkedin' => 'Invalid LinkedIn username.']);
        }
        
    }

    public function pay (){
        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('pay');
    }

    public function payProcess (Request $request){
        $loc = session()->get('locale');
        App::setLocale($loc);

        $rules = [
            'money' => 'required|numeric|min:0'
        ];

        $messages = [
            'required' => 'field harus diisi',
            'numeric' => 'field harus berupa angka',
            'money.min' => 'masukkan minimal 0',
        ];

        $request->validate($rules, $messages);

        $paid = $request['money'];
        $fee = auth()->user()->registerFee;
        $diff = $paid - $fee;

        if($diff < 0){
            return redirect()->back()->withErrors(['money' => 'Amount Underpaid']);
        } else if($diff > 0){
            return redirect()->route('pay.overpay', ['diff' => $diff]);
        } else{
            $user = auth()->user();

            $user->hasPaid = 1;
            $user->save();

            return redirect()->route('home.index');
        }
    }

    public function payOverpay(Request $request){
        $loc = session()->get('locale');
        App::setLocale($loc);

        $diff = $request['diff'];
        return view('pay_overpay', compact('diff'));
    }

    public function handleOverpay(Request $request){
        $loc = session()->get('locale');
        App::setLocale($loc);

        $diff = $request['diff'];

        $user = auth()->user();
        
        $user->money = $diff;
        $user->hasPaid = 1;

        $user->save();

        return redirect()->route('home.index');
    }

    public function logout(Request $request){
        $loc = session()->get('locale');
        App::setLocale($loc);

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
