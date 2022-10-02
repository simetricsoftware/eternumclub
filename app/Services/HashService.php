<?php
namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrRequested;
use App\Mail\RegisterVoucher;
use App\Models\User;
use App\Models\Hash;
use Illuminate\Http\UploadedFile;

class HashService
{ 
    public function registerVoucher(string $hash, string $email, string $name, string $phone, UploadedFile $voucher): void 
    { 
        $hash = Hash::firstWhere('hash', $hash);

        if($hash->user === null)
        {
            $user = User::where('email', $email)->first();

            if($user === null)
                $user = new User([
                    'email' => $email,
                    'password' => bcrypt($hash),
                ]);

            $user->name = $name; 
            $user->phone = $phone; 

            $user->assignRole('client')->save();

            $hash->user()->associate($user);
        }

        $hash->voucher = Storage::disk('public')->putFile("vouchers", $voucher);

        Mail::to(env('MAIL_SALES_ADDRESS'))->send(new RegisterVoucher( 
            $hash->hash, 
            $email, 
            $name, 
            $phone, 
            $hash->voucher,
        ));

        $hash->save();
    } 

    public function requestQr(Hash $hash): string
    {
        $file_name = "unused-qr/$hash->hash.svg";

        $svg_str = QrCode::size(600)
                ->style('round')
                ->margin(2)
                ->generate($this->requestUrl($hash, $hash->user->email));

        Storage::disk('public')->put($file_name, $svg_str);

        $hash->approved_at = now(); 

        $hash->save();
        
        return Storage::disk('public')->url($file_name);
    }

    public function requestUrl(Hash $hash, string $email): string
    {
        return route('register-hash', [ 'hash' => $hash->hash, 'email' => $email ]);
    }

    public function sendByEmail(string $to_email, string $qr_url): void
    {
        Mail::to($to_email)->send(new QrRequested($qr_url));
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

    public function update(Hash $hash, string $hash_str, ?UploadedFile $file)
    {
        if($file !== null)
        { 
            Storage::disk('public')->delete($hash->file);
            $path = Storage::disk('public')->putFile('hashes', $file);;
            $hash->file = $path;
        }


        $hash->hash = $hash_str;
        $hash->save();
    }

    public function delete(Hash $hash)
    {
        Storage::disk('public')->delete($hash->file);

        $hash->delete();
    }

    public function reverseHash(string $hash)
    {
        $hash = Hash::firstWhere('hash', $hash); 

        $hash->user_id = null; 

        if($hash->voucher)
            Storage::disk('public')->delete($hash->voucher);

        $hash->voucher = null; 
        $hash->approved_at = null; 

        $hash->was_used = false; 

        $hash->save();
    }
}
