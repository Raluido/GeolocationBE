<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLocation extends Migration
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

            'ccaa' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'province' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'city' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],


            'project' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],


            'description' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'lat' => [
                'type'              => 'FLOAT',
                'constraint'        => '50'
            ],

            'lng' => [
                'type'              => 'FLOAT',
                'constraint'        => '50'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('locations');
    }

    public function down()
    {
        $this->forge->dropTable('locations');
    }
}
