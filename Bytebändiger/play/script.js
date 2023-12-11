let timerElement = document.querySelector(".timer");
let timeLeft = 1500;
let timerInterval;
let selectedAnswer;
let currentQuestionIndex = 0; // Index der aktuellen Frage
let correctAnswersCount = 0;
let totalQuestions = 0;

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
startTimer();
updateQuestionCounter();




fetch('../csv/fragen.csv')
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
    // Annahme: Die Frage ist im HTML in einem Element mit der Klasse 'question'.
    const currentQuestion = document.querySelector('.question').textContent;

    // Annahme: Die Antwort-Optionen sind im HTML in Elementen mit der Klasse 'answer-box'.
    const answerElements = document.querySelectorAll('.answer-box');

    // Fetch-API verwenden, um die CSV-Datei zu laden
    fetch('../csv/fragen.csv')
        .then(response => response.text())
        .then(csvData => {
            // Trenne die CSV-Zeilen und verarbeite jede Zeile separat.
            const rows = csvData.split('\n');

            // Finde die Zeile mit der aktuellen Frage.
            const currentQuestionRow = rows.find(row => row.startsWith(currentQuestion));

            // Extrahiere die korrekte Antwort aus der CSV.
            const correctAnswer = parseInt(currentQuestionRow.split(';').pop());

            // Jetzt vergleiche die ausgewählte Antwort mit der richtigen Antwort.
            if (selectedAnswer === correctAnswer) {
                console.log("Richtig!");
                correctAnswersCount++;
            } else {
                console.log("Falsch!");
            }
        })
        .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
}

function loadNextQuestion() {
    // Increment current question index
    currentQuestionIndex++;

    // Fetch-API verwenden, um die CSV-Datei zu laden
    fetch('../csv/fragen.csv')
        .then(response => response.text())
        .then(csvData => {
            // Trenne die CSV-Zeilen und verarbeite jede Zeile separat.
            const rows = csvData.split('\n');
            const currentQuestionRow = rows[currentQuestionIndex].split(';');

            // Überprüfe, ob es eine nächste Frage gibt
            if (currentQuestionRow.length > 1) {

                // Setze die Frage im HTML
                document.querySelector('.question').textContent = currentQuestionRow[0];

                // Setze die Antworten im HTML
                const answerElements = document.querySelectorAll('.answer');
                for (let i = 1; i < currentQuestionRow.length; i++) {
                    if (answerElements[i - 1]) {
                        answerElements[i - 1].textContent = currentQuestionRow[i];
                    }
                }
                totalQuestions = rows.length;

                // Aktualisiere den Fragezähler
                updateQuestionCounter();
                if (currentQuestionIndex === totalQuestions - 1) {
                    // Alle Fragen wurden beantwortet
                    const correctPercentage = (correctAnswersCount / totalQuestions) * 100;
                    if (correctPercentage > 80) {
                        const playerName = prompt("Herzlichen Glückwunsch! Du hast mehr als 80% richtig beantwortet. Bitte gib deinen Namen ein:");
                        // Formatieren des Eintrags für die CSV-Datei
                        const csvEntry = `${playerData.length + 1};${playerName};${correctPercentage.toFixed(2)}%`;

                        // Füge den Eintrag zur CSV-Datei hinzu
                        fetch('../csv/bestenliste.csv', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'text/plain',
                                },
                                body: csvEntry,
                            })
                            .then(response => response.text())
                            .then(data => {
                                console.log('Eintrag wurde erfolgreich hinzugefügt:', data);
                                playerData.push({
                                    name: playerName,
                                    percentage: correctPercentage
                                });
                                alert(`Danke, ${playerName}! Spiel beendet. Du hast ${correctPercentage}% der Fragen richtig beantwortet.`);
                            })
                            .catch(error => console.error('Fehler beim Hinzufügen des Eintrags:', error));


                    } else {
                        alert("Spiel beendet! Leider hast du weniger als 80% richtig beantwortet.");
                    }
                }


            } else {
                // Keine weiteren Fragen vorhanden, hier kannst du die Endbildschirm-Logik implementieren
                alert("Spiel beendet!");
            }
        })




        .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
}


function updateQuestionCounter() {
    // Annahme: Der Pfad zur CSV-Datei.
    const csvUrl = '../csv/fragen.csv';

    // Fetch-API verwenden, um die CSV-Datei zu laden
    fetch(csvUrl)
        .then(response => response.text())
        .then(csvData => {
            // Trenne die CSV-Zeilen und zähle die Anzahl der Fragen.
            const questionCount = csvData.split('\n').length;

            // Annahme: Der Counter-Text wird in einem Element mit der Klasse 'question-counter' angezeigt.
            const counterElement = document.querySelector('.questionCounter');

            // Aktualisiere den Counter-Text.
            counterElement.textContent = `${currentQuestionIndex + 1}/${totalQuestions} Fragen`;
        })
        .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
}