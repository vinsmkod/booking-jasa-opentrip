<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'SaharAdmin',
                'email' => 'admin1234@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'points' => 0   
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}