<?php
class TournamentStructure
{
    protected $numberOfTeams,
        $numberOfMatches,
        $nextHighestPowerOfTwo,
        $numberOfByes,
        $numberOfRounds,
        $nextLowestPowerOfTwo,
        $numberOfFirstRoundMatches,
        $roundMappings;

    public function __construct($numberOfTeams)
    {
        $this->setNumberOfTeams($numberOfTeams);

        $this->calculate();

        $this->buildRoundMappings();
    }

    public function calculate()
    {
        $this->calculateNumberOfMatches();
        $this->calculateNextHighestPowerOfTwo();
        $this->calculateNumberOfByes();
        $this->calculateNumberOfRounds();
        $this->calculateNextLowestPowerOfTwo();
        $this->calculateNumberOfFirstRoundMatches();
    }

    public function setNumberOfTeams($numberOfTeams)
    {
        $this->numberOfTeams = intval($numberOfTeams);
    }

    public function getNumberOfTeams()
    {
        return $this->numberOfTeams;
    }

    public function calculateNumberOfMatches()
    {
        $this->numberOfMatches = intval($this->numberOfTeams) - 1;
    }

    public function getNumberOfMatches()
    {
        return $this->numberOfMatches;
    }

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
    }

    public function getNextHighestPowerOfTwo()
    {
        return $this->nextHighestPowerOfTwo;
    }

    public function calculateNumberOfByes()
    {
        $this->numberOfByes = $this->getNextHighestPowerOfTwo() - $this->getNumberOfTeams();
    }

    public function getNumberOfByes()
    {
        return $this->numberOfByes;
    }

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
    }

    public function getNumberOfRounds()
    {
        return $this->numberOfRounds;
    }

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
    }

    public function getNextLowestPowerOfTwo()
    {
        return $this->nextLowestPowerOfTwo;
    }

    public function calculateNumberOfFirstRoundMatches()
    {
        $this->numberOfFirstRoundMatches = $this->getNumberOfTeams() - $this->getNextLowestPowerOfTwo();
    }

    public function getNumberOfFirstRoundMatches()
    {
        return $this->numberOfFirstRoundMatches;
    }

    public function buildRoundMappings()
    {
        $rounds = array();
        $matchNumber = $this->getNumberOfMatches();

        $i = 0;
        while ($i < $this->getNumberOfRounds()) {
            $round = array();
            $roundMatchCount = pow(2, $i);

            $j = 0;
            while($j < $roundMatchCount) {

                $round[] = $matchNumber;

                $matchNumber--;

                $j++;
            }

            array_unshift($rounds, $round);

            $i++;
        }

        $this->roundMappings = $rounds;
    }
}

echo '<pre>';
var_dump(new TournamentStructure(2));
var_dump(new TournamentStructure(3));
var_dump(new TournamentStructure(4));
var_dump(new TournamentStructure(13));
var_dump(new TournamentStructure(16));
var_dump(new TournamentStructure(27));
var_dump(new TournamentStructure(32));
var_dump(new TournamentStructure(63));
var_dump(new TournamentStructure(64));
echo '</pre>';