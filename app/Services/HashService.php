<?php
namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrRequested;
use App\Models\User;
use App\Models\Hash;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\UploadedFile;

class HashService
{ 
    public function requestQr(string $hash, string $email, string $name, string $phone): string
    {
        $file_name = "unused-qr/$hash.svg";

        $hash = Hash::firstWhere('hash', $hash);

        if($hash->user === null)
        {
            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => $name,
                'phone' => $phone,
                'password' => bcrypt($hash),
            ]);

            $hash->user()->associate($user)->save();

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

    public function save(string $hash, UploadedFile $file)
    {
        $path = Storage::disk('public')->putFile('hashes', $file);;

        Hash::create([
            'hash' => $hash,
            'file' => $path,
        ]);
    }

    public function update(Hash $hash, string $hash_str, UploadedFile $file)
    {
        Storage::disk('public')->delete($hash->file);

        $path = Storage::disk('public')->putFile('hashes', $file);;

        $hash->update([
            'hash' => $hash_str,
            'file' => $path,
        ]);
    }

    public function delete(Hash $hash)
    {
        Storage::disk('public')->delete($hash->file);

        $hash->delete();
    }
}