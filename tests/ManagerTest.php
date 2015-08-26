<?php

namespace YPMetadata;

use \YPStorageEngine;

/**
 * 	@covers \YPMetadata\Manager
 */
class ManagerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \YPStorageEngine\ClientBlackhole
	 */
	private $clientBlackhole;

	/**
	 * @var \YPMetadata\Manager
	 */
	private $manager;

	public function setUp() {
		$this->clientBlackhole = new \YPStorageEngine\ClientBlackhole();
		$this->manager = new \YPMetadata\Manager($this->clientBlackhole);
	}

	/**
	 * 	@covers \YPMetadata\Manager::__construct
	 */
	public function testConstructor() {
		
		$mnr = new \YPMetadata\Manager($this->clientBlackhole);

		$this->assertInstanceOf('\YPMetadata\Manager', $mnr);

	}

	/**
     * @covers \YPMetadata\Manager::getMetadata
	 */
	public function testGetMetadata() {

        $storageEngine = new YPStorageEngine\ClientSessionOnly();
        $manager = new Manager($storageEngine);

        $metadata = $manager->getMetadata('some-id');
        $metadata->setTitle('title #1');
        $metadata->forceSave();

        $metadata = $manager->getMetadata('some-id');
        $title = $metadata->getTitle();

        $this->assertEquals('title #1', $title);
        $this->assertInstanceOf('\YPMetadata\Metadata', $metadata);




	}

}