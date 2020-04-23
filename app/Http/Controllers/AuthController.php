<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use GetStream\Stream\Client;
use GetStream\Stream\Feed;

class AuthController extends Controller
{
    /**
     * @var Feed $client
     */
    protected Feed $client;

    /**
     * @var User $user
     */
    protected User $user;

    /**
     * AuthController - used for authorized routes
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function (Request $request, callable $next) {
            $this->user = Auth::user();
            $client = new Client(config('stream-laravel.api_key'), config('stream-laravel.api_secret'));

            $this->client = $client->feed('user', $this->user->id);

            return $next($request);
        });
    }
}
