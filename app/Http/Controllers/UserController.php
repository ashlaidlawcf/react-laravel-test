<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends AuthController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return User::whereNotIn('id', [$this->user->id])->get();
    }

    /**
     * Returns a list of the people this user is following
     * 
     * @return string
     */
    public function following(): string
    {
        $following = $this->client->following();
        $users = [];

        foreach ($following['results'] as $result) {
            $user = $result['target_id'];
            $user = str_replace('user:', '', $user);
            $users[] = intval($user);
        }

        return User::select('id', 'name')
            ->whereIn('id', $users)
            ->get()
            ->toJson();
    }

    /**
     * Follows a user
     * 
     * @param Request $request
     * @return string
     */
    public function follow(Request $request): string
    {
        $userId = intval($request->input('user_id'));

        if (!filter_var($userId, FILTER_VALIDATE_INT)) {
            return 0;
        }

        $this->client->follow('user', $userId);
        
        return User::select('id', 'name')
            ->where('id', $userId)
            ->get()
            ->toJson();
    }

    /**
     * Unfollows a user
     * 
     * @param Request $request
     * @return int
     */
    public function unfollow(Request $request): int
    {
        $userId = intval($request->input('user_id'));

        if (!filter_var($userId, FILTER_VALIDATE_INT)) {
            return 0;
        }

        $this->client->unfollow('user', $userId);

        return $userId;
    }
}
