
<!--<div id="stopwatch">00:00:00</div>-->
<!---->

<!--<script>-->
<!--    // Initialize the stopwatch-->
<!--    let elapsedTime = 0;-->
<!--    let interval;-->
<!---->
<!--    // Start the stopwatch-->
<!--    function startStopwatch() {-->
<!--        interval = setInterval(function() {-->
<!--            // Increment the elapsed time-->
<!--            elapsedTime++;-->
<!---->
<!--            // Calculate the hours, minutes, and seconds-->
<!--            let hours = Math.floor(elapsedTime / 3600);-->
<!--            let minutes = Math.floor((elapsedTime % 3600) / 60);-->
<!--            let seconds = elapsedTime % 60;-->
<!---->
<!--            // Display the elapsed time in the format HH:MM:SS-->
<!--            document.getElementById('stopwatch').innerHTML =-->
<!--                hours.toString().padStart(2, '0') + ':' +-->
<!--                minutes.toString().padStart(2, '0') + ':' +-->
<!--                seconds.toString().padStart(2, '0');-->
<!--        }, 1000);-->
<!--    }-->
<!---->
<!--    // Stop the stopwatch-->
<!--    function stopStopwatch() {-->
<!--        clearInterval(interval);-->
<!--    }-->
<!--</script>-->
<!-- HTML -->
<!--<div id="stopwatch">00:00:00</div>-->
<!---->

<!--<script>-->
<!--    // Initialize the stopwatch-->
<!--    let elapsedTime = 0;-->
<!--    let interval;-->
<!---->
<!--    // Start the stopwatch-->
<!--    function startStopwatch() {-->
<!--        interval = setInterval(function() {-->
<!--            // Increment the elapsed time-->
<!--            elapsedTime++;-->
<!---->
<!--            // Calculate the hours, minutes, and seconds-->
<!--            let hours = Math.floor(elapsedTime / 3600);-->
<!--            let minutes = Math.floor((elapsedTime % 3600) / 60);-->
<!--            let seconds = elapsedTime % 60;-->
<!---->
<!--            // Display the elapsed time in the format HH:MM:SS-->
<!--            document.getElementById('stopwatch').innerHTML =-->
<!--                hours.toString().padStart(2, '0') + ':' +-->
<!--                minutes.toString().padStart(2, '0') + ':' +-->
<!--                seconds.toString().padStart(2, '0');-->
<!--        }, 1000);-->
<!--    }-->
<!---->
<!--    // Stop the stopwatch-->
<!--    function stopStopwatch() {-->
<!--        clearInterval(interval);-->
<!--    }-->
<!---->
<!--    // Start the stopwatch when the webpage is loaded-->
<!--    window.onload = function() {-->
<!--        startStopwatch();-->
<!--    }-->
<!--</script>-->

<!-- HTML -->
<!--<div id="stopwatch">00:00:00</div>-->
<!--<a href="" onclick="resetStopwatch()">sup</a>-->

