<?php

namespace Quadram\LaravelUtils\Console\Commands;

use Exception;
use Quadram\LaravelUtils\Console\Command;

class LaravelCreateSupervisorFiles extends Command
{
    protected $dir = '/etc/supervisor/conf.d/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:create-supervisor-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create supervisor config files';

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        system('clear');

        $dir = $this->ask("Set the directory to add supervisor config files", $this->dir);

        $this->createSupervisorFiles($dir);

        $this->newLine();

        if ($this->confirm("Do you want to add sockets support? (this will add a websocket file for each environment)")) {
            $this->createSupervisorFilesForSockets($dir);
        }

        $this->shellExecFromCommandLine("sudo supervisorctl stop all");
        $this->shellExecFromCommandLine("sudo supervisorctl reread");
        $this->shellExecFromCommandLine("sudo supervisorctl update");
        $this->shellExecFromCommandLine("sudo supervisorctl start all");
        $this->shellExecFromCommandLine("sudo supervisorctl status");
    }

    /**
     * Returns the app name concatenating the environment. Example: "My App" -> MyApp.Develop
     * @return string
     */
    protected function getAppName()
    {
        return preg_replace('/\s+/', '', env('APP_NAME'));
    }

    /**
     * Create the supervisor .conf file and start to listen.
     */
    protected function createSupervisorFiles($dir)
    {
        $this->createSupervisorConfigFile($this->getAppName(), 'queue:work --tries=100', $dir);
    }

    /**
     * Create the supervisor .conf file and start to listen for websockets.
     */
    protected function createSupervisorFilesForSockets($dir)
    {
        $this->createSupervisorConfigFile('websockets', 'websockets:serve', $dir);
    }
}
