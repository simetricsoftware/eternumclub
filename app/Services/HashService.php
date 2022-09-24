<?php
namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrRequested;
use App\Models\User;
use App\Models\Hash;

class HashService
{ 
    public function requestQr(string $hash, string $email, string $name, string $phone): string
    {
        $file_name = "unused-qr/$hash.svg";

        if(!Hash::where('hash', $hash)->exists())
        {
            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => $name,
                'phone' => $phone,
                'password' => bcrypt($hash),
            ]);

            Hash::make([
                'hash' => $hash,
            ])
            ->user()->associate($user)
            ->save();

            $svg_str = QrCode::size(600)
                ->style('round')
                ->margin(2)
                ->generate($this->requestUrl($hash, $email));
        
            Storage::disk('public')->put($file_name, $svg_str);
        }
        
        return Storage::disk('public')->url($file_name);
    }

    public function requestUrl(string $hash, string $email): string
    {
        return route('register-hash', [ 'hash' => $hash, 'email' => $email ]);
    }

    public function sendByEmail(string $to_email, string $qr_url, string $url): void
    {
        Mail::to($to_email)->send(new QrRequested($qr_url, $url));
    }

    public function registerHash(string $hash, string $email)
    {
        Hash::where('hash', $hash)->whereHas('user', function($q_user) use ($email)
        {
            $q_user->where('email', $email);
        })->update([
            'was_used' => true,
        ]);

        Storage::move("public/unused-qr/$hash.svg", "used-qr/$hash.svg");
    }
}