// Effet Glitch sur les titres
function initGlitchEffect() {
    const glitchElements = document.querySelectorAll('.glitch');
    glitchElements.forEach(el => {
        setInterval(() => {
            const text = el.textContent;
            el.style.transform = `translate(${Math.random() * 4 - 2}px, ${Math.random() * 4 - 2}px)`;
            el.style.color = Math.random() > 0.5 ? '#00FF00' : '#00BBFF';
            setTimeout(() => {
                el.style.transform = 'translate(0, 0)';
                el.style.color = '#00FF00';
            }, 100);
        }, 2000 + Math.random() * 3000);
    });
}

// Animation de la barre de chargement
function initLoadingBar() {
    const loadingBars = document.querySelectorAll('.loading-bar');

    loadingBars.forEach(bar => {
        // Mise à jour de la logique pour animer la barre
        let width = 0;
        const loadingInterval = setInterval(() => {
            if (width >= 100) {
                clearInterval(loadingInterval);
            } else {
                width += Math.floor(Math.random() * 10) + 1;
                if (width > 100) width = 100;
                bar.style.width = width + '%';
            }
        }, 200);
    });

    // Message dynamique pour les éléments avec classe .dynamic-loading
    const dynamicLoaders = document.querySelectorAll('.dynamic-loading');
    const messages = ['LOADING...', 'INITIALIZING...', 'PROCESSING...', 'BOOTING...'];

    dynamicLoaders.forEach(loader => {
        let index = 0;
        const text = document.createElement('span');
        text.className = 'loading-text';
        loader.appendChild(text);

        setInterval(() => {
            text.textContent = messages[index];
            index = (index + 1) % messages.length;
            text.style.left = '-100%';
            text.style.transition = 'none';
            setTimeout(() => {
                text.style.left = '0';
                text.style.transition = 'left 1s linear';
            }, 50);
        }, 2000);
    });
}

// Code volant personnalisé - CORRIGÉ
function initFlyingCode() {
    // Vérifier si le conteneur existe
    const container = document.getElementById('flying-code');
    if (!container) {
        console.error('Le conteneur #flying-code est introuvable');
        return;
    }

    const codeSnippets = [
        // Snippets simples personnalisés
        'KuKaRaCHa7_gg',
        'ULTRAKILL - HEADSHOT',
        'DOOM - RIP AND TEAR',
        'APEX LEGENDS - CHAMPION',
        'Java: public static void main',
        'Python: print("Hello KuKaRaCHa7_gg")',
        'C: int main() { return 0; }',
        'Bash: ls -la',
        'SQL: SELECT * FROM users',
        'HTML: <h1>Daniil Minevich</h1>',
        'CSS: .retro { color: #00FF00; }',
        '06 59 35 74 52',
        'daniil.minevich2005@gmail.com',
        'BUT Informatique - IUT Laval',
        'FPS Master',
        'Musculation - 3x10 reps',
        'Anime Fan',
        'Arduino: digitalWrite(13, HIGH)',
        'GIT: commit -m "Update"',
        'Ethernet: 192.168.1.1',

        // Gros pavés personnalisés
        `public class UltraKill {
    public static void main(String[] args) {
        System.out.println("KuKaRaCHa7_gg scores a headshot!");
        int kills = 666;
        while (kills > 0) {
            System.out.println("Demon slain!");
            kills--;
        }
    }
}`,
        `#!/bin/bash
# Script by KuKaRaCHa7_gg
echo "Starting DOOM server..."
if [ $(whoami) == "daniil" ]; then
    echo "Rip and Tear!"
    sudo apt install doom-engine
fi
`,
        `const apexLegends = {
    player: "KuKaRaCHa7_gg",
    rank: "Apex Predator",
    kills: 420,
    drop: function() {
        console.log(this.player + " lands at Skull Town");
    }
};
apexLegends.drop();`,
        `<!-- Portfolio de Daniil Minevich -->
<html>
<head>
    <title>KuKaRaCHa7_gg</title>
    <style>body { background: #000; color: #00FF00; }</style>
</head>
<body>
    <h1>Compétences</h1>
    <ul>
        <li>Java</li>
        <li>Javascript</li>
        <li>Python</li>
        <li>SQL</li>
    </ul>
    <p>Contact: 06 59 35 74 52</p>
</body>
</html>`,
        `class ArduinoProject {
    private int pin = 13;
    public void setup() {
        pinMode(pin, OUTPUT);
        Serial.begin(9600);
    }
    public void loop() {
        digitalWrite(pin, HIGH);
        delay(1000);
        digitalWrite(pin, LOW);
        delay(1000);
        Serial.println("KuKaRaCHa7_gg blinks LED");
    }
}`,
        `CREATE TABLE Etudiant (
                                   id INT PRIMARY KEY,
                                   nom VARCHAR(50) DEFAULT 'Daniil Minevich',
                                   pseudo VARCHAR(20) DEFAULT 'KuKaRaCHa7_gg',
                                   formation VARCHAR(50) DEFAULT 'BUT Informatique',
                                   telephone VARCHAR(15) DEFAULT '06 59 35 74 52'
         );
        INSERT INTO Etudiant (id) VALUES (1);`,
        `# Expérience - KuKaRaCHa7_gg
- Stagiaire @ ESIEA (2019)
    * Entretien PC
    * Support technique
- Stagiaire @ ASGL Conseil
    * Gestion serveurs à distance
    * Réparation borne arcade
# Formation
- Bac STI2D (2020-2023)
- BUT Informatique (Depuis 2023)`,
        `const gameStats = {
    player: "KuKaRaCHa7_gg",
    games: ["Ultrakill", "Doom", "Apex Legends"],
    hours: 1337,
    play: function() {
        this.games.forEach(game => {
            console.log("Playing " + game + " like a pro!");
        });
    }
};
gameStats.play();`
    ];

    function createCode() {
        const span = document.createElement('span');
        const isBig = Math.random() > 0.7;
        const snippetIndex = Math.floor(Math.random() * codeSnippets.length);

        span.textContent = codeSnippets[snippetIndex];
        span.className = 'flying-code-snippet' + (isBig ? ' big-code' : '');

        // Positionnement aléatoire horizontal (left)
        span.style.left = `${Math.random() * 100}vw`;
        // On laisse le CSS gérer le déplacement vertical via transform

        // Durée d’animation aléatoire entre 3s et 9s
        const duration = isBig ? Math.random() * 6 + 3 : Math.random() * 5 + 3;
        span.style.animationDuration = `${duration}s`;

        // Taille de police variable pour les gros snippets
        if (isBig) {
            span.style.fontSize = `${Math.random() * 0.4 + 0.8}em`;
        }

        // Ajout au conteneur
        container.appendChild(span);

        // Suppression après la fin de l’animation
        setTimeout(() => {
            if (span && span.parentNode) {
                span.remove();
            }
        }, duration * 1000);
    }

    // Supprimer le style injecté par JS (on utilise le CSS du fichier)
    // Pas besoin d’ajouter floatUp ici, flyAcross est dans style.css

    // Créer un nouveau morceau de code toutes les 300ms
    const interval = setInterval(createCode, 300);

    // Retourner une fonction pour arrêter si besoin
    return {
        stop: function() {
            clearInterval(interval);
            const snippets = container.querySelectorAll('.flying-code-snippet');
            snippets.forEach(snippet => snippet.remove());
        }
    };
}

