<?php
namespace LiteCode\AdminGentelella\App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class liteDropPackageTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lite:drop-package-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop DB tables used by package';

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

        if (!$this->confirm('CONFIRM DROP AL TABLES IN THE CURRENT DATABASE USED BY lite-code/admingentelella PACKAGE? [y|N]')) {
            exit('Drop Tables command aborted');
        }

        $colname = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');

        if(!$tables){
            $this->info('No tables found!');
            return true;
        }

        $drop = ['admins', 'model_has_permissions', 'model_has_roles', 'role_has_permissions', 'permissions', 'roles'];
        $droplist = [];

        foreach($tables as $table) {

            if(in_array($table->$colname, $drop)) {

                $droplist[] = $table->$colname;

            }

        }

        if(!$droplist){
            $this->info('No tables related to package was found!');
            return true;
        }

        $droplist = implode(',', $droplist);

        DB::beginTransaction();
        //turn off referential integrity
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement("DROP TABLE $droplist");
        //turn referential integrity back on
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::commit();

        $this->comment(PHP_EOL."If no errors showed up, all tables were dropped".PHP_EOL);

    }
}
