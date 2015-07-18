<?php

class m150718_034501_add_is_founder_to_user extends CDbMigration
{
    public function up()
    {
        $this->addColumn('user', 'is_founder', 'boolean NOT NULL DEFAULT 0');
        $this->addColumn('user', 'pos', 'integer NULL DEFAULT NULL');

        return true;
    }

    public function down()
    {
        $this->dropColumn('user', 'is_founder');
        $this->dropColumn('user', 'pos');

        return true;
    }
}