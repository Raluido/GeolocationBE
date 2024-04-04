<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLocation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'gid' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],

            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'description' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'radius' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],

            'geom' => [
                'type'              => 'GEOMETRY',
            ],
        ]);
        $this->forge->addKey('gid', true);
        $this->forge->createTable('locations');
    }

    public function down()
    {
        $this->forge->dropTable('locations');
    }
}
