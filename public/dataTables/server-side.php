
<?php
// server-side.php

// Your database connection code goes here...

// Handle DataTables server-side processing
// ...

// Add operation
if ($_POST['action'] == 'add') {
    // Your add operation logic goes here...
    // Make sure to update the total count
    $totalCount++; // Update the total count after adding a record
    echo json_encode(['success' => true, 'totalCount' => $totalCount]);
    exit;
}

// Delete operation
if ($_POST['action'] == 'delete') {
    // Your delete operation logic goes here...
    // Make sure to update the total count
    $totalCount--; // Update the total count after deleting a record
    echo json_encode(['success' => true, 'totalCount' => $totalCount]);
    exit;
}

// Handle other DataTables requests and queries...
// ...

