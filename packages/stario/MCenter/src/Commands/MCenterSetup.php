<?php

namespace Star\MCenter\Commands;

use Illuminate\Console\Command;

/**
 * 功能：
 * MCenter自动初始化命令
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */
class MCenterSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mc:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup MCenter';

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

        $tasks = [
            'php artisan key:generate',
            'php artisan vendor:publish --tag=mcenter --force',
            'composer dump-autoload',
            'php artisan migrate',
            'php artisan db:seed --class=MCenterSeeder',
            'php artisan passport:install',
            'php artisan storage:link',
        ];

        $bar = $this->output->createProgressBar(count($tasks));
        foreach ($tasks as $task) {
            $this->performTask($task);
            $bar->advance();
        }

        $bar->finish();
        $this->comment("\n\n Mission Accomplished!\n");
    }

    /**
     * @param $task
     * @return mixed
     */
    public function performTask($task)
    {
        $this->info("\n \n" . $task);
        $output = shell_exec($task);
        $this->info($output);
    }
}
