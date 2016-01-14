<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workshop\Card;

class CardTest extends \PHPUnit_Framework_TestCase {
    //put your code here

    /**
     * @test
     * @dataProvider deadlineProvider
     */
    public function checkDeadline($input, $expected) {
        $card = new Card();
        $result = $card->checkDeadline($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @dataProvider storyPointsProvider
     */
    public function getStoryPointsValue($input1, $input2, $input3, $expected) {
        $card = new Card();
        $result = $card->getStoryPointsValue($input1, $input2, $input3);
        $this->assertEquals($expected, $result);
    }

    public function deadlineProvider() {
        return array(
            array("2016-01-16", null),
            array("2016-01-15", "Warning: the deadline date is 2016-01-15"),
            array("2015-01-15", "Warning: the deadline date was 2015-01-15"),
            array("2015-01-14", "Warning: the deadline date was 2015-01-14")
        );
    }

    public function storyPointsProvider() {
        return array(
            array(array(
                    "id" => 123,
                    "states_id" => 321,
                    "estimated_sp" => 123,
                    "reported_sp" => 321,
                    "sprint_id" => 123
                ), "kanban", null, "321/123")
        );
    }

}
