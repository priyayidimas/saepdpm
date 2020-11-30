<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use Illuminate\Support\Facades\Hash as Hash;
class UserController extends Controller
{
   public function index()
   {
      if(!Auth::check()){
        return view('welcome');
      }else{
        return redirect('dashboard');
      }
   }
   public function v_login()
   {
      return view('login');
   }
   public function v_register()
   {
      return view('register');
   }
   public function navbar()
   {
      return view('navbar');
   }
   public function dashboard()
   {
      if (!Auth::check()) {
         return redirect('/');
      }
      $kegiatan = Kegiatan::whereNotNull('pengawas_ttd')->limit(10)->orderBy('updated_at','desc')->get();
      return view("dashboard", compact('kegiatan'));
   }

   //POST
   public function login(Request $request)
   {
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
         if(Auth::user()->email_verified_at == NULL){
            Auth::logout();
            return back()->with(['color' => 'error', 'msg' => 'Email Belum Diverifikasi'])->withInput();
         }else if(Auth::user()->tipe == 0){
            Auth::logout();
            return back()->with(['color' => 'error', 'msg' => 'Belum Di approve ketua'])->withInput();
         }else{
            return redirect('dashboard')->with(['color' => 'success', 'msg' => 'Login Berhasil']);
         }
      }else{
         return back()->with(['color' => 'error', 'msg' => 'Login Gagal'])->withInput();
      }
   }

   public function register(Request $request)
   {
      if ($request->password != $request->cpassword) {
         return back()->with(['color' => 'error', 'msg' => 'Password dan Confirm Password Tidak Sesuai'])->withInput();
      }

      if (User::where('email','=',$request->email)->count() > 0 || User::where('nim','=',$request->nim)->count() > 0) {
         return back()->with(['color' => 'error', 'msg' => 'User Sudah Ada Bung!'])->withInput();
      }else{
         $user = new User();
         $user->nim = $request->nim;
         $user->nama = $request->nama;
         $user->email = $request->email;
         $user->tipe = 0;
         $user->password = bcrypt($request->password);
         $user->save();

         return redirect('/')->with(['color' => 'success', 'msg' => 'Register Berhasil, Konfirmasi Emailmu dan Tunggu Approve dari Ketua']);

      }
   }

   public function newPassword(Request $request)
   {
      $user = User::find($request->id);
      if($request->password != $request->cpassword){
        return back()->with(['color' => 'error', 'msg' => 'Password dan Confirm Password Tidak Sesuai']);
      }elseif(!Hash::check($request->oldPassword, $user->password)){
        return back()->with(['color' => 'error', 'msg' => 'Password Salahh']);
      }else{
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with(['color' => 'success', 'msg' => 'Password Berhasil Diganti']);
      }
   }

   public function file(Request $req)
   {
      // echo $req->check;
      // echo nl2br($req->txt);
      // if($req->has('avatar')){
      //    $code = rand(0,1000);
      //    $file = $req->avatar;
      //    $name = $file->getClientOriginalName();
      //    $tName = str_replace(" ","_",$name);
      //    $dest = "assets/upload/ttd/";
      //    $filename = $code."-".$tName;
      //    $file->move($dest,$filename);
      //    // $user->image = $filename;
      // }
      // return redirect('file')->with(['msg' => 'Berhasil Upload','color' => 'success']);
   }

   public function logout()
   {
      Auth::logout();
      return redirect('/')->with(['msg' => 'Berhasil Keluar','color' => 'success']);
   }

   //DEBUG
   public function demo_css()
   {
      return view('debug.demo-css');
   }
   public function demo_js()
   {
      return view('debug.demo-js');
   }
   public function component()
   {
      return view('debug.component');
   }
   public function v_file()
   {
      return view('debug.file');
   }
   public function exportFile()
   {
      $pdf = PDF::loadView('debug.a');
      return $pdf->download('theFile.pdf');
   }
   public function pdf()
   {
      return view('debug.pdf');
   }
}
