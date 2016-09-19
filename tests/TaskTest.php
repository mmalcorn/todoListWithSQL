<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    //Server must reference local host on MAMP port.
    $server = 'mysql:host=localhost:8889;dbname=todo_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        function test_save()
        {
            //ARRANGE
            $description ='wash the cat';
            $test_task = new Task($description);
            $expected_output = $test_task;
            //ACT
            $test_task->save();
            //ASSERT
            //NOTE: Result is an array that contains instances of task objects.
            $result = Task::getAll();
            //$result[0] takes the first instance inside of the results array (references tasks in task.php)
            $this->assertEquals($expected_output, $result[0]);
            Task::deleteAll();

            // print("test_task: ");
            // var_dump($test_task);
            // print("\n");
            //
            // print("test_task->getDescription(): ");
            // var_dump($test_task->getDescription());
            // print("\n");
            //
            // print("result[0]: ");
            // var_dump($result[0]);
            // print("\n");
            //
            // print("result[0]->getDescription(): ");
            // var_dump($result[0]->getDescription());
            // print("\n");
            //
            // print("description: ");
            // var_dump($description);
            // print("\n");
        }

        function test_getAll()
        {
            //ARRANGE
            $description ='wash the cat';
            $description2 ='wash the dog';
            $test_task = new Task($description);
            $test_task2 = new Task($description2);
            $expected_output = [$test_task, $test_task2];
            $test_task->save();
            $test_task2->save();

            //ACT
            $result = Task::getAll();
            // var_dump($result);

            //ASSERT
            $this->assertEquals($expected_output, $result);
            Task::deleteAll();
        }

        // function test_deleteAll()
        // {
        //     //ARRANGE
        //     $description = 'wash the cat';
        //     $description2 = 'wash the dog';
        //     $test_task = new Task ($description);
        //     $test_task->save();
        //     $test_task2 = new Task ($description);
        //     $test_task->save();
        //
        // }
    }
?>
