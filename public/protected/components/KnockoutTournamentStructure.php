<?php
class KnockoutTournamentStructure
{
    protected $numberOfTeams,
        $numberOfTies,
        $nextHighestPowerOfTwo,
        $numberOfByes,
        $numberOfRounds,
        $nextLowestPowerOfTwo,
        $numberOfFirstRoundTies,
        $structure,
        $roundNames,
        $currentMatchNumber;

        /**
         * Constructor
         * @param integer $numberOfTeams Number of Teams
         */
    public function __construct($numberOfTeams)
    {
        $this->setNumberOfTeams($numberOfTeams);

        $this->calculate();

        $this->build();
    }

    /**
     * Calculate Tournament Numbers
     * @return NULL
     */
    public function calculate()
    {
        $this->calculateNumberOfTies();
        $this->calculateNextHighestPowerOfTwo();
        $this->calculateNumberOfByes();
        $this->calculateNumberOfRounds();
        $this->calculateNextLowestPowerOfTwo();
        $this->calculateNumberOfFirstRoundTies();
    }

    /**
     * Setter for Number of Teams
     * @param integer $numberOfTeams Team Count
     * @return TournamentStructure
     */
    public function setNumberOfTeams($numberOfTeams)
    {
        $this->numberOfTeams = intval($numberOfTeams);

        return $this;
    }

    /**
     * Returns number of teams in the tournament
     * @return integer
     */
    public function getNumberOfTeams()
    {
        return $this->numberOfTeams;
    }

    /**
     * Calculate the number of ties the tournament will involve
     * @return KnockoutTournamentStructure
     */
    public function calculateNumberOfTies()
    {
        $this->numberOfTies = intval($this->numberOfTeams) - 1;

        return $this;
    }

    /**
     * Returns the number of ties the tournament will involve
     * @return integer
     */
    public function getNumberOfTies()
    {
        return $this->numberOfTies;
    }

    /**
     * Calculate the highest power of two
     * @return KnockoutTournamentStructure
     */
    public function calculateNextHighestPowerOfTwo()
    {
        $power = 0;
        $powerTeamCount = 2 * $power;

        while ($powerTeamCount < $this->getNumberOfTeams()) {

            $powerTeamCount = pow(2, $power);

            $power++;
        }

        // If the number of teams is equal the result of a power of 2
        if ($powerTeamCount == $this->getNumberOfTeams()) {
            $power--;
        }

        $this->nextHighestPowerOfTwo = $powerTeamCount;

        return $this;
    }

    /**
     * Returns the highest power of two
     * @return integer
     */
    public function getNextHighestPowerOfTwo()
    {
        return $this->nextHighestPowerOfTwo;
    }

    /**
     * Calculate the number of byes the tournament will involve
     * @return KnockoutTournamentStructure
     */
    public function calculateNumberOfByes()
    {
        $this->numberOfByes = $this->getNextHighestPowerOfTwo() - $this->getNumberOfTeams();

        return $this;
    }

    /**
     * Returns the number of byes the tournament will involve
     * @return integer
     */
    public function getNumberOfByes()
    {
        return $this->numberOfByes;
    }

    /**
     * Calculate the number of rounds the tournament will involve
     * @return KnockoutTournamentStructure
     */
    public function calculateNumberOfRounds()
    {
        $power = 0;
        $powerTeamCount = 2 * $power;

        while ($powerTeamCount < $this->getNumberOfTeams()) {
            $powerTeamCount = pow(2, $power);

            $power++;
        }

        $power--;

        $this->numberOfRounds = $power;

        return $this;
    }

    /**
     * Returns the number of rounds the tournament will involve
     * @return integer
     */
    public function getNumberOfRounds()
    {
        return $this->numberOfRounds;
    }

    /**
     * Calculate the lowest power of two
     * @return KnockoutTournamentStructure
     */
    public function calculateNextLowestPowerOfTwo()
    {
        $power = 0;
        $powerTeamCount = 2 * $power;

        while ($powerTeamCount < $this->getNumberOfTeams()) {

            $powerTeamCount = pow(2, $power);

            $power++;
        }

        $power--;
        $power--;
        $powerTeamCount = pow(2, $power);

        $this->nextLowestPowerOfTwo = $powerTeamCount;

        return $this;
    }

    /**
     * Returns the lowest power of two
     * @return integer
     */
    public function getNextLowestPowerOfTwo()
    {
        return $this->nextLowestPowerOfTwo;
    }

    /**
     * Calculate the number of first round ties the tournament will involve
     * @return KnockoutTournamentStructure
     */
    public function calculateNumberOfFirstRoundTies()
    {
        $this->numberOfFirstRoundTies = $this->getNumberOfTeams() - $this->getNextLowestPowerOfTwo();

        return $this;
    }

    /**
     * Returns the number of first round ties the tournament will involve
     * @return integer
     */
    public function getNumberOfFirstRoundTies()
    {
        return $this->numberOfFirstRoundTies;
    }

    /**
     * Build the round mappings
     * @return KnockoutTournamentStructure
     */
    public function build()
    {
        $rounds = array();
        $tieNumber = $this->getNextHighestPowerOfTwo() - 1;
        $this->currentMatchNumber = $this->getNumberOfTies();

        for ($roundNumber = 1;$roundNumber <= $this->getNumberOfRounds();$roundNumber++) {
            if ($this->isFirstRound($roundNumber)) {
                $round = $this->buildFirstRound($roundNumber, $tieNumber);
            } else {
                $round = $this->buildFullRound($roundNumber, $tieNumber);
            }

            $tieNumber = $tieNumber - pow(2, $roundNumber - 1);

            array_unshift($rounds, $round);
        }

        $this->structure = $rounds;

        return $this;
    }

