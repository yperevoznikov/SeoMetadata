<?php

namespace YPSeoMetadata;


/**
 * Class Metadata
 * @package YMetadata
 */
class Metadata {

    const DOMAIN = 'YPSeoMetadata_items';

    /**
     * @var bool
     */
    private $dirty = false;

    /**
     * @var string
     */
    private $identity;

    /**
     * @var string
     */
    private $type;

	/**
	 * @var string
	 */
	private $seoText;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $description;

    /**
     * @param \YPFlatStorage\IClient $storage
     * @param $identity
     * @param $type
     */
    public function __construct(\YPFlatStorage\IClient $storage, $identity, $type=null, $fields=array()) {
        $this->storage = $storage;
        $this->identity = $identity;
        $this->type = $type;

        if (isset($fields['seoText'])) {
            $this->seoText = $fields['seoText'];
        }
        if (isset($fields['title'])) {
            $this->title = $fields['title'];
        }
        if (isset($fields['description'])) {
            $this->description = $fields['description'];
        }
	}

    /**
     * At the end of the process we store data if need so
     */
    public function __destruct(){
        if ($this->dirty) {
            $this->forceSave();
        }
    }

    /**
     * @param string $default
     * @return null|string
     */
    public function getSeoText($default=null) {
		return (isset($this->seoText) && !empty($this->seoText)) ? $this->seoText : $default;
	}

    /**
     * @param $newSeoText
     */
    public function setSeoText($newSeoText) {
		$this->seoText = $newSeoText;
        $this->dirty = true;
	}

    /**
     * @return null
     */
    public function deleteSeoText() {
		unset($this->seoText);
	}

    /**
     * @param string $default
     * @return null|string
     */
    public function getTitle($default=null) {
		return (isset($this->title) && !empty($this->title)) ? $this->title : $default;
	}

    /**
     * @param $newTitle
     */
    public function setTitle($newTitle) {
		$this->title = $newTitle;
        $this->dirty = true;
	}

    /**
     * @return null
     */
    public function deleteTitle() {
		unset($this->title);
	}

    /**
     * @param string $default
     * @return null|string
     */
    public function getDescription($default=null) {
		return (isset($this->description) && !empty($this->description)) ? $this->description : $default;
	}

    /**
     * @param $newDescription
     */
    public function setDescription($newDescription) {
		$this->description = $newDescription;
        $this->dirty = true;
	}

    /**
     * @return null
     */
    public function deleteDescription() {
		unset($this->description);
	}

    /**
     * @return string
     */
    public function getIdentity() {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Saves data into storage
     */
    public function forceSave()
    {
        $criteria = array(
            'identity' => $this->getIdentity(),
            'type' => $this->getType()
        );
        $fields = array(
            'seo_text' => $this->getSeoText(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
        );
        $this->storage->upsert(self::DOMAIN, $criteria, $fields);

        // reset `dirty` flag
        $this->dirty = false;
    }

}
