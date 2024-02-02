<?php

namespace App\Http\Middleware;

use App\Models\Enc;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Mockery\Undefined;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request)
    {

        $data = ['',''];
        if(Auth::user() !== null){
            // $data = Enc::encripter('Prontcenterx_serial');
            // dd($data);
            $data = Enc::decripter(Unidade::where('id', Auth::user()->unidade_id)->pluck('chave_codigo'));
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'key_data' => $data[0],
                'key_codigo' => $data[1],
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'message' => fn () => $request->session()->get('message')
                ];
            },
            'showingMobileMenu' => false,
        ]);
    }
}
