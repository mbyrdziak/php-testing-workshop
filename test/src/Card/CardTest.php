<?php

namespace Workshop\Card;

class CardTest extends \PHPUnit_Framework_TestCase{
    /**
     * @test
     */
    public function checkDeadLineForZero(){
      $deadLine = new Card();
      $res = $deadLine->checkDeadline("0000-00-00");
      $this->assertEquals(NULL,$res);
    }
    
    /**
     * @test
     */
    public function checkDeadLineForNULL(){
      $deadLine = new Card();
      $res = $deadLine->checkDeadline(NULL);
      $this->assertEquals(NULL,$res);
    }
    /**
     * @test
     * @dataProvider datesProvider
     */
    public function checkDeadLineForDates($input,$expected){
      $deadLine = new Card();
      $result = $deadLine->checkDeadline($input);
      $this->assertEquals($expected,$result);
    }
        public function datesProvider(){
            return array(
                array("2016-01-10", "Warning: the deadline date was 2016-01-10"),
                array("2016-01-14", "Warning: the deadline date is 2016-01-14"),
                array("2016-01-16", NULL)
            );
    }
    
    /**
     * @test
     */
    public function getStoryPointsValueForKanbanEstimaedCard(){
      $deadLine = new Card();
      $inputValue = array('id' => 1, 'states_id' => 2, "estimated_sp" => 15, "reported_sp" => 20);
      $res = $deadLine->getStoryPointsValue($inputValue, "kanban", null);
      $this->assertEquals("20/15",$res);
    }
    
        /**
     * @test
     */
    public function getStoryPointsValueForKanbanNotEstimatedCard(){
      $deadLine = new Card();
      $inputValue = array('id' => 1, 'states_id' => 2, "estimated_sp" => 15, "reported_sp" => 20);
      $res = $deadLine->getStoryPointsValue($inputValue, "kanban", null);
      $this->assertEquals("20/15",$res);
    }

}
