<?php

namespace Workshop\Card;

class CardTest extends \PHPUnit_Framework_TestCase {
    private $card;
    
    /**
     * @before
     */
    public function init(){
        $this->card = new Card();
    }
    
    public function testCheckDeadlineIsNotSet(){
        $result = $this->card->checkDeadline("0000-00-00");
        $this->assertNull($result);
    }
    
    public function testCheckDeadlineIsSetBefore(){
        $result = $this->card->checkDeadline("2015-06-05");
        $this->assertEquals("Warning: the deadline date was 2015-06-05", $result);
    }
    
    public function testCheckDeadlineIsSetAfter(){
        $result = $this->card->checkDeadline("2016-06-05");
        $this->assertNull($result);
    }
    
    public function testCheckDeadlineIsSetOnActualDate(){
        $result = $this->card->checkDeadline("2016-01-14");
        $this->assertEquals("Warning: the deadline date is 2016-01-14", $result);
    }
    
    public function testGetStoryPointsValue(){
        $value['id'] = 1;
        $value ['states_id'] = 2;
        $value['estimated_sp'] = 3;
        $value['reported_sp'] = 3;
        
        $result = $this->card->getStoryPointsValue($value, 'kanban', 2);
        $this->assertEquals("3/3", $result);
    }
}

