<?

$person = dbQuery( "
  SELECT    personId, count(DISTINCT competitionId) numberOfCompetitions
  FROM      Results
  GROUP BY  personId
  ORDER BY  numberOfCompetitions DESC
  LIMIT     10
" );

$event = dbQuery( "
  SELECT    eventId, count(DISTINCT competitionId) numberOfCompetitions
  FROM      Results
  GROUP BY  eventId
  ORDER BY  numberOfCompetitions DESC
  LIMIT     10
" );

$country = dbQuery( "
  SELECT    competition.countryId, count(DISTINCT competitionId) numberOfCompetitions
  FROM      Results, Competitions competition
  WHERE     competition.id = competitionId
  GROUP BY  competition.countryId
  ORDER BY  numberOfCompetitions DESC
  LIMIT     10
" );

$lists[] = array(
  "Most Competitions",
  "",
  "[P] Person [N] Competitions [T] | [E] Event [N] Competitions [T] | [T] Country [N] Competitions",
  my_merge( my_merge( $person, $event ), $country ),
  "[Person] In how many competitions the person participated. [Event] In how many competitions the event was included. [Country] How many competitions took place in the country."
);

?>
