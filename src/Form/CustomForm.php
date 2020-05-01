<?php

declare(strict_types=1);

namespace Form;

use Form\Element\Element;
use pocketmine\form\FormValidationException;
use pocketmine\Player;
use pocketmine\utils\Utils;

class CustomForm extends BaseForm{

	private $elements;
	private $elementMap = [];
	private $onSubmit;
	private $onClose = null;

	public function __construct(string $title, array $elements, \Closure $onSubmit, ?\Closure $onClose = null){
	parent::__construct($title);
	$this->elements = array_values($elements);
	foreach($this->elements as $element){
	if(isset($this->elements[$element->getName()])){
	throw new \InvalidArgumentException("Multiple elements cannot have the same name, found \"" . $element->getName() . "\" more than once");
	}
	$this->elementMap[$element->getName()] = $element;
	}
	Utils::validateCallableSignature(function(Player $player, CustomFormResponse $response) : void{}, $onSubmit);
	$this->onSubmit = $onSubmit;
	if($onClose !== null){
	Utils::validateCallableSignature(function(Player $player) : void{}, $onClose);
	$this->onClose = $onClose;
	  }
	}

	public function getElement(int $index):?Element{
	return $this->elements[$index] ?? null;
	}

	public function getElementByName(string $name) : ?CustomFormElement{
		return $this->elementMap[$name] ?? null;
	}

	public function getAllElements():array{
	return $this->elements;
	}

	final public function handleResponse(Player $player, $data) : void{
	if($data === null){
	if($this->onClose !== null){
	($this->onClose)($player);
	  }
	}elseif(is_array($data)){
	if(($actual = count($data)) !== ($expected = count($this->elements))){
	throw new FormValidationException("Expected $expected result data, got $actual");
	}
	$values = [];
	foreach($data as $index => $value){
    if(!isset($this->elements[$index])){
	throw new FormValidationException("Element at offset $index does not exist");
	}
	$element = $this->elements[$index];
	try{
	$element->validateValue($value);
	}catch(FormValidationException $e){
	throw new FormValidationException("Validation failed for element \"" . $element->getName() . "\": " . $e->getMessage(), 0, $e);
	}
	$values[$element->getName()] = $value;
	}
	($this->onSubmit)($player, new CustomFormResponse($values));
		}else{
    throw new FormValidationException("Expected array or null, got " . gettype($data));
	  }
	}

	protected function getType():string{
	return "custom_form";
	}

	protected function serializeFormData():array{
	return [
	"content" => $this->elements
	  ];
	}
  }
