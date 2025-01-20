document.addEventListener("DOMContentLoaded", function() {
    // Calculate percentage based on sumOfScores and numberOfItems
    var percentage = numberOfItems > 0 ? (sumOfScores / numberOfItems) * 100 : 0;

    // Define badge thresholds
    var badgeThresholds = {
        noBadge: [0, 25],    // 0% to 25%
        bronze: [26, 50],    // 26% to 50%
        silver: [51, 75],    // 51% to 75%
        gold: [76, 100]      // 76% and above
    };

    // Function to update the badge based on percentage and calculate next points
    function updateBadge(percentage) {
        var currentBadge = document.getElementById('currentBadge');
        var nextBadge = document.getElementById('nextBadge');
        var currentPoints = document.getElementById('currentPoints');
        var nextPoints = document.getElementById('nextPoints');

        // Adjust the marginTop to move the currentPoints and nextPoints down
        currentPoints.style.marginTop = "22px";
        nextPoints.style.marginTop = "22px";

        // If the percentage exceeds 100, adjust it to 100
        if (percentage > 100) {
            percentage = 100;
            currentPoints.textContent = sumOfScores + " pts";  // Show the exceeded points
        } else {
            currentPoints.textContent = sumOfScores + " pts";  // Show the current points
        }

        // Determine current badge and next badge based on percentage
        if (percentage >= badgeThresholds.gold[0] && percentage <= badgeThresholds.gold[1]) {
            currentBadge.innerHTML = '<img src="/gold.png" alt="Gold Badge" style="width: 40px; height: 40px;">';
            nextPoints.innerHTML = '<span style="color: gold;">Max-Rank</span>';  // Max rank and points
        } else if (percentage >= badgeThresholds.silver[0] && percentage <= badgeThresholds.silver[1]) {
            currentBadge.innerHTML = '<img src="/silver.png" alt="Silver Badge" style="width: 40px; height: 40px; margin-top:6px;">';
            nextBadge.innerHTML = '<img src="/gold.png" alt="Gold Badge" style="width: 40px; height: 40px;">';
            nextPoints.textContent = Math.ceil(((badgeThresholds.gold[0] - percentage) / 100) * numberOfItems) + " pts";
        } else if (percentage >= badgeThresholds.bronze[0] && percentage <= badgeThresholds.bronze[1]) {
            currentBadge.innerHTML = '<img src="/bronze.png" alt="Bronze Badge" style="width: 40px; height: 40px;">';
            nextBadge.innerHTML = '<img src="/silver.png" alt="Silver Badge" style="width: 40px; height: 40px;">';
            nextPoints.textContent = Math.ceil(((badgeThresholds.silver[0] - percentage) / 100) * numberOfItems) + " pts";
        } else {
            currentBadge.innerHTML = '<span style="color: red; position: relative; top: 2px;">No Badge</span>';
            nextBadge.innerHTML = '<img src="/bronze.png" alt="Bronze Badge" style="width: 40px; height: 40px;">';
            nextPoints.textContent = Math.ceil(((badgeThresholds.bronze[0] - percentage) / 100) * numberOfItems) + " pts";
        }
    }

    // Update the badge and next points when the page loads
    updateBadge(percentage);
});
