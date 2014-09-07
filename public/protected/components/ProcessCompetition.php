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
        if ($this->competition->status == 'in_progress') {
            //$this->competition->fetchSourceData();

            foreach ($this->competition->rounds as $round) {
                $this->processRound($round);
            }
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
        if ($tie->status == 'in_progress') {
            switch ($tie->type) {
                case 'bye':
                    $this->processBye($tie);
                    break;
                case 'match':
                    $this->processMatch($tie);
                    break;
            }
        }
    }

    /**
     * Process the specified Competition Bye
     * @param object $bye  Bye
     */
    public function processBye($bye)
    {
        $nextRoundTie = false;

        switch (true) {
            // If the Bye was to be the next round's home club
            case $bye->homeTies:
                $nextRoundTie = $bye->homeTies[0];
                $nextRoundTie->home_club_id = $bye->home_club_id;
                break;
            // If the Bye was to be the next round's away club
            case $bye->awayTies:
                $nextRoundTie = $bye->awayTies[0];
                $nextRoundTie->away_club_id = $bye->home_club_id;
                break;
        }

        if ($nextRoundTie) {
            // If the home and away clubs are set mark the game as in progress
            if ($nextRoundTie->home_club_id && $nextRoundTie->away_club_id) {
                $nextRoundTie->status = 'in_progress';
            }

            $nextRoundTie->save();
        }

        $bye->status = 'result';
        $bye->save();
    }

    /**
     * Process the specified Competition Match
     * @param object $match  Match
     */
    public function processMatch($match)
    {
        if ($match->status == 'in_progress') {
            $source = $this->fetchSourceClass($this->competition->source);
            if ($source) {
                $source->fetchLatestAndProcess($match->start_datetime, $match->finish_datetime);

                $homeClubData = $source->getClubData($match->homeClub->identifier);
                $awayClubData = $source->getClubData($match->awayClub->identifier);

                var_Dump($match->homeClub->identifier, $homeClubData, $match->awayClub->identifier, $awayClubData);
            }
        }
    }

    /**
     * Fetch the Source Class that will be used to fetch points
     * @param  string $source Source Class Name
     * @return object         Source Class
     */
    public function fetchSourceClass($source)
    {
        $sourceClassName = "Source" . ucfirst($source);
        return new $sourceClassName();
    }
}