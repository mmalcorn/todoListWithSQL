<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";
    //Server must reference local host on MAMP port.
    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {

        //NOTE: CLEAN UP DATABASE!!!
        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function testGetDescription()
        {
            //ARRANGE
            $description = "Take out the trash.";
            $test_task = new Task($description);

            //ACT
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function testSetDescription()
        {
            //ARRANGE
            $description = "Take out the trash.";
            $test_task = new Task($description);

            //ACT
            $test_task->setDescription("The trash is smelly.");
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals("The trash is smelly.", $result);

        }

        function testGetID()
        {
            //ARRANGE

            $id = 1;
            $description = "wash the cat";
            $test_task = new Task($description, $id);


            //ACT
            $result = $test_task->getID();

            //ASSERT
            $this->assertEquals(1, $result);
        }


        function testSave()
        {
            //ARRANGE

            $description = 'wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);

            //ACT
            $test_task->save();

            //ASSERT
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function testSaveSetsId()
        {
            //ARRANGE
            $description = 'wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);

            //Act
            $test_task->save();

            //Assert
            $this->assertEquals(true, is_numeric($test_task->getID()));

        }

        function testGetAll()
        {
            //ARRANGE
            $description ='wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = 'wash the dog and his belly';
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();

            //ACT
            $result = Task::getAll();

            //ASSERT
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function testDeleteAll()
        {
            //ARRANGE
            $description = 'wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = 'wash the dog and his belly';
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();

            //ACT
            Task::deleteAll();

            //ASSERT
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //ARRANGE
            $description = 'wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = 'wash the dog and his belly';
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();

            //ACT
            $result = Task::find($test_task->getID());

            //ASSERT
            $this->assertEquals($test_task, $result);
        }

        function testUpdate()
        {
            //ARRANGE
            $description = 'wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $new_description = 'wash the cat and her head';

            //ACT
            $test_task->update($new_description);

            //Assert
            $this->assertEquals('wash the cat and her head', $test_task->getDescription());
        }

        function testDeleteTask()
        {
            //ARRANGE
            $description = 'wash the cat and her toes bruh';
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = 'wash the dog and his belly';
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();

            //ACT
            $test_task->delete();

            //Assert
            $this->assertEquals([$test_task2], Task::getAll());
        }

    }
?>
