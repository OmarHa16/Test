<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\authors;
use App\Models\sources;
use Illuminate\Http\Request;
use App\Models\Preferred_authors;
use App\Models\Preferred_sources;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthControllers extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);


        $user = User::create($data);

        $this->addPreferredSource($request, $user);
        $this->addPreferredauthor($request, $user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
        
    }

    public function login(Request $request)
    {
    
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:8'],
        ]);


        $user = User::where('email', $data["email"])->first();

        
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }




    private function addPreferredSource(Request $request, User $user)
    {
        
        foreach ($request->sourceNames as $source)
        { 
            if(sources::where('name', $source)->first())
            {
                Preferred_sources::create([
                    'user_id'=>$user->user_id,
                    'source_id'=> sources::where('name', $source)->first()->source_id]);
            }
        }
    }




    private function addPreferredauthor(Request $request, User $user)
    {
        foreach ($request->authorNames as $author)
        { 
        if(authors::where('name', $author)->first())
        {
        Preferred_authors::create([
            'user_id'=>$user->user_id,
            'source_id'=> authors::where('name', $author)->first()->author_id
        ]);}
        }
    }




    

}
