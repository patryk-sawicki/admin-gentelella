<?php

namespace LiteCode\AdminGentelella\app\Console\Commands;

use Illuminate\Console\Command;
use LiteCode\AdminGentelella\app\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class liteAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lite:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default admin';

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
        $admin = new Admin;

        $do = $this->choice('Create custom admin? [ y , n ]', ['y','n']);

        if($do == 'y' ){
            $admin->name = $this->ask('Enter name');
            $admin->email = $this->ask('Enter email');
            $password = $this->ask('Set a password');
            $admin->password = bcrypt($password);
        }
        else if($do == 'n' ){
            $admin->name = 'Admin';
            $admin->email = 'admin@admin.com';
            $admin->password = bcrypt('secret');
        }
        else{
            $this->error('Please, next time enter only "y" or "n"');
            return true;
        }

        if(@Admin::where('email',$admin->email)->first())
        {
            $this->error('Provided email already in use');
            $this->line('Please try again');
            return true;
        }

        $admin->save();

        if(!Role::where('name','Super Admin')->where('guard_name', 'admin')->first()){
            $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        }

        $admin->assignRole('Super Admin');

        $this->line('Admin created!');
        if($do == 'n'){
            $this->line('Use email: "admin@admin.com" password: with "secret"');
        }
        if($do == 'y'){
            $this->line('Use email: '.$admin->email.' password: with "your password"');
        }

    }
}
