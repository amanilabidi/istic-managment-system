<?php
// get_calendar_events.php

// Your database connection code here

// Fetch events from the database (replace with your query)
$events = [
    [
        'title' => 'Event 1',
        'start' => '2023-11-01'
    ],
    [
        'title' => 'Event 2',
        'start' => '2023-11-05',
        'end' => '2023-11-07'
    ]
    // Add more events as needed
];

// Return events as JSON
echo json_encode($events);
?>
