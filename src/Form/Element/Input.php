<?php

declare(strict_types=1);

namespace Form\Element;

use pocketmine\form\FormValidationException;

class Input extends Element{

	private $hint;
	private $default;
	
	public function __construct(string $name, string $text, string $hintText = "", string $defaultText = ""){
	parent::__construct($name, $text);
	$this->hint = $hintText;
	$this->default = $defaultText;
	}

	public function getType():string{
 	  return "input";
	}

	public function validateValue($value):void{
	if(!is_string($value)){
	throw new FormValidationException("Expected string, got " . gettype($value));
	  }
	}

	public function getHintText():string{
	  return $this->hint;
	}

	public function getDefaultText():string{
	  return $this->default;
	}

	protected function serializeElementData():array{
	return [
	"placeholder" => $this->hint,
	"default" => $this->default
	  ];
	}
  }
