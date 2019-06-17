<?php

namespace Jane\JsonSchema\Tests\Expected\Model;

class Childtype
{
    /**
     * 
     *
     * @var string
     */
    protected $childProperty;
    /**
     * 
     *
     * @var string
     */
    protected $inheritedProperty;
    /**
     * 
     *
     * @return string
     */
    public function getChildProperty() : string
    {
        return $this->childProperty;
    }
    /**
     * 
     *
     * @param string $childProperty
     *
     * @return self
     */
    public function setChildProperty(string $childProperty) : self
    {
        $this->childProperty = $childProperty;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getInheritedProperty() : string
    {
        return $this->inheritedProperty;
    }
    /**
     * 
     *
     * @param string $inheritedProperty
     *
     * @return self
     */
    public function setInheritedProperty(string $inheritedProperty) : self
    {
        $this->inheritedProperty = $inheritedProperty;
        return $this;
    }
}