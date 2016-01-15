<?php

namespace Workshop\Card;

class TestCard extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider checkDeadlineProvider
     */
    public function testCheckDeadline($input, $expected) {
        $exampleCard = new Card();
        $result = $exampleCard->checkDeadline($input);
        $this->assertEquals($expected, $result, "<--------->");
        
    }
//można też budować wiele funkcji dla różnych przypadków bo w providerze nie do końca widac o jaki przypadek chodzi
    public function checkDeadlineProvider() {
        return array(
            array("2016-12-23", null),
            array("0000-00-00", null),
            array("-", null),
            array("2015-01-01", "Warning: the deadline date was 2015-01-01"),
            array("2016-01-14", "Warning: the deadline date is 2016-01-14"),
            array("14-01-2016", "Warning: the deadline date is 14-01-2016"),
        );
    }
    /**
     * @dataProvider storyPointsProvider
     */    
    public function testGetStoryPointsValue($input1,$input2,$input3, $expected) {
        $exampleCard = new Card();
        $result = $exampleCard->getStoryPointsValue($input1,$input2,$input3);
        $this->assertEquals($expected, $result, "<--------->");
    }
    
    public function storyPointsProvider() {
        return array(
            array(array(
                    "id" => 678,
                    "states_id" => 67,
                    "estimated_sp" => 123,
                    "reported_sp" => 321,
                    "sprint_id" => 13
                ), "kanban", null, "321/123")
        );
    }

}