    /**
     * Build a full round of matches
     * @param  integer $roundNumber Current round number
     * @param  integer $tieNumber   Last Current Tie Number
     * @return array
     */
    public function buildFullRound($roundNumber, $tieNumber)
    {
        $ties = array();
        $roundTieCount = pow(2, $roundNumber - 1);

        $previousRoundTieNumber = $tieNumber - $roundTieCount;

        $j = 0;
        while($j < $roundTieCount) {
            $tie = $this->buildNormalTie($tieNumber, &$previousRoundTieNumber);

            $tieNumber--;

            array_unshift($ties, $tie);

            $j++;
        }

        return $ties;
    }

    /**
     * Build the first round of matches
     * @param  integer $roundNumber Current round number
     * @param  integer $tieNumber   Last Tie Number
     * @return array
     */
    public function buildFirstRound($roundNumber, $tieNumber)
    {
        $ties = array();
        $roundTieCount = pow(2, $roundNumber - 1);

        $previousRoundTieNumber = $tieNumber - $roundTieCount;

        $outstandingByes = $this->getNumberOfByes();

        $j = 0;
        while($j < $roundTieCount && $this->currentMatchNumber > 0) {
            $tie = $this->buildFirstRoundTie($tieNumber, $previousRoundTieNumber, $outstandingByes);

            array_unshift($ties, $tie);

            $tieNumber--;

            $j++;
        }

        return $ties;
    }

    /**
     * Create a Normal Tie (Non-first round)
     * @param  integer $tieNumber               Current Tie Number
     * @param  integer $previousRoundTieNumber  The Last Tie Number used
     * @return object
     */
    public function buildNormalTie($tieNumber, $previousRoundTieNumber)
    {
        $previousRoundTieNumber = $previousRoundTieNumber - 2;

        return (object) array(
            'tie_number'      => $tieNumber,
            'match_number'    => $this->currentMatchNumber--,
            'type'            => 'tie',
            'home_tie_winner' => $previousRoundTieNumber + 1,
            'away_tie_winner' => $previousRoundTieNumber + 2,
        );
    }

    /**
     * Create a First Round Tie
     * @param  integer $tieNumber               Current Tie Number
     * @param  integer $previousRoundTieNumber  The Last Tie Number used
     * @param  integer $outstandingByes         The number of byes still left
     * @return object
     */
    public function buildFirstRoundTie($tieNumber, $previousRoundTieNumber, &$outstandingByes)
    {
        if ($outstandingByes > 0 && $this->currentMatchNumber % 2) {
            $outstandingByes--;

            return (object) array(
                'tie_number' => $tieNumber,
                'type'       => 'bye',
            );
        }

        return (object) array(
            'tie_number'      => $tieNumber,
            'match_number'    => $this->currentMatchNumber--,
            'type'            => 'match',
        );
    }

    /**
     * Is this the first round?
     * @param  integer  $roundNumber [description]
     * @return boolean              [description]
     */
    public function isFirstRound($roundNumber)
    {
        return $roundNumber == $this->getNumberOfRounds();
    }

    public function display($echo = true)
    {
        $html = '<table class="table table-striped table-bordered">
<tbody>';

        $i = 0;
        $teamNumber = 1;
        foreach ($this->structure as $ties) {
            $html .= '<tr>
    <td colspan="4"><strong>' . $this->getRoundName($i) . '</strong></td>
</tr>';

            foreach ($ties as $tie) {
                switch($tie->type) {
                    case 'match':
            $html .= '<tr>
    <td class="span2">Match ' . $tie->match_number . '</td>
    <td class="span4">Team</td>
    <td class="span2"> vs</td>
    <td class="span4">Team</td>
</tr>';
                        break;
                    case 'tie':
            $html .= '<tr>
    <td class="span2">Match ' . $tie->match_number . '</td>
    <td class="span4">' . $this->displayOpponent($tie->home_tie_winner) . '</td>
    <td class="span2"> vs</td>
    <td class="span4">' . $this->displayOpponent($tie->away_tie_winner) . '</td>
</tr>';
                        break;
                }
            }

            $i++;
        }

        $html .= '</tbody>
</table>';

        if ($echo) {
            echo $html;
        }

        return $html;
    }

    /**
     * Show the Opponent name
     * @param  integer $previousTieNumber Previous Tie Number
     * @return string
     */
    public function displayOpponent($previousTieNumber)
    {
        foreach ($this->structure as $ties) {
            foreach ($ties as $tie) {
                if ($tie->tie_number == $previousTieNumber) {
                    switch ($tie->type) {
                        case 'bye':
                            return 'Bye';
                        default:
                            return "Winner of Match {$tie->match_number}";
                    }
                }

            }
        }
    }

    /**
     * Return the round name based upon the passed round number
     * @param  integer $roundNumber Round Number
     * @return string               Round Name
     */
    public function getRoundName($roundNumber)
    {
        if ($roundNumber == 0 && $this->getNumberOfByes()) {
            return sprintf('Round %d', $roundNumber + 1);
        }

        switch ($this->getNumberOfRounds() - $roundNumber) {
            case 1:
                return 'Final';
                break;
            case 2:
                return 'Semi Final';
                break;
            case 3:
                return 'Quarter Final';
                break;
            case 4:
                return 'Last 16';
                break;
            case 5:
                return 'Last 32';
                break;
        }

        return sprintf('Round %d', $roundNumber + 1);
    }
}