<!--<script>-->
<!--    // Initialize the stopwatch-->
<!--    let elapsedTime = 0;-->
<!--    let interval;-->
<!---->
<!--    // Start the stopwatch-->
<!--    function startStopwatch() {-->
<!--        interval = setInterval(function() {-->
<!--            // Increment the elapsed time-->
<!--            elapsedTime++;-->
<!---->
<!--            // Calculate the hours, minutes, and seconds-->
<!--            let hours = Math.floor(elapsedTime / 3600);-->
<!--            let minutes = Math.floor((elapsedTime % 3600) / 60);-->
<!--            let seconds = elapsedTime % 60;-->
<!---->
<!--            // Display the elapsed time in the format HH:MM:SS-->
<!--            document.getElementById('stopwatch').innerHTML =-->
<!--                hours.toString().padStart(2, '0') + ':' +-->
<!--                minutes.toString().padStart(2, '0') + ':' +-->
<!--                seconds.toString().padStart(2, '0');-->
<!---->
<!--            // Save the elapsed time in local storage-->
<!--            localStorage.setItem('elapsedTime', elapsedTime);-->
<!--        }, 1000);-->
<!--    }-->
<!---->
<!--    // Stop the stopwatch-->
<!--    function stopStopwatch() {-->
<!--        clearInterval(interval);-->
<!--        clearInterval()-->
<!--    }-->
<!--    function resetStopwatch() {-->
<!--        // Stop the stopwatch-->
<!--        stopStopwatch();-->
<!---->
<!--        // Reset the elapsed time-->
<!--        elapsedTime = 0;-->
<!---->
<!--        // Update the stopwatch display-->
<!--        document.getElementById('stopwatch').innerHTML = '00:00:00';-->
<!--    }-->
<!---->
<!--    // Start the stopwatch when the webpage is loaded-->
<!--    window.onload = function() {-->
<!--        // Check if the elapsed time is saved in local storage-->
<!--        let savedTime = localStorage.getItem('elapsedTime');-->
<!--        if (savedTime) {-->
<!--            // Set the elapsed time to the saved value-->
<!--            elapsedTime = parseInt(savedTime);-->
<!---->
<!--            // Calculate the hours, minutes, and seconds-->
<!--            let hours = Math.floor(elapsedTime / 3600);-->
<!--            let minutes = Math.floor((elapsedTime % 3600) / 60);-->
<!--            let seconds = elapsedTime % 60;-->
<!---->
<!--            // Display the elapsed time in the format HH:MM:SS-->
<!--            document.getElementById('stopwatch').innerHTML =-->
<!--                hours.toString().padStart(2, '0') + ':' +-->
<!--                minutes.toString().padStart(2, '0') + ':' +-->
<!--                seconds.toString().padStart(2, '0');-->
<!--        }-->
<!---->
<!--        // Start the stopwatch-->
<!--        startStopwatch();-->
<!--    }-->
<!---->
<!--</script>-->
<!-- HTML -->
<div id="stopwatch">00:00:00</div>
<button id="reset-button">Reset</button>

<!-- JavaScript -->
<script>
    // Initialize the stopwatch
    let elapsedTime = 0;
    let interval;

    // Start the stopwatch
    function startStopwatch() {
        interval = setInterval(function() {
            // Increment the elapsed time
            elapsedTime++;

            // Calculate the hours, minutes, and seconds
            let hours = Math.floor(elapsedTime / 3600);
            let minutes = Math.floor((elapsedTime % 3600) / 60);
            let seconds = elapsedTime % 60;

            // Display the elapsed time in the format HH:MM:SS
            document.getElementById('stopwatch').innerHTML =
                hours.toString().padStart(2, '0') + ':' +
                minutes.toString().padStart(2, '0') + ':' +
                seconds.toString().padStart(2, '0');

            // Save the elapsed time in local storage
            localStorage.setItem('elapsedTime', elapsedTime);
        }, 1000);
    }

    // Stop the stopwatch
    function stopStopwatch() {
        clearInterval(interval);
    }

    // Reset the stopwatch
    function resetStopwatch() {
        // Stop the stopwatch
        stopStopwatch();

        // Reset the elapsed time
        elapsedTime = 0;

        // Display the elapsed time in the format HH:MM:SS
        document.getElementById('stopwatch').innerHTML = '00:00:00';

        // Remove the elapsed time from local storage
        localStorage.removeItem('elapsedTime');
    }

    // Start the stopwatch when the webpage is loaded
    window.onload = function() {
        // Check if the elapsed time is saved in local storage
        let savedTime = localStorage.getItem('elapsedTime');
        if (savedTime) {
            // Set the elapsed time to the saved value
            elapsedTime = parseInt(savedTime);

            // Calculate the hours, minutes, and seconds
            let hours = Math.floor(elapsedTime / 3600);
            let minutes = Math.floor((elapsedTime % 3600) / 60);
            let seconds = elapsedTime % 60;

            // Display the elapsed time in the format HH:MM:SS
            document.getElementById('stopwatch').innerHTML =
                hours.toString().padStart(2, '0') + ':' +
                minutes.toString().padStart(2, '0') + ':' +
                seconds.toString().padStart(2, '0');
        }

        // Start the stopwatch
        startStopwatch();

        // Add an event listener to the reset button
        document.getElementById('reset-button').addEventListener('click', resetStopwatch);
    }
</script>
