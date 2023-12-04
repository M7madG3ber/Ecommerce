<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteUnsedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unsedimages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $images = Image::whereDoesntHave("products")
            ->get();

        foreach ($images as $image) {
            Storage::disk('public')
                ->delete($image->path);
        }

        Image::whereDoesntHave("products")
            ->delete();
    }
}
