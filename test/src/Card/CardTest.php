<?php

namespace Workshop\Card;

class CardTest extends \PHPUnit_Framework_TestCase {
   
    private $card =null;
    /**
     * @before
     */
    public function init()
    {
        $this->card = new Card();
    }
    /**
    * @test
    */
    public function checkDataIsSet() {
        
        $result = $this->card->checkDeadline("-");
        $this->assertNull($result);
    }
    
    /**
    * @test
    */
    public function checkDataIsCorrectPast() {
        $card = new Card();
        $result = $card->checkDeadline("2015-11-30");
        $this->assertEquals("Warning: the deadline date was 2015-11-30", $result);
    }
    
    /**
    * @test
    */
    public function checkDataIsCorrectFuture() {
        $card = new Card();
        $result = $card->checkDeadline("2016-11-30");
        $this->assertEquals(null, $result);
    }
    
    /**
    * @test
    */
    public function checkDataIsNotCorrect() {
        $card = new Card();
        $this->setExpectedException("Exception");
        $result = $card->checkDeadline("2015-13-32");
        
    }
    
    /**
    * @test
    * @dataProvider provider
    */
    public function checkCorrectMessage($n) {
        $card = new Card();
        $result = $card->checkDeadline($n);
        $this->assertEquals("Warning: the deadline date was ".$n, $result);
        
    }
    
    public function provider() {
        return array(array("2015-11-30"), array("2015-11-29"));
    }
    
    /**
    * @test
    * @dataProvider provider2
    */
    public function checkCorrectReturn($r, $e) {
        $card = new Card();
        $value = array('id' => 1, 'states_id'=>1, 'reported_sp' => $r, 'estimated_sp' => $e );
        $result = $card->getStoryPointsValue($value, 'kanban', null);
        $this->assertEquals($r."/".$e, $result);
        
    }
    
    public function provider2() {
        return array(
            array(12, 40),
            array(2, 4),
            array(45, 30)
            );
    }
    
    /**
    * @test
    */
    public function checkZerosGiven() {
        $card = new Card();
        $value = array('id' => 1, 'states_id'=>1, 'reported_sp' => 0, 'estimated_sp' => 0 );
        $result = $card->getStoryPointsValue($value, 'kanban', null);
        $this->assertEquals('<span class="familyERSP1 estimatedreported_values" title="Work progress on all children tasks">(<span class="estimatedReportedSp">10/10</span>)</span>', $result);
        
    }
    
}

