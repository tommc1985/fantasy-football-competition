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
        $roundNames = array(
            "Final",
            "Semi Final",
            "Quarter Final",
            "Last 16",
            "Last 32",
            "% Round"
        ),
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

    public function buildFirstRound($roundNumber, $tieNumber)
    {
        $ties = array();
        $roundTieCount = pow(2, $roundNumber - 1);

        $previousRoundTieNumber = $tieNumber - $roundTieCount;

        $outstandingByes = $this->getNumberOfByes();

        $j = 0;
        while($j < $roundTieCount) {

            $tie = $this->buildFirstRoundTie($tieNumber, $previousRoundTieNumber, $outstandingByes);

            array_unshift($ties, $tie);

            $tieNumber--;

            $j++;
        }

        return $ties;
    }

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

    public function buildFirstRoundTie($tieNumber, $previousRoundTieNumber, &$outstandingByes)
    {
        if ($outstandingByes > 0) {
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

    public function isFirstRound($roundNumber)
    {
        return $roundNumber == $this->getNumberOfRounds();
    }

    public function display($echo = true)
    {
        $html = '<table>
<tbody>';

        $i = 0;
        foreach ($this->structure as $ties) {
            $html .= '<tr>
    <td colspan="4">Round ' . $i . '</td>
</tr>';

            foreach ($ties as $tie) {
                switch($tie->type) {
                    case 'match':
            $html .= '<tr>
    <td colspan="4">Match ' . $tie->match_number . '</td>
</tr>';
                        break;
                    case 'tie':
            $html .= '<tr>
    <td class="span1">Match ' . $tie->match_number . '</td>
    <td class="span5">' . $this->displayOpponent($tie->home_tie_winner) . '</td>
    <td class="span1"> vs</td>
    <td class="span5">' . $this->displayOpponent($tie->away_tie_winner) . '</td>
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
}