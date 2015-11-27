<?php

namespace YPSeoMetadata;
use \YPFlatStorage;

class Manager {

    const DOMAIN = 'YPMetadata_items';

	/**
	 * @var \YPFlatStorage\IClient
	 */
	private $storage = null;
	
	public function __construct(\YPFlatStorage\IClient $storage) {
		$this->storage = $storage;
	}

    /**
     * @param string $identity
     * @param string $type
     * @return Metadata
     */
	public function getMetadata($identity, $type = null) {

        $storageSlot = $this->storage->fetchOne(self::DOMAIN, array(
            'identity' => $identity,
            'type' => $type
        ));

        if ($storageSlot) {

            $fields = array(
                'seoText' => $storageSlot->seo_text,
                'title' => $storageSlot->title,
                'description' => $storageSlot->description,
            );
            return $this->createMetadata($identity, $type, $fields);

        } else {
            return $this->createMetadata($identity, $type);
        }
    }

    /**
     * @param string $identity
     * @param string $type
     * @return Metadata
     */
	private function createMetadata($identity, $type=null, $fields=null) {
		return new Metadata($this->storage, $identity, $type, $fields);
	}

}