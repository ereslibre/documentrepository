<?php

class m111006_004445_create_language_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_language', array(
			'id'       => 'pk',
			'language' => 'string NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('tbl_language');
	}
}