<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\ProductsImported;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import produts on CSV files';

    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @param  ProductRepository  $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get all files on directory 'storage/app/imports-scheduled'
        if(!$files = File::files(storage_path('app/imports-scheduled')))
            return;

        // import each file
        foreach ($files as $file) {
            $path = str_replace(storage_path('app/'),'', $file->getPathname());
            $total = ProductService::import($this->repository, $path);

            // is possible to save this on a table and have the history for this
            $name = explode('-', $file->getFilename());

            if(!$user = User::find($name[0]))
                return;

            // send e-mail for each user
            $user->notify(new ProductsImported($total));
        }

    }
}
