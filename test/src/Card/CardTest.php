<?php

namespace Workshop\Card;

class CardTest extends \PHPUnit_Framework_TestCase{
    
    /**
     * @test
     */
    public function cardCheckDeadlineForNull(){
        $card = new Card();
        $result = $card->checkDeadline(null);
        $this->assertNull($result);
    }
    
    /**
     * @test
     */
    public function cardCheckDeadlineForDateZero(){
        $card = new Card();
        $result = $card->checkDeadline('0000-00-00');
        $this->assertNull($result);
    }
    
    /**
     * @test
     */
    public function cardCheckDeadlineForDateLessThanZero(){
        $card = new Card();
        $result = $card->checkDeadline(-15);
        $this->assertEquals('Warning: the deadline date is -15', $result);
    }
    
    /**
     * @test
     */
    public function cardGetStoryPointsHmm(){
        $card = new Card();
        $array = array('id'  => '0', 'states_id'  => '0', 'estimated_sp'=> '15', 'reported_sp' => '20');
        $result = $card->getStoryPointsValue($array, 'kanban', null);
        $this->assertEquals('20/15', $result);
    }
    
    /**
     * @test
     */
    public function cardGetStoryPointsForNull(){
        $card = new Card();
        $result = $card->getStoryPointsValue(null, 'kanban', null);
        $this->assertEquals('', $result);
    }
}
