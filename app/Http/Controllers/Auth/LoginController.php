<?php

namespace App\Http\Controllers\Auth;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // menentukan session ketika login
    protected function authenticated(Request $request, $user)
    {
        $user_id = $user->id;
        $walas = Teacher::where('user_id', $user_id)->where('grade_id', '!=', NULL)->first();

        if ($user->hasRole('guru') && !is_null($walas)) {
            session()->put([
                'akses' => 'Wali Kelas',
            ]);
        } elseif ($user->hasRole('guru')) {
            session()->put([
                'akses' => 'Guru',
            ]);
        }
        return redirect()->route('home');
    }
}

// if (session()->get('akses_sebagai') == 'Guru Mapel') {
//     $guru = Guru::where('user_id', Auth::id())->first();
//     $cek_wali_kelas = Kelas::where('guru_id', $guru->id)->first();
//     if (!is_null($cek_wali_kelas)) {
//         session()->put([
//             'akses_sebagai' => 'Wali Kelas',
//         ]);
//         return redirect('/dashboard')->with('toast_success', 'Akses wali kelas berhasil');
//     } else {
//         return back()->with('toast_error', 'Anda tidak memiliki akses sebagai wali kelas');
//     }
// } else {
//     session()->put([
//         'akses_sebagai' => 'Guru Mapel',
//     ]);
//     return redirect('/dashboard')->with('toast_success', 'Akses guru mapel berhasil');
// }
// }