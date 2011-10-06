<?php

class m111006_003536_add_catalog_to_document extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_document', 'catalog', 'string');
	}

	public function down()
	{
		$this->dropColumn('tbl_document', 'catalog');
	}
}
