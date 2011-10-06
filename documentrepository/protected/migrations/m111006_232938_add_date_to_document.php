<?php

class m111006_232938_add_date_to_document extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_document', 'date', 'date');
	}

	public function down()
	{
		$this->dropColumn('tbl_document', 'date');
	}
}