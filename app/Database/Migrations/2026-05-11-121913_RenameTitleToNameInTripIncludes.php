<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameTitleToNameInTripIncludes extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('trip_includes', [
            'title' => [
                'name'       => 'name',
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('trip_includes', [
            'name' => [
                'name'       => 'title',
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }
}
