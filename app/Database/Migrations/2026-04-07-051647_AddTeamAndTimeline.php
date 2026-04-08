<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTeamAndTimeline extends Migration
{
    public function up()
    {
        /*
        TEAM
        */
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('team', true);


        /*
        TIMELINE
        */
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'year' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'event' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('timeline', true);
    }

    public function down()
    {
        $this->forge->dropTable('timeline');
        $this->forge->dropTable('team');
    }
}
