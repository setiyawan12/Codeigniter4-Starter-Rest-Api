<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'parent_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null'=>true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parent_id','category','id');
        $this->forge->createTable('category');
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}
