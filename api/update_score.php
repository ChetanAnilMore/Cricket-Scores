<?php
require_once __DIR__ . '/../includes/db_connect.php';

header('Content-Type: application/json');

try {
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate data
    if (!isset($data['match_id'], $data['team'], $data['over'], $data['runs'], $data['wickets'])) {
        throw new Exception('Invalid data received');
    }

    // Sanitize inputs
    $match_id = intval($data['match_id']);
    $team = $data['team']; // No need to escape manually as prepared statements will handle it
    $over = floatval($data['over']);
    $runs = intval($data['runs']);
    $wickets = intval($data['wickets']);

    // Get current score from database (example - you'll need to implement this properly)
    $current_score = 0;
    $result = $conn->query("SELECT Score FROM india_vs_australia ORDER BY id DESC LIMIT 1");
    if ($result && $result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $current_score = $row['Score'];
    }
    $new_score = $current_score + $runs;

    // Insert into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO india_vs_australia 
                           (Team, Overs, Runs_in_over, Score, Wickets_in_over) 
                           VALUES (:team, :over, :runs, :score, :wickets)");
    $stmt->bindParam(':team', $team, PDO::PARAM_STR);
    $stmt->bindParam(':over', $over, PDO::PARAM_STR);
    $stmt->bindParam(':runs', $runs, PDO::PARAM_INT);
    $stmt->bindParam(':score', $new_score, PDO::PARAM_INT);
    $stmt->bindParam(':wickets', $wickets, PDO::PARAM_INT);
    // Removed redundant bind_param as it is not applicable for PDO

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Score updated successfully!',
            'data' => [
                'team' => $team,
                'over' => $over,
                'runs' => $runs,
                'wickets' => $wickets,
                'score' => $new_score
            ]
        ];
    } else {
        $errorInfo = $stmt->errorInfo();
        throw new Exception('Database error: ' . $errorInfo[2]);
    }

} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);
$conn = null;
?>