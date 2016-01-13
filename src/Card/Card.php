<?php
namespace Workshop\Card;

class Card {
    
    private $cardId;
    private $boardIdFromCard;
    private $cardStateType;
    private $cardTeamId;
    private $cardOwners = array();
    private $cardDetails = array();
    private $stoppedCardReasons = array();
    private $sqlQuery;
    private $isCardViewType;
    private $isCardPullType;
    
    public function checkDeadline($deadline) {
        $deadlineDate = $deadline;
        $today = new DateTime ();
        $warningText = null;
        if ($deadline == "0000-00-00" || $deadline == null)
            $deadlineDate = "-";
        if ($deadlineDate != "-") {
            $diff = $today->diff(new DateTime($deadlineDate));
            $diff_value = (int) $diff->format('%R%a');
            if ($diff_value == 0)
                $warningText = "Warning: the deadline date is $deadlineDate";
            else if ($diff_value < 0)
                $warningText = "Warning: the deadline date was $deadlineDate";
            else
                $warningText = null;
        }
        return $warningText;
    }
    
    public function getStoryPointsValue($value, $boardType, $sprintId) {
        $content = '';
        $cardFamily = $this->getCardFamily($value['id'], 1);
        $stateData = $this->getStateData($value ['states_id'], false);
        $sumRSP = 0;
        $sumESP = 0;
        $msgText = 'all';

        if ($cardFamily) {
            if ($stateData ['state_type'] == 'inbox' || $boardType == 'kanban') {
                foreach ($cardFamily as $val) {
                    $sumRSP += $val ['reported_sp'];
                    $sumESP += $val ['estimated_sp'];
                }
            } else {
                $msgText = 'sprint';
                if (isset($sprintId))
                    foreach ($cardFamily as $val) {
                        if ($sprintId == $val ['sprint_id']) {
                            $sumRSP += $val ['reported_sp'];
                            $sumESP += $val ['estimated_sp'];
                        }
                    }
            }
        }

        if ($value != null)
            if ($value['estimated_sp'] > 0) {
                $content.= $value['reported_sp'] . '/' . $value['estimated_sp'];
            } else if ($sumESP > 0 && $cardFamily) {
                $content.= '<span class="familyERSP' . $value['id'] . ' estimatedreported_values" title="Work progress on ' . $msgText . ' children tasks">(<span class="estimatedReportedSp">' . $sumRSP . '/' . $sumESP . '</span>)</span>';
            }

        return $content;
    }
    
    private function getCardFamily($id, $unknown) {
        return array(
            array(
                'reported_sp' => 10,
                'estimated_sp' => 10,
            )
        );
    }

    private function getStateData($id, $unknown) {
        return array(
            'state_type' => 'inbox',
        );
    }

}