// Initialisation des effets (à appeler dans votre script)
document.addEventListener('DOMContentLoaded', () => {
    initGlitchEffect();
    initLoadingBar();
    initFlyingCode();
    initBorderBlink();
    initCustomCursor();
});

// Curseur personnalisé
function initCustomCursor() {
    // Vérifier si le curseur existe déjà
    if (document.getElementById('custom-cursor')) return;

    const cursor = document.createElement('div');
    cursor.id = 'custom-cursor';
    document.body.appendChild(cursor);

    // Ajout CSS nécessaire si manquant
    if (!document.querySelector('#cursor-styles')) {
        const style = document.createElement('style');
        style.id = 'cursor-styles';
        style.textContent = `
            #custom-cursor {
                position: absolute;
                width: 20px;
                height: 20px;
                border: 2px solid #00FF00;
                border-radius: 50%;
                pointer-events: none;
                transform: translate(-50%, -50%);
                z-index: 9999;
                mix-blend-mode: difference;
            }
            .cursor-trail {
                position: absolute;
                width: 5px;
                height: 5px;
                background-color: rgba(0, 255, 0, 0.5);
                border-radius: 50%;
                pointer-events: none;
                transform: translate(-50%, -50%);
                z-index: 9998;
                animation: fadeOut 0.3s linear forwards;
            }
            @keyframes fadeOut {
                to { opacity: 0; transform: translate(-50%, -50%) scale(0.5); }
            }
        `;
        document.head.appendChild(style);
    }

    // Suivi du mouvement de la souris
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = `${e.pageX}px`;
        cursor.style.top = `${e.pageY}px`;
    });

    // Création de la traînée
    let lastTrailTime = 0;
    document.addEventListener('mousemove', (e) => {
        const now = Date.now();
        if (now - lastTrailTime > 30) { // Limiter la fréquence des traînées
            const trail = document.createElement('div');
            trail.className = 'cursor-trail';
            trail.style.left = `${e.pageX}px`;
            trail.style.top = `${e.pageY}px`;
            document.body.appendChild(trail);

            setTimeout(() => {
                if (trail && trail.parentNode) {
                    trail.remove();
                }
            }, 300);

            lastTrailTime = now;
        }
    });

}