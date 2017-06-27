<?php
use App\User;
use Illuminate\Database\Seeder;
class AccountSeeder extends Seeder {

    public function run()
    {
        $users = [
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => \Hash::make('user123'),
                'is_admin' => false,
            ],[
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => \Hash::make('admin123'),
                'is_admin' => true,
            ],
        ];

        foreach ($users as $user) {
            $old_user = User::where('email',$user['email'])->get()->first();
            if($old_user){
                continue;
            }
            $new_user = User::create($user);
            echo sprintf("User '%s' created successfully!",$new_user->name);
        }
    }

}
