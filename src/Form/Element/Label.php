<?php

declare(strict_types=1);

namespace Form\Element;

class Label extends Element{

	public function getType() : string{
	  return "label";
	}

	public function validateValue($value):void{
	  assert($value === null);
	}

	protected function serializeElementData():array{
	  return [];
	}
  }
