document.addEventListener("DOMContentLoaded", function () {
  // Elements
  const scoreButtons = document.querySelectorAll(".score-btn");
  const scoreUpdateSection = document.getElementById("score-update");
  const cancelUpdateButton = document.getElementById("cancel-update");
  const closeUpdateButton = document.getElementById("close-update");
  const scoreForm = document.getElementById("score-form");
  const outcomeButtons = document.querySelectorAll(".outcome-btn");

  // Generate over options dynamically
  function generateOverOptions() {
    const select = document.getElementById("current-over");
    select.innerHTML = "";

    for (let over = 0; over <= 50; over++) {
      for (let ball = 0; ball < 6; ball++) {
        if (over === 50 && ball > 0) break;
        const option = document.createElement("option");
        option.value = `${over}.${ball}`;
        option.textContent = `${over}.${ball}`;
        select.appendChild(option);
      }
    }
  }

  // Show score update form
  scoreButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const matchId = this.getAttribute("data-match");
      const matchCard = this.closest(".match-card");

      if (matchCard) {
        const team1Name = matchCard.querySelector(
          ".team:nth-child(1) .team-name"
        ).textContent;
        const team2Name = matchCard.querySelector(
          ".team:nth-child(2) .team-name"
        ).textContent;
        const team1Logo = matchCard.querySelector(
          ".team:nth-child(1) .team-logo"
        ).src;
        const team2Logo = matchCard.querySelector(
          ".team:nth-child(2) .team-logo"
        ).src;

        document.getElementById("match-id").value = matchId;
        document.getElementById("team1-name").textContent = team1Name;
        document.getElementById("team2-name").textContent = team2Name;
        document.getElementById("team1-logo").src = team1Logo;
        document.getElementById("team2-logo").src = team2Logo;

        // Reset and generate fresh over options
        generateOverOptions();

        // Show the modal
        scoreUpdateSection.style.display = "block";
        document.body.style.overflow = "hidden"; // Prevent scrolling behind modal
      }
    });
  });

  // Close score update form
  function closeScoreForm() {
    scoreUpdateSection.style.display = "none";
    document.body.style.overflow = "auto"; // Re-enable scrolling
    resetScoreForm();
  }

  // Cancel/close buttons
  cancelUpdateButton.addEventListener("click", closeScoreForm);
  closeUpdateButton.addEventListener("click", closeScoreForm);

  // Close when clicking outside the form
  scoreUpdateSection.addEventListener("click", function (e) {
    if (e.target === scoreUpdateSection) {
      closeScoreForm();
    }
  });

  // Score/outcome selection
  outcomeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const value = this.getAttribute("data-value");
      document.getElementById("score-value").value = value;

      // Update active button
      outcomeButtons.forEach((btn) => btn.classList.remove("selected"));
      this.classList.add("selected");

      // Update runs display
      const runs = calculateRuns();
      document.getElementById("total-runs").textContent = runs;
    });
  });

  // Form submission
  scoreForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = {
      match_id: document.getElementById("match-id").value,
      team:
        document.querySelector('input[name="batting-team"]:checked').value ===
        "team1"
          ? document.getElementById("team1-name").textContent
          : document.getElementById("team2-name").textContent,
      over: document.getElementById("current-over").value,
      runs: calculateRuns(),
      wickets:
        document.getElementById("score-value").value === "wicket" ? 1 : 0,
      commentary: document.getElementById("commentary").value,
    };

    try {
      const response = await fetch("api/update_score.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      const data = await response.json();

      if (data.success) {
        showNotification("Score updated successfully!");
        closeScoreForm();
        updateMatchScoreUI(formData.match_id, formData.runs, formData.wickets);
      } else {
        showNotification("Error: " + data.message, "error");
      }
    } catch (error) {
      showNotification("Network error: " + error.message, "error");
    }
  });

  // Helper functions
  function calculateRuns() {
    const value = document.getElementById("score-value").value;

    if (value === "wicket") return 0;
    if (value === "wide" || value === "no-ball") return 1;
    if (value === "bye" || value === "leg-bye") return 1;

    return parseInt(value) || 0;
  }

  function resetScoreForm() {
    scoreForm.reset();
    document.getElementById("score-value").value = "0";
    document.getElementById("total-runs").textContent = "0";
    document.getElementById("commentary").value = "";
    outcomeButtons.forEach((btn) => btn.classList.remove("selected"));
    // Activate the '0' run option by default
    document
      .querySelector('.outcome-btn[data-value="0"]')
      .classList.add("selected");
  }

  function updateMatchScoreUI(matchId, runs, wickets) {
    // Implement your UI update logic here
    console.log(
      `Updating UI for match ${matchId} with ${runs} runs and ${wickets} wickets`
    );

    // Example: Update the match card score display
    const matchCard = document.querySelector(
      `.match-card[data-match-id="${matchId}"]`
    );
    if (matchCard) {
      const scoreElement = matchCard.querySelector(".team-score");
      if (scoreElement) {
        // This is a simple example - you'll need to implement proper score tracking
        const currentScore = scoreElement.textContent.match(/(\d+)/)[0] || 0;
        const newScore = parseInt(currentScore) + runs;
        scoreElement.textContent = scoreElement.textContent.replace(
          /\d+/,
          newScore
        );
      }
    }
  }

  function showNotification(message, type = "success") {
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
      notification.classList.add("fade-out");
      setTimeout(() => notification.remove(), 500);
    }, 3000);
  }

  // Initialize form
  generateOverOptions();
  resetScoreForm();
});
