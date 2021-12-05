<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

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
        if (
            optional(
                optional(session()->get('errors'))->getBag('default')
            )->getMessages()
        ){
            flash('Check your errors and try again', 'danger');
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'asset' => asset(''),
            'flash' => [
                'message' => fn() => $request->session()->pull('flash'),
            ],
        ]);
    }
}
