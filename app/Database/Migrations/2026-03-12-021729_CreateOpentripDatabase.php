<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOpentripDatabase extends Migration
{
    public function up()
    {

        /*
        USERS
        */
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin','customer'],
                'default' => 'customer'
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'points' => [
                'type' => 'INT',
                'default' => 0
            ]
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');


        /*
        TRIPS
        */
        $this->forge->addField([
            'trip_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active','full','cancelled'],
                'default' => 'active'
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['one_day_trip','open_trip','private_trip'],
                'default' => 'open_trip'
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'quota' => [
                'type' => 'INT',
                'default' => 0
            ]
        ]);
        $this->forge->addKey('trip_id', true);
        $this->forge->createTable('trips');


        /*
        SCHEDULES
        */
        $this->forge->addField([
            'schedule_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'trip_id' => [
                'type' => 'INT'
            ],
            'departure_date' => [
                'type' => 'DATE'
            ],
            'quota' => [
                'type' => 'INT'
            ],
            'available' => [
                'type' => 'INT'
            ]
        ]);
        $this->forge->addKey('schedule_id', true);
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('schedules');


        /*
        MEETING POINTS
        */
        $this->forge->addField([
            'meeting_point_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'trip_id' => [
                'type' => 'INT'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'address' => [
                'type' => 'TEXT'
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('meeting_point_id', true);
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('meeting_points');


        /*
        BOOKINGS
        */
        $this->forge->addField([
            'booking_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'schedule_id' => [
                'type' => 'INT'
            ],
            'participant' => [
                'type' => 'INT'
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'meeting_point_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'document' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);
        $this->forge->addKey('booking_id', true);
        $this->forge->addForeignKey('user_id','users','user_id');
        $this->forge->addForeignKey('schedule_id','schedules','schedule_id');
        $this->forge->addForeignKey('meeting_point_id','meeting_points','meeting_point_id');
        $this->forge->createTable('bookings');


        /*
        PAYMENTS
        */
        $this->forge->addField([
            'payment_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_id' => [
                'type' => 'INT'
            ],
            'method' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'proof' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'paid_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('payment_id', true);
        $this->forge->addForeignKey('booking_id','bookings','booking_id');
        $this->forge->createTable('payments');


        /*
        INVOICES
        */
        $this->forge->addField([
            'invoice_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_id' => [
                'type' => 'INT'
            ],
            'invoice_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('invoice_id', true);
        $this->forge->addForeignKey('booking_id','bookings','booking_id');
        $this->forge->createTable('invoices');


        /*
        LOYALTY POINTS
        */
        $this->forge->addField([
            'loyalty_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'booking_id' => [
                'type' => 'INT'
            ],
            'points' => [
                'type' => 'INT'
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('loyalty_id', true);
        $this->forge->addForeignKey('user_id','users','user_id');
        $this->forge->addForeignKey('booking_id','bookings','booking_id');
        $this->forge->createTable('loyalty_points');


        /*
        DOCUMENTS
        */
        $this->forge->addField([
            'document_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_id' => [
                'type' => 'INT'
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);
        $this->forge->addKey('document_id', true);
        $this->forge->addForeignKey('booking_id','bookings','booking_id');
        $this->forge->createTable('documents');


        /*
        COMMENTS
        */
        $this->forge->addField([
            'comment_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'trip_id' => [
                'type' => 'INT'
            ],
            'comment' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','approved','rejected'],
                'default' => 'pending'
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('comment_id', true);
        $this->forge->addForeignKey('user_id','users','user_id');
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('comments');


        /*
        GALLERIES
        */
        $this->forge->addField([
            'gallery_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'album' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('gallery_id', true);
        $this->forge->createTable('galleries');


        /*
        ABOUT
        */
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'content' => [
                'type' => 'TEXT'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('about');


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
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('team');


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
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('timeline');

    }

    public function down()
    {
        $this->forge->dropTable('timeline');
        $this->forge->dropTable('team');
        $this->forge->dropTable('about');
        $this->forge->dropTable('galleries');
        $this->forge->dropTable('comments');
        $this->forge->dropTable('documents');
        $this->forge->dropTable('loyalty_points');
        $this->forge->dropTable('invoices');
        $this->forge->dropTable('payments');
        $this->forge->dropTable('bookings');
        $this->forge->dropTable('meeting_points');
        $this->forge->dropTable('schedules');
        $this->forge->dropTable('trips');
        $this->forge->dropTable('users');
    }
}