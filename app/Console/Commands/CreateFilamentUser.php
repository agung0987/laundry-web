<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateFilamentUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-filament-user';

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
        $name = $this->ask('Enter the name');
        $email = $this->ask('Enter the email');
        $password = $this->ask('Enter the password');

        $roles = Role::pluck('name')->toArray();
        $role = $this->choice('Select the role', $roles);

        $status = $this->choice('Select the status', ['aktif', 'tidak_aktif']);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
            'status' => $status,
        ]);

        $user->assignRole($role);

        $this->info('User created successfully');
    }
}
