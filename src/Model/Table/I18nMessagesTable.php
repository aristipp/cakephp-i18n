<?php
namespace I18nMessages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * Model for table which hold the translation messages.
 */
class I18nMessagesTable extends Table {

	public function initialize(array $config) {
		$this->addBehavior('I18nMessages.I18nMessages');
	}

}