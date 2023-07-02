<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OptimizeImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:image {--use-webp} {--input=} {--output=} {--disk=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'optimize to web webp';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $useWebp = $this->option('use-webp');
        $input = $this->option('input');
        $output = $this->option('output');
        $disk = $this->option('disk', 'local');

        if ($useWebp) {
            $this->webpStrategy($input, $output, $disk);
        }

        return 0;
    }

    private function webpStrategy(string $input, string $output, string $disk)
    {
        $tempPath = Storage::disk($disk)->path($input);
        $optimizedPath = Storage::disk($disk)->path($output);

        $command = "cwebp {$tempPath} -o {$optimizedPath}";

        exec($command);

        Storage::disk($disk)->delete($input);
    }
}
