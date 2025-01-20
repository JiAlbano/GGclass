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
        currentPoints.style.marginTop = "22px"; // Adjust this value as needed
        nextPoints.style.marginTop = "22px";    // Adjust this value as needed

        // Determine current badge and next badge based on percentage
        if (percentage >= badgeThresholds.gold[0] && percentage <= badgeThresholds.gold[1]) {
            currentBadge.src = "{{ asset('/images/gold.png') }}";
            nextBadge.src = "{{ asset('/images/gold.png') }}";
            nextPoints.textContent = "N/A";  // No next points since already at Gold
        } else if (percentage >= badgeThresholds.silver[0] && percentage <= badgeThresholds.silver[1]) {
            currentBadge.src = "{{ asset('/images/silver.png') }}";
            nextBadge.src = "{{ asset('/images/gold.png') }}";  // Next badge will be gold
            nextPoints.textContent = Math.ceil(((badgeThresholds.gold[0] - percentage) / 100) * numberOfItems) + " pts";  // Next points to reach Gold
        } else if (percentage >= badgeThresholds.bronze[0] && percentage <= badgeThresholds.bronze[1]) {
            currentBadge.src = "{{ asset('/images/bronze.png') }}";
            nextBadge.src = "{{ asset('/images/silver.png') }}";  // Next badge will be silver
            nextPoints.textContent = Math.ceil(((badgeThresholds.silver[0] - percentage) / 100) * numberOfItems) + " pts";  // Next points to reach Silver
        } else {
            currentBadge.src = "{{ asset('/images/bronze.png') }}";
            nextBadge.src = "{{ asset('/images/bronze.png') }}";  // No next badge
            nextPoints.textContent = Math.ceil(((badgeThresholds.bronze[0] - percentage) / 100) * numberOfItems) + " pts";  // Next points to reach Bronze
        }
    }

    // Update the badge and next points when the page loads
    updateBadge(percentage);
});
