$(document).ready(function() {
    // Get the sum of scores and number of items from the hidden input fields passed from Blade
    const sumOfScores = parseInt(document.getElementById("sum-of-scores").value); // Get the sum of scores
    const numberOfItems = parseInt(document.getElementById("number-of-items").value); // Get the total number of items

    // Calculate PercentScore as a percentage
    const percentScore = (sumOfScores / numberOfItems) * 100;

    // Define badge thresholds based on percentage
    const thresholds = {
        NoBadge: [0, 25],         // No badge: 0% to 25%
        Bronze: [26, 50],         // Bronze: 26% to 50%
        Silver: [51, 75],         // Silver: 51% to 75%
        Gold: [76, 100]           // Gold: 76% and above
    };

    // Define custom names for the badges
    const badgeNames = {
        NoBadge: 'No Badge',
        Bronze: '1st Pillar Bronze Medallion',
        Silver: '2nd Pillar Silver Medallion',
        Gold: '3rd Pillar Gold Medallion',
        MaxRank: 'Max Rank Achieved!'
    };

    // Initialize variables for current badge, next badge, and progress details
    let currentBadge = "NoBadge"; // Default badge
    let nextBadge = "Bronze";     // Default next badge
    let pointsToNext = 0;         // Points needed to reach the next badge
    let progressPercent = 0;      // Progress percentage for the progress bar

    // Calculate progress and badge details
    for (let i = 0; i < Object.keys(thresholds).length; i++) {
        const badge = Object.keys(thresholds)[i];
        const [minPercent, maxPercent] = thresholds[badge];

        // Check if the user's percentScore falls within the range for this badge
        if (percentScore >= minPercent && percentScore <= maxPercent) {
            currentBadge = badge; // Set the current badge

            // Handle case when user has reached the highest badge (Gold)
            if (badge === "Gold") {
                nextBadge = "Max Rank Achieved!"; // No next badge
                pointsToNext = 0; // No points needed to go higher
                progressPercent = 100; // Full progress for Gold badge
            } else {
                nextBadge = Object.keys(thresholds)[i + 1]; // Set the next badge
                pointsToNext = Math.max(0, Math.round((thresholds[nextBadge][0] * numberOfItems) / 100) - sumOfScores); // Points to next badge

                // Calculate progress percentage within the badge's range
                progressPercent = ((percentScore - minPercent) / (maxPercent - minPercent)) * 100; // Progress calculation
            }
            break;
        }
    }

    // If points are above the highest threshold (Gold), set the badge to Gold and max progress
    if (percentScore > thresholds.Gold[1]) {
        currentBadge = "Gold"; // Keep at Gold
        nextBadge = "Max Rank Achieved!"; // No next badge
        pointsToNext = 0; // No points needed to go higher
        progressPercent = 100; // Full progress for Gold badge
    }

    // If points are below the minimum for any badge, set the badge as "No badge available"
    if (percentScore < thresholds.NoBadge[1]) {
        nextBadge = "Bronze"; // The first badge is Bronze
        pointsToNext = Math.max(0, Math.round((thresholds.Bronze[0] * numberOfItems) / 100) - sumOfScores); // Points to reach Bronze badge
        progressPercent = (percentScore / thresholds.NoBadge[1]) * 100; // Progress towards reaching Bronze badge
    }

    // Update the DOM with calculated values
    document.getElementById("next-badge").innerText = badgeNames[nextBadge] || nextBadge; // Display the next badge
    document.getElementById("points-to-next").innerText = nextBadge === "Max Rank Achieved!" ? nextBadge : pointsToNext; // Show points to next badge or max rank
    const progressBar = document.getElementById("progress");
    progressBar.style.width = `${progressPercent}%`; // Update the progress bar width

    // Change progress bar color based on badge
    switch (currentBadge) {
        case "NoBadge":
            progressBar.style.background = "linear-gradient(135deg, #ffffff, #f0f0f0)"; // Dirty white gradient for NoBadge
            break;
        case "Bronze":
            progressBar.style.background = "linear-gradient(135deg, #5c4033, #a0522d, #cd7f32)"; // Rich bronze with depth
            break;
        case "Silver":
            progressBar.style.background = "linear-gradient(135deg, #6c6c6c, #9e9e9e, #dcdcdc)"; // Elegant silver gradient
            break;
        case "Gold":
            progressBar.style.background = "linear-gradient(135deg, #8b7500, #daa520, #ffd700)"; // Vibrant golden gradient
            break;
        default:
            progressBar.style.background = "linear-gradient(135deg, #ffffff, #f0f0f0)"; // Fallback to dirty white gradient
            break;
    }

    // Update the current badge to an image or text with custom styles
    const badgeImage = document.getElementById("current-badge");
    switch (currentBadge) {
        case "Bronze":
            badgeImage.innerHTML = '<img src="/bronze.png" alt="1st Pillar Bronze Medallion" class="rank-pic">';
            break;
        case "Silver":
            badgeImage.innerHTML = '<img src="/silver.png" alt="2nd Pillar Silver Medallion" class="rank-pic">';
            break;
        case "Gold":
            badgeImage.innerHTML = '<img src="/gold.png" alt="3rd Pillar Gold Medallion" class="rank-pic">';
            break;
        case "NoBadge":
            badgeImage.innerHTML = badgeNames.NoBadge; // Show the text "No Badge"
            badgeImage.style.fontSize = '40px'; // Apply the 30px font size
            badgeImage.style.color = 'red'; // Apply the red color for NoBadge
            break;
        default:
            badgeImage.innerHTML = ''; // Empty if no badge
            break;
    }



//Modal Available Badges
	// Get the modal and button elements
	const modal = new bootstrap.Modal(document.getElementById('badges-modal'));
	const badgesButton = document.getElementById('available-badges-btn');

	// Show the modal when the button is clicked
	badgesButton.addEventListener('click', function() {
	    modal.show();
	});

})