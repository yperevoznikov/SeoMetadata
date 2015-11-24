<?php

namespace YPSeoMetadata;

use \YPFlatStorage;

class MetadataTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \YPFlatStorage\ClientBlackhole
	 */
	private $clientBlackhole;

	/**
	 * @var \YPSeoMetadata\Metadata
	 */
	private $blackholeMetadata;

	/**
	 * Set up environment for tests
	 */
	public function setUp() {
		$this->clientBlackhole = new \YPFlatStorage\ClientBlackhole();
		$this->blackholeMetadata = new \YPSeoMetadata\Metadata($this->clientBlackhole, 'identity', 'type');
	}

	/**
	 * 	@covers \YPSeoMetadata\Metadata::__construct
	 */
	public function testConstructor() {

        $fields = array(
            'seoText' => 'seo text',
            'title' => 'title',
            'description' => 'description',
        );

		$metadata = new \YPSeoMetadata\Metadata($this->clientBlackhole, '3', 'type', $fields);
		$this->assertInstanceOf('\YPSeoMetadata\Metadata', $metadata);

	}

    /**
     * @covers \YPSeoMetadata\Metadata::__destruct
     * @covers \YPSeoMetadata\Metadata::forceSave
     */
    public function testDestructor() {

        // #1 when we update Metadata class update function has to be called once
        $stubStorage = $this->getMockForAbstractClass('\YPFlatStorage\IClient');
        $stubStorage->expects($this->once())
            ->method('upsert');

        $metadata = new \YPSeoMetadata\Metadata($stubStorage, 'someIdentity');
        $metadata->setTitle('some title');

        // #1 when we DO NOT update Metadata class update function shouldn't be called
        $stubStorage = $this->getMockForAbstractClass('\YPFlatStorage\IClient');
        $stubStorage->expects($this->never())
            ->method('upsert');

        $metadata = new \YPSeoMetadata\Metadata($stubStorage, 'someIdentity');

    }

	/**
	 * 	@covers \YPSeoMetadata\Metadata::getSeoText
	 * 	@covers \YPSeoMetadata\Metadata::setSeoText
	 * 	@covers \YPSeoMetadata\Metadata::deleteSeoText
	 */
	public function testSetGetDeleteSeoText() {
		
		// test get
		$res = $this->blackholeMetadata->getSeoText('Default Text #1');
		$this->assertEquals('Default Text #1', $res, "SeoText Getter does NOT seem to work!");

		// test set
		$this->blackholeMetadata->setSeoText('New Text #1');
		$res = $this->blackholeMetadata->getSeoText('Default Text #1');
		$this->assertEquals('New Text #1', $res, "SeoText Setter does NOT seem to work!");

		// test delete
		$this->blackholeMetadata->deleteSeoText();
		$res = $this->blackholeMetadata->getSeoText();
		$this->assertNull($res, "SeoText Delete does NOT seem to work!");

	}

	/**
	 * 	@covers \YPSeoMetadata\Metadata::getTitle
	 * 	@covers \YPSeoMetadata\Metadata::setTitle
	 * 	@covers \YPSeoMetadata\Metadata::deleteTitle
	 */
	public function testSetGetDeleteTitle() {

		// test get
		$res = $this->blackholeMetadata->getTitle('Default Text #2');
		$this->assertEquals('Default Text #2', $res, "`Title` Getter does NOT seem to work!");

		// test set
		$this->blackholeMetadata->setTitle('New Text #2');
		$res = $this->blackholeMetadata->getTitle('Default Text #2');
		$this->assertEquals('New Text #2', $res, "`Title` Setter does NOT seem to work!");

		// test delete
		$this->blackholeMetadata->deleteTitle();
		$res = $this->blackholeMetadata->getTitle();
		$this->assertNull($res, "`Title` Delete does NOT seem to work!");


	}

	/**
	 * 	@covers \YPSeoMetadata\Metadata::getDescription
	 * 	@covers \YPSeoMetadata\Metadata::setDescription
	 * 	@covers \YPSeoMetadata\Metadata::deleteDescription
	 */
	public function testSetGetDeleteDescription() {

		// test get
		$res = $this->blackholeMetadata->getDescription('Default Text #3');
		$this->assertEquals('Default Text #3', $res, "`Description` Getter does NOT seem to work!");

		// test set
		$this->blackholeMetadata->setDescription('New Text #3');
		$res = $this->blackholeMetadata->getDescription('Default Text #3');
		$this->assertEquals('New Text #3', $res, "`Description` Setter does NOT seem to work!");

		// test delete
		$this->blackholeMetadata->deleteDescription();
		$res = $this->blackholeMetadata->getDescription();
		$this->assertNull($res, "`Description` Delete does NOT seem to work!");

	}

    /**
     * @covers \YPSeoMetadata\Metadata::getIdentity
     */
    public function testGetIdentity() {
        $this->assertEquals('identity', $this->blackholeMetadata->getIdentity());
    }

    /**
     * @covers \YPSeoMetadata\Metadata::getType
     */
    public function testGetType() {
        $this->assertEquals('type', $this->blackholeMetadata->getType());
    }

}