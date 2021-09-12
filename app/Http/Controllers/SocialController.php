<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use \SocialiteProviders\Manager\ServiceProvider AS SocVk;
use Auth;
class SocialController extends Controller
{

    public function redirect($provider)
    {
        if ($provider == 'vkontakte'){
            return SocVk::driver($provider)->redirect();
        }
        return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider)
    {

        $userSocial = Socialite::driver($provider)->stateless()->user();
        $users = User::where(['email' => $userSocial->getEmail()])->first();
        if ($users) {
            Auth::login($users);
            return redirect('/');
        } else {
            if ($provider !='github') {
                $user = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                    'image' => $userSocial->getAvatar(),
                    'provider_id' => $userSocial->getId(),
                    'status' => 1,
                    'provider' => $provider,
                ]);
            }else{
                $user = User::create([
                    'name' => $userSocial->nickname,
                    'email' => $userSocial->email,
                    'image' => $userSocial->avatar,
                    'provider_id' => $userSocial->id,
                    'status' => 1,
                    'provider' => $provider,
                ]);
            }
            return redirect()->route('home');
        }
    }

    public function TwitterCallback()
    {
        $twitterSocial =   Socialite::driver('twitter')->user();
        $users       =   User::where(['email' => $twitterSocial->getEmail()])->first();
        if($users){
            Auth::login($users);
            return redirect('/home');
        }else{
            $user = User::firstOrCreate([
                'name'          => $twitterSocial->getName(),
                'email'         => $twitterSocial->getEmail(),
                'image'         => $twitterSocial->getAvatar(),
                'provider_id'   => $twitterSocial->getId(),
                'provider'      => 'twitter',
            ]);
            return redirect()->route('home');
        }
    }

    public function VkCallback()
    {
        $vkSocial = SocVk::driver('vkontakte')->user();
        $users = User::where(['email' => $vkSocial->getEmail()])->first();
        if ($users) {
            Auth::login($users);
            return redirect('/home');
        } else {
            $user = User::firstOrCreate([
                'name' => $vkSocial->getName(),
                'email' => $vkSocial->getEmail(),
                'image' => $vkSocial->getAvatar(),
                'provider_id' => $vkSocial->getId(),
                'provider' => 'vk',
            ]);
            return redirect()->route('home');
        }
    }
}
