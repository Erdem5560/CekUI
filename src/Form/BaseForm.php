<?php

declare(strict_types=1);

namespace Form;

use pocketmine\form\Form;

abstract class BaseForm implements Form{

	protected $title;

	public function __construct(string $title){
		$this->title = $title;
	}

	public function getTitle() : string{
		return $this->title;
	}

	final public function jsonSerialize() : array{
		$ret = $this->serializeFormData();
		$ret["type"] = $this->getType();
		$ret["title"] = $this->getTitle();

		return $ret;
	}

	abstract protected function getType() : string;
	abstract protected function serializeFormData() : array;
  }
