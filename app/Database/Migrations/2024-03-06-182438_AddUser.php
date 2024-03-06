<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],

            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'password' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
