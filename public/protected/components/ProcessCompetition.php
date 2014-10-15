<?php
class ProcessCompetition
{
    public $competition;
    public $currentDateTime;
    public $currentProcessedRound;

    /**
     * Constructor
     * @param object $competition  Competition to Process
     */
    public function __construct($competition)
    {
        $this->competition = $competition;
        $this->currentDateTime = time();
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
        $this->currentProcessedRound = $round;

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
                    foreach ($tie->matches as $match) {
                        $match = $this->processMatch($match);
                    }
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

        return $bye;
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

                $tieBreakerName = $this->currentProcessedRound->tie_breaker;

                if ($homeClubData && $awayClubData) {
                    // Set Home Club's Points/Tie Breaker
                    $match->home_club_points = intval($homeClubData->points);

                    if (isset($homeClubData->$tieBreakerName)) {
                        $match->home_club_tie_breaker = intval($homeClubData->$tieBreakerName);
                    }

                    // Set Away Club's Points/Tie Breaker
                    $match->away_club_points = intval($awayClubData->points);

                    if (isset($awayClubData->$tieBreakerName)) {
                        $match->away_club_tie_breaker = intval($awayClubData->$tieBreakerName);
                    }

                    // Is the match now a "result" rathe than "in progress"
                    if ($this->isResult($match, $this->currentDateTime)) {
                        $match->status = 'result';
                    }

                    $match->save();
                }
            }
        }

        return $match;
    }

    /**
     * Has the match been completed and should be marked as a result?
     * @param  Tie  $tie            The Tie in question
     * @param  int  $currentDate    Unix Timestamp of the data to use as "now"
     * @return boolean              The answer
     */
    public function isResult($tie, $currentDate)
    {
        $finishDateTimestamp = strtotime($tie->finish_datetime);

        return $finishDateTimestamp < $currentDate
            && $tie->home_club_points
            && $tie->away_club_points;
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