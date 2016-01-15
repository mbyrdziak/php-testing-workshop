<?php


namespace Workshop\Card;


class CardTest extends \PHPUnit_Framework_TestCase{
    /**
     * @dataProvider deadlineProvider
     */
    public function testCheckDeadline($a, $b) {
        $card = new Card();
        $result = $card->checkDeadline($a);
        $this->assertEquals($b, $result);
    }
    
    public function deadlineProvider(){
        return array(
            array(
                NULL, null
            ),
            array(
                "1999-01-01", "Warning: the deadline date was 1999-01-01"
            ),
            array(
                "2016-01-14", "Warning: the deadline date is 2016-01-14"
            ),
            array(
                "2026-01-14", null
            )
        );
    }
    
    
    public function testGetStoryPointsValueWithEstimatedAndReportedSP(){
        $valueArray = array(
            "id" => 1,
            "states_id" => 1333,
            "estimated_sp" => 10,
            "reported_sp" => 10
        );
        $boardType = "kanban";
        $sprintId = null;
        
        $card = new Card();
        $result = $card->getStoryPointsValue($valueArray,$boardType,$sprintId);
        $expected = "10/10";
        $this->assertEquals($expected,$result);
    }
    
    public function testGetStoryPointsValueWithNulls(){
        $card = new Card();
        $result = $card->getStoryPointsValue(null,null,null);
        $expected = "";
        $this->assertEquals($expected,$result);
    }
}
