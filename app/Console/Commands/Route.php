<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Route as RouteCollection;

class Route extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert all routes as JS vars';

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
     * @return mixed
     */
    public function handle()
    {
        $routes = [];

        foreach (RouteCollection::getRoutes() as $route) {
            if (!empty($route->getName())) {
                $name          = camel_case(str_replace('.', '_', $route->getName()));
                $routes[$name] = url($route->getPath());
            }
        }

        $line = sprintf('window.routes = %s;', json_encode($routes));

        $created = File::put($file = base_path('resources/assets/js/routes.js'), $line);
        if ($created) {
            $this->info(sprintf('JS file has been created and located at: "%s".', $file));
        }
    }
}
