<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kahoot game</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div id="">
    </div>

    <div id="quiz-container">
        <div id="timer" class="timer">Timer: 15s</div>
        <div class="questions-row">
            <div class="question-box" style="background-color: #FF5733;">
                <div class="question"></div>
            </div>
            <div class="question-box" style="background-color: #33FF57;">
                <div class="question"></div>
            </div>
        </div>
        <div class="questions-row">
            <div class="question-box" style="background-color: #5733FF;">
                <div class="question"></div>
            </div>
            <div class="question-box" style="background-color: #33FFFF;">
                <div class="question"></div>
            </div>
        </div>
    </div>

    <script>
        let timerElement = document.getElementById("timer");
        let timeLeft = 1500;
        let timerInterval;

        function startTimer() {
            timerInterval = setInterval(updateTimer, 1000);
        }

        function updateTimer() {
            timeLeft--;
            timerElement.textContent = `Timer: ${timeLeft}s`;

            if (timeLeft === 0) {
                clearInterval(timerInterval);
                alert("Zeit abgelaufen!");
                // Hier kannst du die Logik für die abgelaufene Zeit implementieren
            }
        }

        // Hier kannst du den Timer für jede Frage starten
        startTimer();
    </script>
</body>

</html>