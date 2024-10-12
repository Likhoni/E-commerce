<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class Permissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all name list from Web.php';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        foreach($routes as $route)
        {
            if($route->getPrefix()=='/admin')
            {
                Permission::updateOrCreate([
                     'name'=>str_replace("."," ",$route->getName()),  
                ]);
            }               
        }

        echo "All Permissions Store Successfully";
    }
}
