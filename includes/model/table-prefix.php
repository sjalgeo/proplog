<?php

namespace PropLog\Model;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class Table_Prefix {

	protected $prefix = '';

	public function __construct($prefix) {
		$this->prefix = $prefix;
	}

	public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs) {
		$classMetadata = $eventArgs->getClassMetadata();
		if ($classMetadata->isInheritanceTypeSingleTable() && !$classMetadata->isRootEntity()) {
			// if we are in an inheritance hierarchy, only apply this once
			return;
		}

		$classMetadata->setTableName(
			$this->prefix . $classMetadata->getTableName()
		);
		foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
			if ($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY) {
				$mappedTableName = $classMetadata->associationMappings[$fieldName]['joinTable']['name'];
				$classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix . $mappedTableName;
			}
		}
	}

}