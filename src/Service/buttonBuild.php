<?php

namespace NeoxTable\NeoxTableBundle\Service;

class buttonBuild
{

    protected string $type = "a" ;

    protected string $label = "" ;

    protected string $ref ;

    protected ?string $class = "";

    protected ?string $style = "" ;

    protected ?string $data = "" ;

    protected ?string $icon = "";


    /**
     * @param string|null $path
     * @return string
     */

    public function build( ?string $path = null): string
    {
        switch ($this->type) {
            case "delete":
                $s = "<form style='margin:0px;' method='post' onsubmit='return confirm(". '"' . $this->label . '"' .");' action='$this->ref'> 
                <input type='hidden' name='_token' value='{{ csrf_token('delete' ~ item.id) }}'>" .
                "<button type='submit' $this->class $this->style > $this->icon </button>" . "</form>";
                break;
            case "pin":   // set condition !!! item.publish set !!!
                $s = "<form style='margin:0px;' method='post' onsubmit='return confirm(". '"' . $this->label . '"' .");' action='$this->ref'> 
                <input type='hidden' name='_token' value='{{ csrf_token('pin' ~ item.id) }}'>" .
                "<button type='submit' $this->class $this->style > $this->icon </button>" . "</form>";

                $s = "{% if item.publish is defined %} $s {% endif %}";
                break;
            default :
                $s = "<$this->type $this->ref $this->class $this->style > $this->icon $this->label </$this->type>" ;
                break;
        }
        return $s ;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return buttonBuild
     */
    public function setLabel(?string $label): self
    {
        $this->label = $label;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return buttonBuild
     */
    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRef(): ?string
    {
        return $this->ref;
    }

    /**
     * @param string|null $ref
     * @param bool|null $clear
     * @return buttonBuild
     */
    public function setRef(?string $ref, ?bool $clear = false): self
    {
        $this->ref =  $clear ? $ref: "href=$ref";
        return $this;
    }

    /**
     * @return string|null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param string|null $class
     * @return buttonBuild
     */
    public function setClass(?string $class): self
    {
        $this->class = " class='button button-mini button-rounded $class'" ;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStyle(): ?string
    {
        return $this->style;
    }

    /**
     * @param string|null $style
     * @param bool|null $clear = false
     * @return buttonBuild
     */
    public function setStyle(?string $style, ?bool $clear = false): self
    {
        $this->style = $clear ? "style='$style'" : "style='margin-left:3px; padding-left:3px $style'" ;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string|null $data
     * @return buttonBuild
     */
    public function setData(?string $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return buttonBuild
     */
    public function setIcon(?string $icon): self
    {
        $this->icon = "<i class='$icon'></i>";
        return $this;
    }
}