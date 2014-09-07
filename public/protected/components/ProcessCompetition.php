<?php
class ProcessCompetition
{
    public $competition;

    /**
     * Constructor
     * @param object $competition  Competition to Process
     */
    public function __construct($competition)
    {
        $this->competition = $competition;
    }

    /**
     * Process the Competition
     */
    public function process()
    {
        $this->competition->fetchSourceData();

        foreach ($this->competition->rounds as $round) {
            $this->processRound($round);
        }
    }

    /**
     * Process the specified Competition Round
     * @param object $round  Round
     */
    public function processRound($round)
    {
        foreach ($round->ties as $tie) {
            $this->processTie($tie);
        }
    }

    /**
     * Process the specified Competition Tie
     * @param object $tie  Tie
     */
    public function processTie($tie)
    {

    }
}