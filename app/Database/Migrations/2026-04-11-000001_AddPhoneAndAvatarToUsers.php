<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPhoneAndAvatarToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'email'
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'points'
            ],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['phone', 'avatar']);
    }
}
