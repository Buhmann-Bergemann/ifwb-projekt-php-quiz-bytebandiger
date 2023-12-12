let timerElement = document.querySelector(".timer");
let timeLeft = 15;
let timerInterval;
let selectedAnswer;
let currentQuestionIndex = 0; // Index der aktuellen Frage
let correctAnswersCount = 0;
let totalQuestions = 1;
let playerData = [];
let quizData;



function startTimer() {
    timerInterval = setInterval(updateTimer, 1000);
}

function updateTimer() {
    timeLeft--;
    timerElement.textContent = `Timer: ${timeLeft}s`;

    if (timeLeft === 0) {
        clearInterval(timerInterval);
        loadNextQuestion();

        // Hier kannst du die Logik für die abgelaufene Zeit implementieren
    }
}
function resetTimer() {
    clearInterval(timerInterval); // Stoppe den aktuellen Timer
    timeLeft = 15; // Setze die Zeit zurück
    startTimer(); // Starte den Timer erneut
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
            loadNextQuestion();
            console.log("currentQuestionIndex erhöht, ist nun " + currentQuestionIndex);

        })
        .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
}

function loadNextQuestion() {
    currentQuestionIndex++;
    console.log("----------------");
    console.log(currentQuestionIndex + " = Currentquestionindex");
    console.log(totalQuestions + "= Totalquestions");
    console.log(correctAnswersCount + "=Korrektasnwer");
    // Überprüfe ob es noch eine weitere Frage gibt
    if (currentQuestionIndex < totalQuestions) {
        // Spiel läuft weiter
        // Fetch-API verwenden, um die CSV-Datei zu laden
        fetch('../csv/fragen.csv')
            .then(response => response.text())
            .then(csvData => {
                // Trenne die CSV-Zeilen und verarbeite jede Zeile separat.
                const rows = csvData.split('\n');
                const currentQuestionRow = rows[currentQuestionIndex].split(';');

                // Setze die Frage im HTML
                document.querySelector('.question').textContent = currentQuestionRow[0];

                // Setze die Antworten im HTML
                const answerElements = document.querySelectorAll('.answer');
                for (let i = 1; i < currentQuestionRow.length; i++) {
                    if (answerElements[i - 1]) {
                        answerElements[i - 1].textContent = currentQuestionRow[i];
                    }
                }

                // Aktualisiere den Fragezähler
                resetTimer();
                updateQuestionCounter();

            })
            .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
    } else {
        const correctPercentage = (correctAnswersCount / totalQuestions) * 100;

        if (correctPercentage >= 80) {
         
        endGame();   
        }
        else{
            alert('Sie haben leider eine zu gerine Prozentzahl erreicht. Das Spiel wird nun beendet')
            location.replace('../index.php');
        }
        
    }
}


function updateQuestionCounter() {
    // Annahme: Der Pfad zur CSV-Datei.
    const csvUrl = '../csv/fragen.csv';

    // Fetch-API verwenden, um die CSV-Datei zu laden
    fetch(csvUrl)
        .then(response => response.text())
        .then(csvData => {
            // Trenne die CSV-Zeilen und zähle die Anzahl der Fragen.
            totalQuestions = csvData.split('\n').length;

            // Annahme: Der Counter-Text wird in einem Element mit der Klasse 'question-counter' angezeigt.
            const counterElement = document.querySelector('.questionCounter');

            // Aktualisiere den Counter-Text.
            counterElement.textContent = `${currentQuestionIndex + 1}/${totalQuestions} Fragen`;
        })
        .catch(error => console.error('Fehler beim Laden der CSV-Datei:', error));
}

function appendToBestenliste(playerData) {
    // File System API-Code hier...

    // Hier ein einfaches Beispiel (Achtung: Funktioniert nicht im Browser)
    const fs = require('fs');

    // Dateipfad zur Bestenliste
    const filePath = '../csv/bestenliste.csv';

    // Spielerdaten in das CSV-Format umwandeln
    const csvData = `${playerData[0]};${playerData[1]}\n`;

    // Datei öffnen oder erstellen und Spielerdaten hinzufügen
    fs.appendFileSync(filePath, csvData);

    console.log('Daten erfolgreich in die Bestenliste eingetragen.');
}




function endGame() {
    playerData[0] = prompt('Gratulation Sie haben das Spiel bestanden und werden in die Bestenliste eingetragen. Bitte geben Sie ihren Namne an!')
    playerData[1]= (correctAnswersCount / totalQuestions) * 100;
    appendToBestenliste(playerData);

    
    clearInterval(timerInterval);
    // Verstecke Frage, Antwortmöglichkeiten und Timer
    document.querySelector('.question').style.display = 'none';
    document.querySelectorAll('.answer-box').forEach(answerBox => answerBox.style.display = 'none');
    document.querySelector('.timer').style.display = 'none';

    // Berechne die Endwertung

    // Zeige Benutzerinformationen an
    const resultContainer = document.createElement('div');
    resultContainer.classList.add('result-container');
    resultContainer.innerHTML = `<p>${playerData} Herzlichen glückwunsch, du hast ${playerData[1].toFixed(2)}% der Fragen richtig beantwortet. Wenn Sie zu den besten 15 Gehören werden Sie nun in die Bestenlist eingetragen!</p>`;
    document.querySelector('.quiz-container').appendChild(resultContainer);
}
