<?php

class m160403_154624_add_column_to_user extends CDbMigration
{
    public function up()
    {
        $this->addColumn('user', 'hidden', 'boolean NOT NULL DEFAULT 0');
        return true;
    }

    public function down()
    {
        $this->dropColumn('user', 'hidden');
        return true;
    }
}