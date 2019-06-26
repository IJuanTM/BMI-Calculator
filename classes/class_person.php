<?php

class Person
{
    protected $firstname;
    protected $infix;
    protected $lastname;

    public function set_firstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function get_firstname()
    {
        return $this->firstname;
    }

    public function set_infix($infix)
    {
        $this->infix = $infix;
    }
    public function get_infix()
    {
        return $this->infix;
    }

    public function set_lastname($lastname)
    {
        $this->lastname = $lastname;
    }
    public function get_lastname()
    {
        return $this->lastname;
    }


    protected function make_full_name()
    {
        return $this->firstname . " " . $this->infix . " " . $this->lastname;
    }
}
