<?php
namespace Workshop\Card;


class CardTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @dataProvider dateProvider
     */
    public function checkDeadline($input, $expected) {
        $Card = new Card();
        $result = $Card->checkDeadline($input);
        $this->assertEquals($expected, $result);
        
        
    }
    
    /**
     * @test
     * @dataProvider getStoryPointsProvider
     */
    
    public function checkGetStoryPointsValue($input1, $intput2, $input3, $expected){
        $Card = new Card();
        $result = $Card->getStoryPointsValue($input1, $input2, $input3);
        $this->assertEquals($expected, $result);
    }
    
  
    public function dateProvider() {
        return array(
            array('2016-01-18', null),
            array('2016-01-10', 'Warning: the deadline date was 2016-01-10')
        );
    }
    
    public function getStoryPointsProvider() {
        return array(
            array(array("id" => 44,
                "states_id" => 4,
                "reported_sp" => 10,
                "estimated_sp" => 10,
                "sprint_id" => 20), "kanban", null, '10/10'),
        );
    }

}