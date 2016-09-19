<?php

    class Task{
        private $description;

        function __construct($description)
        {
            $this->description = $description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;

        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}');");
        }

        static function getAll()
        {
            $database_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            // var_dump("database_tasks: " . $database_tasks . "\n");

            $database_data = $database_tasks->fetchAll();
            // var_dump("database_data: " . $database_data . "\n");

            $tasks = array();

            // foreach ($database_tasks as $task )
            // {
            //     $description = $task['description'];
            //     $new_task = new Task($description);
            //     array_push($tasks, $new_task);
            // }
            for ($task_index = 0; $task_index < count($database_data); $task_index++)
            {
                $description = $database_data[$task_index]['description'];
                //   var_dump($description);
                $new_task = new Task($description);
                //NOTE: This is the same as array push:
                $tasks[] = $new_task;
            }

            return $tasks;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks;");
        }

    }


 ?>
