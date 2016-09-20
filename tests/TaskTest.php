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

        function test_getID()
        {
            //ARRANGE
            $name = 'Home stuff';
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "wash the cat";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            //ACT
            $result = $test_task->getID();

            //ASSERT
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCategoryId()
        {
            //ARRANGE
            $name = 'Home stuff';
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "wash the cat";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);

            //Act
            $result = $test_task->getCategoryId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {
            //ARRANGE
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description ='wash the cat';
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            //ACT
            $test_task->save();
            //ASSERT
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //ARRANGE
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description ='wash the cat';
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 ='wash the dog';
            $test_task2 = new Task($description2, $id, $category_id);
            $test_task2->save();


            //ACT
            $result = Task::getAll();
            // var_dump($result);

            //ASSERT
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //ARRANGE
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description ='wash the cat';
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 ='wash the dog';
            $test_task2 = new Task($description2, $id, $category_id);
            $test_task2->save();

            //ACT
            Task::deleteAll();

            //ASSERT
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //ARRANGE
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description ='wash the cat';
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 ='wash the dog';
            $test_task2 = new Task($description2, $id, $category_id);
            $test_task2->save();

            //ACT
            $result = Task::find($test_task->getID());

            //ASSERT
            $this->assertEquals($test_task, $result);
        }
    }
?>
