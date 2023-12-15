Quiz-Programm Dokumentation
1. Einleitung
Das Quiz-Programm wurde entwickelt, um betriebsinterne Fortbildungen zu unterstützen. Es ermöglicht Benutzern, Fragen aus einer CSV-Datei zu beantworten und ihren Wissensstand zu überprüfen.
2. Spielablauf
2.1 Startseite
Die Startseite zeigt eine Bestenliste der Top 15 Spieler. Benutzer können zwischen den Optionen "Spielen" und "Login" wählen.
2.2 Fragen und Antworten
Das Programm liest Fragen und mögliche Antworten aus einer CSV-Datei.
Fragen und Antworten werden in zufälliger Reihenfolge präsentiert.
Benutzer wählen eine Antwort aus, und das Programm gibt Rückmeldung.
2.3 Timer
Ein Timer von 15 Sekunden läuft für jede Frage herunter. Wenn der Timer abgelaufen ist, geht das Spiel zur nächsten Frage über.
3. Admin-Bereich
3.1 Login
Der Login-Prozess im Admin-Bereich ist regex-proof und stellt sicher, dass nur autorisierte Benutzer Zugriff haben.
3.2 Admin-Dashboard
Das Admin-Dashboard ermöglicht:
Bearbeiten, Löschen und Hinzufügen von Fragen.
Zurücksetzen der Bestenliste.
4. Technologien
Das Quiz-Programm verwendet:
Frontend: HTML, CSS, JavaScript
Backend: PHP
Datenhaltung: CSV-Dateien


5. Cloud-Implementierung auf AWS
Das Quiz-Programm wird auf einem AWS Cloud-Server betrieben:
Infrastruktur: Terrraform
DNS-Verwaltung: Amazon Route 53
Serverstandort: Frankfurt
VPC: Amazon Virtual Private Cloud (VPC) mit einem Application Load Balancer (ALB)
Containerisierung: AWS Fargate für die Ausführung von PHP-Containern in einem privaten Subnetz


6. Sicherheit
Sicherheitsmaßnahmen, insbesondere beim Admin-Login, sind implementiert, um unbefugten Zugriff zu verhindern.
7. Quellcode
Siehe Github
8. Anpassbarkeit und Erweiterbarkeit
Das Quiz-Programm ist flexibel und kann leicht durch Hinzufügen neuer Fragen oder Anpassen des Designs erweitert werden.
9. Verzeichnisstruktur
Ordner
Login ->AdminSucessLogin.php, adminstyle.css, functions.php, login.php, style.css
csv -> bestenliste.csv, fragen.csv, logindata.csv
img -> Kahoot.jpg, Kahoot_logo.png, loop.jpg, mediaquerie.jpg, stars.jpg
play -> index.php, script.js, style.css
index.php
style.css

