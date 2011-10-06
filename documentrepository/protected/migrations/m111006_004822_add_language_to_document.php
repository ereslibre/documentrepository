<?php

class m111006_004822_add_language_to_document extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_document', 'language_id', 'integer');
		$this->addForeignKey('fk_tbl_document_language_id', 'tbl_document', 'language_id', 'tbl_language', 'id', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('fk_tbl_document_language_id', 'tbl_document');
		$this->dropColumn('tbl_document', 'language_id');
	}
}