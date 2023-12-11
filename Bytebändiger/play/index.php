<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kahoot game</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>


    <div class="quiz-container wrapper">
    <div class="counter">Frage: <span id="questionCounter">0</span>/<span id="totalQuestions">0</span></div>

        <div class="timer">Timer: 1500s</div>

        <div class="question">antwort box</div>

        <div class="answer-row">
            <div class="answer-box" style="background-color: #FF5733;" onclick="checkAnswer(1)">
                <div class="answer"></div>
            </div>
            <div class="answer-box" style="background-color: #33FF57;" onclick="checkAnswer(2)">
                <div class="answer"></div>
            </div>
        </div>
        <div class="answer-row">
            <div class="answer-box" style="background-color: #5733FF;" onclick="checkAnswer(3)">
                <div class="answer"></div>
            </div>
            <div class="answer-box" style="background-color: #33FFFF;" onclick="checkAnswer(4)">
                <div class="answer"></div>
            </div>
        </div>
    </div>

    <script>
        let timerElement = document.querySelector(".timer");
        let timeLeft = 1500;
        let timerInterval;
        let selectedAnswer;
        let currentQuestionIndex = 0; // Index der aktuellen Frage
        let totalQuestions;

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
        //Hierk annst du den Timer für jede Frage starte
        startTimer();




        // Lese die CSV-Datei ein und fülle die Daten in die HTML-Elemente.
        fetch('../login/fragen.csv')
            .then(response => response.text())
            .then(data => {
                // Trenne die CSV-Zeilen und verarbeite jede Zeile separat.
                const rows = data.split('\n');
                const header = rows[0].split(';'); // Spaltenüberschriften

                // Die erste Zeile enthält die Frage.
                document.querySelector('.question').textContent = header[0];

                // Die folgenden Zeilen enthalten die Antworten.
                for (let i = 1; i < header.length; i++) {
                    const answerElements = document.querySelectorAll('.answer');
                    if (answerElements[i - 1]) {
                        answerElements[i - 1].textContent = header[i];
                    }
                }
            })
            .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));


        function checkAnswer(selectedAnswer) {
            console.log(selectedAnswer)
            // Annahme: Du hast eine Variable namens csvUrl, die den Pfad zur CSV-Datei enthält.
            var csvUrl = '../Login/fragen.csv';

            // Fetch-API verwenden, um die CSV-Datei zu laden
            fetch(csvUrl)
                .then(response => response.text())
                .then(csvData => {
                    // CSV-Daten in ein Array umwandeln
                    var csvArray = csvData.split(';');

                    // Den letzten Wert der CSV extrahieren und in eine Zahl konvertieren
                    var correctAnswer = parseInt(csvArray[csvArray.length - 1]);

                    // Jetzt vergleiche die ausgewählte Antwort mit der richtigen Antwort
                    if (selectedAnswer === correctAnswer) {
                        console.log("Richtig!");
                    } else {
                        console.log("Falsch!");
                    }
                })
                .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
        }
        function updateQuestionCounter() {
            const questionCounterElement = document.getElementById("questionCounter");
            const totalQuestionsElement = document.getElementById("totalQuestions");
            questionCounterElement.textContent = currentQuestionIndex + 1; // Index ist 0-basiert, wir wollen den Frage-Count 1-basiert anzeigen
            totalQuestionsElement.textContent = totalQuestions;
        }

    </script>

</body>

</html>