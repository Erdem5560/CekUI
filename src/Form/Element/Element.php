<?php

declare(strict_types=1);

namespace Form\Element;

use pocketmine\form\FormValidationException;

abstract class Element implements \JsonSerializable{

	private $name;
	private $text;

	public function __construct(string $name, string $text){
		$this->name = $name;
		$this->text = $text;
	}

	abstract public function getType() : string;

	public function getName() : string{
		return $this->name;
	}

	public function getText() : string{
		return $this->text;
	}

	abstract public function validateValue($value) : void;

	final public function jsonSerialize() : array{
		$ret = $this->serializeElementData();
		$ret["type"] = $this->getType();
		$ret["text"] = $this->getText();

		return $ret;
	}

	abstract protected function serializeElementData() : array;
  }
