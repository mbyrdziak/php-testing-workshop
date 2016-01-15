<?php

namespace Workshop\Card;

class CardTest extends \PHPUnit_Framework_TestCase{

    /**
     * @dataProvider deadlineProvider
     */
    public function testCheckDeadline($deadline, $expected) {
        $check = new Card();
        $result = $check->checkDeadline($deadline);
        $this->assertEquals($expected, $result);
    }

    public function deadlineProvider() {
        return array(
            array("0000-00-00",null),
            array("2016-01-01","Warning: the deadline date was 2016-01-01"),
            array("2016-11-01",null),
            
        );
    }
    
    
     /**
     * @dataProvider ProviderGetStoryPoint
     */
    public function testGetStoryPoints($input1,$input2,$input3, $expected) {
        $check = new Card();
        $result = $check->getStoryPointsValue($input1,$input2,$input3);
        $this->assertEquals($expected, $result);
    }

    public function ProviderGetStoryPoint() {
        return array(
            array(array(
                    "id" => 10,
                    "states_id" => 3,
                    "estimated_sp" => 12,
                    "reported_sp" => 32,
                    "sprint_id" => 1),
                    "kanban", null, "32/12")
            );
    }

}

