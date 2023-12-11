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
        <div class="questionCounter">1/X Fragen</div>

        <div class="timer">Timer: 1500s</div>

        <div class="question">antwort box</div>

        <div class="answer-row">
            <div class="answer-box" style="background-color: #FF5733;" onclick="checkAnswer(1); loadNextQuestion()">
                <div class="answer"></div>
            </div>
            <div class="answer-box" style="background-color: #33FF57;" onclick="checkAnswer(2);loadNextQuestion()">
                <div class="answer"></div>
            </div>
        </div>
        <div class="answer-row">
            <div class="answer-box" style="background-color: #5733FF;" onclick="checkAnswer(3);loadNextQuestion()">
                <div class="answer"></div>
            </div>
            <div class="answer-box" style="background-color: #33FFFF;" onclick="checkAnswer(4);loadNextQuestion()">
                <div class="answer"></div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>


</body>

</html>