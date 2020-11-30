<?php

namespace App\Http\Controllers;

use App\model\User as AppUser;
use Illuminate\Http\Request;
use Auth;
use App\model\User;

class UserControllerBackup extends Controller
{
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
               return redirect('/dashboard')->with(['color' => 'success', 'msg' => 'Login Berhasil']);
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
       echo $req->check;
      // $path = $req->file('avatar')->store('public');
      // return redirect('/file')->with(['msg' => 'Berhasil Upload','color' => 'success']);
    }

    public function logout()
    {
         Auth::logout();
         return redirect('/')->with(['msg' => 'Berhasil Keluar','color' => 'success']);
    }
}
