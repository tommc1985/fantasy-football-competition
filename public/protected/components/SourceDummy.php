<?php
class SourceDummy {
    public $rawData;

    public function __construct()
    {
        $this->rawData = array(
            '2014-08-19' => array(
                (object) array(
                    'name'    => 'Hardy FC',
                    'manager' => 'Ben Watson',
                    'points'  => 5,
                    'goals'   => 3,
                ),
                (object) array(
                    'name'    => 'Finners Winners',
                    'manager' => 'Greg Beckwith',
                    'points'  => 2,
                    'goals'   => 2,
                ),
                (object) array(
                    'name'    => '2 Goals 1 Cup',
                    'manager' => 'Lawrence Poster',
                    'points'  => 7,
                    'goals'   => 2,
                ),
                (object) array(
                    'name'    => 'Midtable Obscurity',
                    'manager' => 'Thomas McGregor',
                    'points'  => 1,
                    'goals'   => 2,
                ),
            ),
            '2014-08-23' => array(
                (object) array(
                    'name'    => 'Hardy FC',
                    'manager' => 'Ben Watson',
                    'points'  => 10,
                    'goals'   => 4,
                ),
                (object) array(
                    'name'    => 'Finners Winners',
                    'manager' => 'Greg Beckwith',
                    'points'  => 11,
                    'goals'   => 7,
                ),
                (object) array(
                    'name'    => '2 Goals 1 Cup',
                    'manager' => 'Lawrence Poster',
                    'points'  => 3,
                    'goals'   => 1,
                ),
                (object) array(
                    'name'    => 'Midtable Obscurity',
                    'manager' => 'Thomas McGregor',
                    'points'  => 4,
                    'goals'   => 0,
                ),
            ),
            '2014-09-04' => array(
                (object) array(
                    'name'    => 'Hardy FC',
                    'manager' => 'Ben Watson',
                    'points'  => 3,
                    'goals'   => 0,
                ),
                (object) array(
                    'name'    => 'Finners Winners',
                    'manager' => 'Greg Beckwith',
                    'points'  => 3,
                    'goals'   => 3,
                ),
                (object) array(
                    'name'    => '2 Goals 1 Cup',
                    'manager' => 'Lawrence Poster',
                    'points'  => 3,
                    'goals'   => 2,
                ),
                (object) array(
                    'name'    => 'Midtable Obscurity',
                    'manager' => 'Thomas McGregor',
                    'points'  => 3,
                    'goals'   => 1,
                ),
            ),
        );
    }

    public function fetchLatestAndProcess($startDateTime, $finishDateTime)
    {
        krsort($this->rawData);

        $startDateTimestamp  = strtotime($startDateTime);
        $finishDateTimestamp = strtotime($finishDateTime);

        foreach ($this->rawData as $date => $rawData) {
            $unixTimestamp = strtotime($date);

            if ($startDateTimestamp <= $unixTimestamp && $finishDateTimestamp > $unixTimestamp) {
                $this->processRawData($rawData);
                return;
            }
        }
    }

    public function processRawData($rawData)
    {
        $this->data = array();

        foreach ($rawData as $club) {
            $this->data[$club->manager] = $club;
        }
    }

    public function getClubData($clubIdentifier)
    {
        if (isset($this->data[$clubIdentifier])) {
            return $this->data[$clubIdentifier];
        }

        return false;
    }
}