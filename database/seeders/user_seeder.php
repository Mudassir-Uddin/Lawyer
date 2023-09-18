<?php

namespace Database\Seeders;

use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the data you want to insert into the users table
        $usersData = [
            [
                'user_name' => 'Mudasir',
                'email' => 'mudasir@gmail.com',
                'password' => Hash::make('admin12345'), // You can use bcrypt() to hash the password
                'address' => '123 Main St, City',
                'active' => 1,
                'img'=>'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.flaticon.com%2Ffree-icon%2Fuser_219983&psig=AOvVaw2sdk7DbHP0EdP8isvLtgcl&ust=1691687025001000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCIj-8bSH0IADFQAAAAAdAAAAABAI',
                'role'=>'1',
            ],
            [
                'user_name' => 'Sami',
                'email' => 'sami@example.com',
                'password' => Hash::make('user12345'),
                'address' => '456 Elm St, Town',
                'img'=>'https://www.google.com/url?sa=i&url=https%3A%2F%2Funsplash.com%2Fs%2Fphotos%2Fuser&psig=AOvVaw2sdk7DbHP0EdP8isvLtgcl&ust=1691687025001000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCIj-8bSH0IADFQAAAAAdAAAAABAE',
                'active' => 1,
                'role'=>'2'
            ],
            [
                'user_name' => 'Saqib',
                'email' => 'saqib@example.com',
                'password' => Hash::make('lawyer12345'),
                'address' => '456 Elm St, Town',
                'img'=>'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.collinsdictionary.com%2Fdictionary%2Fenglish%2Flawyer&psig=AOvVaw2I2TGbReFkQNosn0UqNiCk&ust=1691686905039000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCJDo5vmG0IADFQAAAAAdAAAAABAE',
                'active' => 1,
                'role'=>'3'
            ],
            // Add more user data as needed
        ];

        $Lawyer = [
            [
                'userId' => 1,
                'document' => '',
                'satisfaction'=>1,
            ]
        ];

        // Insert the data into the users table
        User::insert($usersData);
        Lawyer::insert($Lawyer);

    }
}
