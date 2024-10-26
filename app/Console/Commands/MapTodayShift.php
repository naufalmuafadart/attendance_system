<?php

namespace App\Console\Commands;

use App\UseCases\MappingShift\InsertTodayUseCase;
use Illuminate\Console\Command;

class MapTodayShift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mappingshift:today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mapping current day shift';
    /**
     * @var InsertTodayUseCase
     */
    private $insertTodayUseCase;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InsertTodayUseCase $insertTodayUseCase)
    {
        parent::__construct();
        $this->insertTodayUseCase = $insertTodayUseCase;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->insertTodayUseCase->execute();
        return 0;
    }
}
