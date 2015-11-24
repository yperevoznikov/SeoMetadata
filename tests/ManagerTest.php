<?php

namespace YPSeoMetadata;

use \YPFlatStorage;

/**
 * 	@covers \YPSeoMetadata\Manager
 */
class ManagerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \YPFlatStorage\ClientBlackhole
	 */
	private $clientBlackhole;

	/**
	 * @var \YPSeoMetadata\Manager
	 */
	private $manager;

	public function setUp() {
		$this->clientBlackhole = new \YPFlatStorage\ClientBlackhole();
		$this->manager = new \YPSeoMetadata\Manager($this->clientBlackhole);
	}

	/**
	 * 	@covers \YPSeoMetadata\Manager::__construct
	 */
	public function testConstructor() {
		
		$mnr = new \YPSeoMetadata\Manager($this->clientBlackhole);

		$this->assertInstanceOf('\YPSeoMetadata\Manager', $mnr);

	}

	/**
     * @covers \YPSeoMetadata\Manager::getMetadata
	 */
	public function testGetMetadata() {

        $storageEngine = new YPFlatStorage\ClientSessionOnly();
        $manager = new Manager($storageEngine);

        $metadata = $manager->getMetadata('some-id');
        $metadata->setTitle('title #1');
        $metadata->forceSave();

        $metadata = $manager->getMetadata('some-id');
        $title = $metadata->getTitle();

        $this->assertEquals('title #1', $title);
        $this->assertInstanceOf('\YPSeoMetadata\Metadata', $metadata);




	}

}