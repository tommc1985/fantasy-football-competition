<?php
class TournamentBuilder
{
    public static function buildTieMatches($tie)
    {
        // If no matches have already been created...
        if (count($tie->matches) == 0) {
            $numberOfLegs    = $tie->round->two_legged ? 2 : 1;

            // Match 1 - Begin
            $match1 = new Match();
            $match1->attributes=array(
                'tie_id'          => $tie->id,
                'home_club_id'    => $tie->home_club_id,
                'away_club_id'    => $tie->away_club_id,
                'start_datetime'  => $tie->round->dates['start_datetime']['leg_1'],
                'finish_datetime' => $tie->round->dates['finish_datetime']['leg_1'],
                'leg_number'      => 1,
                'status'          => 'provisional',
            );
            $match1->save();
            // Match 1 - End

            if ($numberOfLegs == 2) {
                // Match 2 - Begin
                $match2 = new Match();
                $match2->attributes=array(
                    'tie_id'          => $tie->id,
                    'home_club_id'    => $tie->away_club_id,
                    'away_club_id'    => $tie->home_club_id,
                    'start_datetime'  => $tie->round->dates['start_datetime']['leg_2'],
                    'finish_datetime' => $tie->round->dates['finish_datetime']['leg_2'],
                    'leg_number'      => 2,
                    'status'          => 'provisional',
                );
                $match2->save();
                // Match 2 - End
            }
        }
    }
    public static function buildTieReplay($tie)
    {
        $numberOfReplays = intval($tie->round->number_of_replays);
        $numberOfExistingReplays = count($tie->replays);

        // If no matches have already been created...
        if (count($tie->matches) == 0 && $numberOfExistingReplays < $numberOfReplays) {
            $numberOfLegs    = $tie->round->two_legged ? 2 : 1;

            // ReplayMatch 1 - Begin
            $replay = new Match();
            $replay->attributes=array(
                'tie_id'          => $tie->id,
                'home_club_id'    => $tie->home_club_id,
                'away_club_id'    => $tie->away_club_id,
                'start_datetime'  => $tie->round->dates['start_datetime']['replay_1'],
                'finish_datetime' => $tie->round->dates['finish_datetime']['replay_1'],
                'replay'          => 1,
                'status'          => 'provisional',
            );
            $replay->save();
            // Replay - End
        }
    }
}