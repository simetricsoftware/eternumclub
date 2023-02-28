<?php
namespace App\Services;

use App\Mail\QrRequested;
use App\Mail\RegisterVoucher;
use App\Models\Event;
use App\Models\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HashService
{ 
    public function registerVoucher(Event $event, array $data, UploadedFile $voucher): void 
    { 
        $data = collect($data);

        $hash = $this->save($event, $data->only('name', 'email', 'phone', 'sex', 'is-ready', 'instagram')->all());

        $voucher_img = Image::make($voucher);

        $image_name = 'vouchers/' . now()->timestamp . '.jpg'; 

        $voucher_img->orientate()->widen(600)->save(storage_path("app/public/$image_name")); 

        $hash->voucher = $image_name;

        Mail::to(env('MAIL_SALES_ADDRESS'))->send(new RegisterVoucher( 
            $hash, 
        ));

        $hash->save();
    } 

    public function requestQr(Hash $hash): string
    {
        $file_name = "unused-qr/$hash->hash.png";

        $svg_str = QrCode::size(600)
                ->style('round')
                ->format('png')
                ->margin(2)
                ->generate($this->requestUrl($hash, $hash->email));

        Storage::disk('public')->put($file_name, $svg_str);

        $hash->approved_at = now(); 

        $hash->save();
        
        return Storage::disk('public')->url($file_name);
    }

    public function requestUrl(Hash $hash, string $email): string
    {
        return route('register-hash', [ 'hash' => $hash->hash, 'email' => $email ]);
    }

    public function sendByEmail(Hash $hash, string $qr_url): void
    {
        Mail::to($hash->email)->send(new QrRequested($hash->name, $qr_url));
    }

    public function registerHash(string $hash, string $email)
    {
        Hash::where('hash', $hash)->where('email', $email)->update([
            'was_used' => true,
        ]);

        Storage::move("public/unused-qr/$hash.svg", "used-qr/$hash.svg");
    }

    public function save(Event $event, array $data): Hash
    {
        $hash = Hash::make([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        $event->hashes()->save($hash);

        $hash->refresh();

        $hash->update([
            'hash' => FacadesHash::make($hash->id),
        ]);

        return $hash;
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
        if ($hash->voucher) {
            Storage::disk('public')->delete($hash->voucher);
        }

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
