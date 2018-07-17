<?php

namespace LiteCode\AdminGentelella\App\Console\Commands;

use Illuminate\Console\Command;
use LiteCode\AdminGentelella\App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class liteInstall extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lite:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default admin, permissions and "Super Admin" role.';

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
        $this->info('Checking if permission migration exists.');
        $migrations = glob(base_path().'/database/migrations/*_create_permission_tables.php');
        if(@$migrations){
            foreach($migrations as $file)
                $this->info('Removing migration: '.$file);
                unlink($file);
        }
        $this->info('Permission migrations removed.');

        $this->call('lite:drop-package-tables');
        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            '--force' => true
        ]);
        $this->line('##################################################################################');
        $this->line('####### LiteCode\AdminGentelella "assets" will take a wile to be published #######');
        $this->line('##################################################################################');
        $this->call('vendor:publish', [
            '--provider' => 'LiteCode\AdminGentelella\App\Providers\AdminGentelellaServiceProvider',
            '--force' => true
        ]);
        $this->call('migrate:refresh');
        $this->info('migrated!');


        if(!Role::where('name','Super Admin')->where('guard_name', 'admin')->first()){
            $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        }

        if(!Admin::where('email','admin@admin.com')->first()){
            $admin = new Admin;
            $admin->name = 'Lite Code';
            $admin->email = 'admin@admin.com';
            $admin->password = bcrypt('secret');
            $admin->save();
        }

        // Create permissions for this model
        $permission = Permission::create(['name' => 'admin-create','guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'admin-read', 'guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'admin-update', 'guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'admin-delete','guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'role-create','guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'role-read', 'guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'role-update', 'guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'role-delete','guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'permission-create','guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'permission-read', 'guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'permission-update', 'guard_name' => 'admin']);$permission->assignRole("Super Admin");
        $permission = Permission::create(['name' => 'permission-delete','guard_name' => 'admin']);$permission->assignRole("Super Admin");


        $admin->assignRole('Super Admin');

        $this->line('Admin created!');
        $this->line('Use email: "admin@admin.com" password: with "secret"');

    }
}