<?php

    class Category{
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getID()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO categories (name) VALUES('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

    }


 ?>
