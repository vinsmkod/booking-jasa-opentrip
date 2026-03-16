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
                'constraint' => 100
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
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
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('user_id', true);
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
            'description' => [
                'type' => 'TEXT'
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'trip_type' => [
                'type' => 'ENUM',
                'constraint' => ['open','private','oneday']
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
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
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('schedule_id', true);
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('schedules');


        /*
        BOOKINGS
        */
        $this->forge->addField([
            'booking_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'schedule_id' => [
                'type' => 'INT'
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','confirmed','cancelled'],
                'default' => 'pending'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('booking_id', true);
        $this->forge->addForeignKey('user_id','users','user_id','CASCADE','CASCADE');
        $this->forge->addForeignKey('schedule_id','schedules','schedule_id','CASCADE','CASCADE');
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
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','paid','failed'],
                'default' => 'pending'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('payment_id', true);
        $this->forge->addForeignKey('booking_id','bookings','booking_id','CASCADE','CASCADE');
        $this->forge->createTable('payments');


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
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('comment_id', true);
        $this->forge->addForeignKey('user_id','users','user_id','CASCADE','CASCADE');
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
            'trip_id' => [
                'type' => 'INT'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('gallery_id', true);
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('galleries');


        /*
        TRIP INCLUDES
        */
        $this->forge->addField([
            'include_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'trip_id' => [
                'type' => 'INT'
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('include_id', true);
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('trip_includes');


        /*
        TRIP ITINERARY
        */
        $this->forge->addField([
            'itinerary_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'trip_id' => [
                'type' => 'INT'
            ],
            'time' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'day' => [
                'type' => 'INT',
                'null' => true
            ],
            'sort_order' => [
                'type' => 'INT',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('itinerary_id', true);
        $this->forge->addForeignKey('trip_id','trips','trip_id','CASCADE','CASCADE');
        $this->forge->createTable('trip_itinerary');

    }

    public function down()
    {
        $this->forge->dropTable('trip_itinerary');
        $this->forge->dropTable('trip_includes');
        $this->forge->dropTable('galleries');
        $this->forge->dropTable('comments');
        $this->forge->dropTable('payments');
        $this->forge->dropTable('bookings');
        $this->forge->dropTable('schedules');
        $this->forge->dropTable('trips');
        $this->forge->dropTable('users');
    }
}