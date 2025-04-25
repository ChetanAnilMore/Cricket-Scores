<?php
require_once './includes/db_connect.php';

// You can add PHP code here to fetch initial match data if needed
// Example:
// $matches = getLiveMatches($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Live Cricket Scores | Cricket Score Management System</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="css/scores.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
  <header>
    <div class="logo-container">
      <img class="nav-image" src="assets/logo.jpeg" alt="Cricket Score Management System Logo" />
      <h1 class="logo-text">CricketScores</h1>
    </div>
    <nav class="nav-bar">
      <button class="mobile-menu-button" aria-expanded="false" aria-controls="nav-list">
        <i class="fas fa-bars"></i>
      </button>
      <ul class="nav-list" id="nav-list">
        <li><a href="index.html">Home</a></li>
        <li><a href="./html/matches.html">Matches</a></li>
        <li><a href="./html/scores.php" class="active">Scores</a></li>
        <li><a href="./html/about.html">About</a></li>
        <li>
          <a id="login-button" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="scores-main">
    <section class="scores-hero">
      <h1>Live Cricket Scores</h1>
      <p>Real-time updates for all ongoing matches</p>
    </section>

    <section class="live-matches">
      <h2>Currently Playing</h2>
      <div class="matches-container">
        <div class="match-card live" data-match-id="1">
          <div class="match-header">
            <h3>ICC World Cup 2023</h3>
            <span class="match-status live-dot"><i class="fas fa-circle"></i> LIVE</span>
          </div>
          <div class="teams">
            <div class="team">
              <img src="assets/india.png" alt="India" class="team-logo" />
              <span class="team-name">India</span>
              <span class="team-score">287/6 (48.3)</span>
            </div>
            <div class="team">
              <img src="assets/australia.png" alt="Australia" class="team-logo" />
              <span class="team-name">Australia</span>
              <span class="team-score">256 (50)</span>
            </div>
          </div>
          <div class="match-info">
            <p>
              <i class="fas fa-map-marker-alt"></i> Wankhede Stadium, Mumbai
            </p>
            <p class="match-status-text">India need 32 runs in 9 balls</p>
          </div>
          <button class="btn score-btn" data-match="1">Update Score</button>
        </div>

        <div class="match-card live" data-match-id="2">
          <div class="match-header">
            <h3>ICC World Cup 2023</h3>
            <span class="match-status live-dot"><i class="fas fa-circle"></i> LIVE</span>
          </div>
          <div class="teams">
            <div class="team">
              <img src="assets/england.jpeg" alt="England" class="team-logo" />
              <span class="team-name">England</span>
              <span class="team-score">198/7 (40)</span>
            </div>
            <div class="team">
              <img src="assets/pakistan.png" alt="Pakistan" class="team-logo" />
              <span class="team-name">Pakistan</span>
              <span class="team-score">245 (49.3)</span>
            </div>
          </div>
          <div class="match-info">
            <p><i class="fas fa-map-marker-alt"></i> Lord's, London</p>
            <p class="match-status-text">England need 48 runs in 60 balls</p>
          </div>
          <button class="btn score-btn" data-match="2">Update Score</button>
        </div>
      </div>
    </section>

    <section class="score-update-section" id="score-update" style="display: none">
      <div class="overlay"></div>
      <div class="update-container">
        <div class="update-header">
          <h2>Update Match Score</h2>
          <button class="close-btn" id="close-update">&times;</button>
        </div>

        <form id="score-form" class="score-form">
          <input type="hidden" id="match-id" name="match-id">

          <div class="form-group team-selection">
            <label class="form-label">Batting Team</label>
            <div class="team-options">
              <label class="team-option">
                <input type="radio" name="batting-team" value="team1" checked>
                <div class="team-card">
                  <img src="assets/india.png" id="team1-logo" class="team-logo-small">
                  <span class="team-name" id="team1-name">India</span>
                </div>
              </label>
              <label class="team-option">
                <input type="radio" name="batting-team" value="team2">
                <div class="team-card">
                  <img src="assets/australia.png" id="team2-logo" class="team-logo-small">
                  <span class="team-name" id="team2-name">Australia</span>
                </div>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Delivery Outcome</label>
            <div class="outcome-grid">
              <!-- Runs -->
              <button type="button" class="outcome-btn run-btn" data-value="0">0</button>
              <button type="button" class="outcome-btn run-btn" data-value="1">1</button>
              <button type="button" class="outcome-btn run-btn" data-value="2">2</button>
              <button type="button" class="outcome-btn run-btn" data-value="3">3</button>
              <button type="button" class="outcome-btn run-btn" data-value="4">4</button>
              <button type="button" class="outcome-btn run-btn" data-value="6">6</button>

              <!-- Wickets -->
              <button type="button" class="outcome-btn wicket-btn" data-value="wicket">
                <i class="fas fa-times"></i> Wicket
              </button>

              <!-- Extras -->
              <button type="button" class="outcome-btn extra-btn" data-value="wide">
                <i class="fas fa-arrows-alt-h"></i> Wide
              </button>
              <button type="button" class="outcome-btn extra-btn" data-value="no-ball">
                <i class="fas fa-ban"></i> No Ball
              </button>
              <button type="button" class="outcome-btn extra-btn" data-value="bye">
                <i class="fas fa-running"></i> Bye
              </button>
              <button type="button" class="outcome-btn extra-btn" data-value="leg-bye">
                <i class="fas fa-tshirt"></i> Leg Bye
              </button>
            </div>
            <input type="hidden" id="score-value" name="score-value" value="0">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="current-over" class="form-label">Current Over</label>
              <div class="over-input">
                <select id="current-over" name="current-over" class="form-select">
                  <!-- Options will be generated dynamically -->
                  <option value="0.0">0.0</option>
                  <option value="0.1">0.1</option>
                  <!-- More options... -->
                </select>
                <span class="over-max">/ 50</span>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Total Runs</label>
              <div class="total-runs-display" id="total-runs">0</div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="batsman" class="form-label">Batsman</label>
              <select id="batsman" name="batsman" class="form-select">
                <option value="">Select Batsman</option>
                <option value="Rohit Sharma">Rohit Sharma</option>
                <option value="Virat Kohli">Virat Kohli</option>
                <option value="M.S. Dhoni">Thala</option>
              </select>
            </div>

            <div class="form-group">
              <label for="bowler" class="form-label">Bowler</label>
              <select id="bowler" name="bowler" class="form-select">
                <option value="">Select Bowler</option>
                <option value="Chetan">Chetan More</option>
                <option value="Dev Charan">Dev Charan</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="commentary" class="form-label">Commentary Note (Optional)</label>
            <textarea id="commentary" name="commentary" class="form-textarea"
              placeholder="E.g. 'Beautiful cover drive'"></textarea>
          </div>

          <div class="form-actions">
            <button type="button" class="btn secondary" id="cancel-update">
              <i class="fas fa-times"></i> Cancel
            </button>
            <button type="submit" class="btn primary">
              <i class="fas fa-save"></i> Update Score
            </button>
          </div>
        </form>
      </div>
    </section>
    <section class="recent-matches">
      <h2>Recent Matches</h2>
      <div class="matches-container">
        <div class="match-card completed" data-match-id="3">
          <div class="match-header">
            <h3>ICC World Cup 2023</h3>
            <span class="match-status completed-text">COMPLETED</span>
          </div>
          <div class="teams">
            <div class="team winner">
              <img src="assets/south-africa.png" alt="South Africa" class="team-logo" />
              <span class="team-name">South Africa</span>
              <span class="team-score">315/7 (50)</span>
            </div>
            <div class="team">
              <img src="assets/newzealand.png" alt="New Zealand" class="team-logo" />
              <span class="team-name">New Zealand</span>
              <span class="team-score">289 (48.2)</span>
            </div>
          </div>
          <div class="match-info">
            <p><i class="fas fa-map-marker-alt"></i> Cape Town Stadium</p>
            <p class="match-result">South Africa won by 26 runs</p>
          </div>
        </div>

        <div class="match-card completed" data-match-id="4">
          <div class="match-header">
            <h3>ICC World Cup 2023</h3>
            <span class="match-status completed-text">COMPLETED</span>
          </div>
          <div class="teams">
            <div class="team winner">
              <img src="assets/india.png" alt="India" class="team-logo" />
              <span class="team-name">India</span>
              <span class="team-score">249/0 (48.2)</span>
            </div>
            <div class="team">
              <img src="assets/pakistan.png" alt="Pakistan" class="team-logo" />
              <span class="team-name">Pakistan</span>
              <span class="team-score">245/8 (50)</span>
            </div>
          </div>
          <div class="match-info">
            <p><i class="fas fa-map-marker-alt"></i> Queen's Park Oval</p>
            <p class="match-result">India won by 10 wickets</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h4>CricketScores</h4>
        <p>
          The most reliable source for live cricket scores, match schedules,
          and player statistics.
        </p>
      </div>
      <div class="footer-section">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="./html/matches.html">Matches</a></li>
          <li><a href="scores.php">Scores</a></li>
          <li><a href="./html/about.html">About Us</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Contact</h4>
        <p><i class="fas fa-envelope"></i> info@cricketscores.com</p>
        <p><i class="fas fa-phone"></i> +91 1234567890</p>
      </div>
      <div class="footer-section">
        <h4>Follow Us</h4>
        <ul class="socials">
          <li>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          </li>
          <li>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          </li>
          <li>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          </li>
          <li>
            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2023 Cricket Score Management System. All rights reserved.</p>
      <div class="legal-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
  <script src="javascript/scores.js"></script>
</body>

</html>