<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParentPermissionToDocuments extends Migration
{
    public function up()
    {
        $this->forge->addColumn('documents', [
            'parent_permission' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'health',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('documents', 'parent_permission');
    }
}
