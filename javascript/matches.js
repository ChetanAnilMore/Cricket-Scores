document.addEventListener("DOMContentLoaded", function () {
  // Handle match card clicks
  const matchCards = document.querySelectorAll(".match-card");

  matchCards.forEach((card) => {
    card.addEventListener("click", function () {
      // Only flip if the match is completed or live
      const status = this.getAttribute("data-status");
      if (status === "completed" || status === "live") {
        this.classList.toggle("flipped");
      }
    });
  });

  // Add match data (could be fetched from API in a real application)
  const matchesData = {
    1: {
      status: "upcoming",
      team1: "India",
      team2: "Australia",
      date: "2023-10-15",
      time: "14:00 IST",
      venue: "Wankhede Stadium, Mumbai",
    },
    2: {
      status: "upcoming",
      team1: "England",
      team2: "Pakistan",
      date: "2023-10-16",
      time: "18:00 BST",
      venue: "Lord's, London",
    },
    3: {
      status: "live",
      team1: "South Africa",
      team2: "New Zealand",
      date: "2023-10-14",
      time: "16:00 SAST",
      venue: "Cape Town Stadium",
      score1: "287/6 (48.3 overs)",
      score2: "256/9 (50 overs)",
      statusText: "South Africa need 32 runs in 9 balls",
    },
    4: {
      status: "completed",
      team1: "West Indies",
      team2: "Sri Lanka",
      date: "2023-10-13",
      result: "West Indies won by 5 wickets",
      score1: "245/8 (50 overs)",
      score2: "249/5 (48.2 overs)",
      topScorer1: "Nissanka 78 (102)",
      topScorer2: "Hope 92* (115)",
      playerOfMatch: "Shai Hope",
    },
    5: {
      status: "completed",
      team1: "Bangladesh",
      team2: "Afghanistan",
      date: "2023-10-12",
      result: "Bangladesh won by 7 runs",
      score1: "265/9 (50 overs)",
      score2: "258 (49.3 overs)",
      topScorer1: "Shakib 68 (75)",
      topScorer2: "Rahman 54 (62)",
      playerOfMatch: "Shakib Al Hasan",
    },
  };

  // In a real app, you would fetch this data from an API
  console.log("Match data loaded:", matchesData);
});
