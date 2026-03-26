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
                'constraint' => ['admin', 'customer'],
                'default' => 'customer'
            ],
            'points' => [
                'type' => 'INT',
                'default' => 0
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
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
                'type' => 'TEXT'
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'full', 'cancelled'],
                'default' => 'active'
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['one_day_trip', 'open_trip', 'private_trip'],
                'default' => 'open_trip'
            ],
            'quota' => [
                'type' => 'INT',
                'default' => 0
            ],
            'whatsapp_group' => [
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
                'null' => true
            ]
        ]);
        $this->forge->addKey('trip_id', true);
        $this->forge->createTable('trips');

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
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('meeting_point_id', true);
        $this->forge->addForeignKey('trip_id', 'trips', 'trip_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('meeting_points');

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
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('schedule_id', true);
        $this->forge->addForeignKey('trip_id', 'trips', 'trip_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('schedules');

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
                'constraint' => 50,
                'null' => true
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'schedule_id' => [
                'type' => 'INT'
            ],
            'participant' => [
                'type' => 'INT',
                'null' => true
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'meeting_point_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'document' => [
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
                'null' => true
            ]
        ]);
        $this->forge->addKey('booking_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('schedule_id', 'schedules', 'schedule_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('meeting_point_id', 'meeting_points', 'meeting_point_id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('bookings');

        /*
        DOCUMENTS
        */
        $this->forge->addField([
            'document_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_id' => [
                'type' => 'INT',
                'null' => true
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
                'constraint' => 50,
                'null' => true
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
            'birthdate' => [
                'type' => 'DATE',
                'null' => true
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'ktp' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'health' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('document_id', true);
        $this->forge->addForeignKey('booking_id', 'bookings', 'booking_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('documents');

        /*
        PAYMENTS
        */
        $this->forge->addField([
            'payment_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'method' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'proof' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'paid_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('payment_id', true);
        $this->forge->addForeignKey('booking_id', 'bookings', 'booking_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');

        /*
        LOYALTY POINTS
        */
        $this->forge->addField([
            'loyalty_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'booking_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'points' => [
                'type' => 'INT',
                'null' => true
            ],
            'description' => [
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
                'null' => true
            ]
        ]);
        $this->forge->addKey('loyalty_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('booking_id', 'bookings', 'booking_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loyalty_points');

        /*
        COMMENTS
        */
        $this->forge->addField([
            'comment_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'trip_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('comment_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('trip_id', 'trips', 'trip_id', 'CASCADE', 'CASCADE');
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
                'type' => 'INT',
                'null' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'album' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'image' => [
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
                'null' => true
            ]
        ]);
        $this->forge->addKey('gallery_id', true);
        $this->forge->addForeignKey('trip_id', 'trips', 'trip_id', 'CASCADE', 'CASCADE');
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
                'type' => 'INT',
                'null' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('include_id', true);
        $this->forge->addForeignKey('trip_id', 'trips', 'trip_id', 'CASCADE', 'CASCADE');
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
                'type' => 'INT',
                'null' => true
            ],
            'time' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
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
        $this->forge->addForeignKey('trip_id', 'trips', 'trip_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trip_itinerary');

        /*
        INVOICES
        */
        $this->forge->addField([
            'invoice_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'booking_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'invoice_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('invoice_id', true);
        $this->forge->addForeignKey('booking_id', 'bookings', 'booking_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoices');

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
                'constraint' => 50,
                'null' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ]
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
        $this->forge->createTable('timeline');
    }

    public function down()
    {
        $this->forge->dropTable('timeline');
        $this->forge->dropTable('team');
        $this->forge->dropTable('about');
        $this->forge->dropTable('invoices');
        $this->forge->dropTable('trip_itinerary');
        $this->forge->dropTable('trip_includes');
        $this->forge->dropTable('galleries');
        $this->forge->dropTable('comments');
        $this->forge->dropTable('loyalty_points');
        $this->forge->dropTable('payments');
        $this->forge->dropTable('documents');
        $this->forge->dropTable('bookings');
        $this->forge->dropTable('schedules');
        $this->forge->dropTable('meeting_points');
        $this->forge->dropTable('trips');
        $this->forge->dropTable('users');
    }
}
