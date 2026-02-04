<?php

namespace App\Http\Controllers;

use App\Enums\AcademicRank;
use App\Enums\Education;
use App\Enums\Title;
use App\Http\Requests\StoreUserRequest;
use App\Jobs\SendVerificationEmailJob;
use App\Mail\SendForgetMail;
use App\Mail\SendVerificationMail;
use App\Models\EducationFiled;
use App\Models\Required;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class FrontController extends Controller
{
   public function index(){


       return view('front.index');
   }
   public function login(){
       return view('front.login');
   }
   public function register(){
       $req=Required::query()->first();
       $isOrcidReq=$req->is_orcid_required;
       return view('front.register', [
           'titles' => Title::cases(),
           'educations' => Education::cases(),
           'academicRanks' => AcademicRank::cases(),
           'educationFields' => EducationFiled::all(),
           'isOrcidReq'=>$isOrcidReq,
       ]);
   }
   public function registerSend(StoreUserRequest $request){
       $data=$request->validated();

       session([
           'register_data' => $data
       ]);
       $code = rand(100000, 999999);

       session([
           'verify_code' => $code,
           'verify_code_expires_at'=>now()->addMinutes(10)
       ]);
      /* SendVerificationEmailJob::dispatch($code, $request['email']);*/
       Mail::to($request->email)->send(new SendVerificationMail($code));
      return redirect()->route('register.submit.show');

   }
public function registerSubmitShow()
{
    return view('front.submit');
}
   public function registerSubmit(Request $request){
       $request->validate([
           'code'=>['required','string'],
       ]);
       if ($request->code != session('verify_code')) {
           return back()->withErrors(['code' => 'کد وارد شده نادرست است']);
       }
       if (now()->greaterThan(session('verify_code_expires_at'))) {
           return back()->withErrors(['code' => 'کد منقضی شده است.']);
       }
       $data = session('register_data');

       if (!$data) {
           return redirect()->route('register')->withErrors('اطلاعات ثبت‌نام یافت نشد');
       }
       $user = User::create([
           ...$data,
           'is_verified'=>true,
           'password' => Hash::make($data['password']),
       ]);
       $user->assignRole('writer');
       session()->forget(['register_data', 'verify_code','verify_code_expires_at']);
       auth()->login($user);

       return redirect()->route('writer.index');

   }
   public  function forgetPassword()
   {
       return view('front.forget');
   }
   public function forgetPasswordSend(Request $request)
   {
       $request->validate([
          'email'=>['required','email'],
       ]);
       $user=User::query()->where('email',$request['email'])->first();
       if (!$user) {
           return back()->withErrors(['email' => 'کاربری با این ایمیل در سامانه ثبت نام نمیباشد.']);
       }
       $code = Str::random(10);
       session([
           'forget_password' => $code,
           'forget_password_expires_at'=>now()->addMinutes(10),
           'forget_user_name'=>$user['user_name'],
       ]);
       Mail::to($request->email)->send(new SendForgetMail($code));
       return redirect()->route('reset.password.show');
   }
   public function resetPasswordShow()
   {
       return view('front.reset');
   }
   public function resetPassword(Request $request)
   {
       $request->validate([
           'code'=>['required','string'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
       ]);

       if ($request->code != session('forget_password')) {
           return back()->withErrors(['code' => 'کد وارد شده نادرست است']);
       }
       if (now()->greaterThan(session('forget_password_expires_at'))) {
           return back()->withErrors(['code' => 'کد منقضی شده است.']);
       }
       $user=User::query()->where('user_name',session('forget_user_name'))->first();
       if (!$user) {
           return back()->withErrors('اطلاعات کاربری یافت نشد.');
       }
       $user->update([
           'password' => Hash::make($request['password']),
       ]);
       session()->forget(['forget_password', 'forget_password_expires_at','forget_user_name']);
       return redirect(route('login'))->with('reset_password','رمز عبور با موفقیت تغییر کرد.');
   }
   public function loginSubmit(Request $request)
   {
       $request->validate([
           'user_name'=>['required','string'],
           'password'=>['required','string'],
       ]);
       $user=User::query()->where('user_name',$request['user_name'])->first();

       if (!$user) {
           return back()->withErrors('اطلاعات کاربری یافت نشد.');
       }
       if( !Hash::check($request['password'], $user['password'])) {
           return back()->withErrors('اطلاعات کاربری یافت نشد.');
       }
       auth()->login($user);

       return redirect()->route('writer.index');
   }
}
