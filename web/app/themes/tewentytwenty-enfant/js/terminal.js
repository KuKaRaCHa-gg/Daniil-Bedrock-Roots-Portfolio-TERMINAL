document.addEventListener("DOMContentLoaded", function() {
            // Animation du texte de description du site comme une commande terminal
            const description = document.querySelector('.site-description');
            if (description) {
                const originalText = description.innerHTML;
                description.innerHTML = "";

                setTimeout(() => {
                    typeWriter(description, originalText, 0, 50);
                }, 500);
            }

            // Animation des menus avec apparition progressive
            const menuItems = document.querySelectorAll('.terminal-menu-list li');
            menuItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(10px)';

                setTimeout(() => {
                    item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 1000 + (index * 150));
            });

            // Effet de frappe de texte pour les commandes
            const commands = document.querySelectorAll(".terminal-command");
            commands.forEach((command, index) => {
                const originalText = command.innerHTML;
                command.innerHTML = "";

                setTimeout(() => {
                    typeWriter(command, originalText, 0, 30);
                }, index * 800);
            });

            // Fonction pour simuler l'effet de machine à écrire
            function typeWriter(element, text, i, speed) {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(() => typeWriter(element, text, i, speed), speed);
                }
            }

            // Animation du curseur clignotant dans les titres
            const cursor = document.querySelector('.cursor-blink');
            if (cursor) {
                setInterval(() => {
                    cursor.style.opacity = cursor.style.opacity === '0' ? '1' : '0';
                }, 500);
            }

            // Effet de survol pour les logos et badges technologiques
            const techLogos = document.querySelectorAll(".tech-logo, .tech-tag");
            techLogos.forEach(logo => {
                logo.addEventListener("mouseover", function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 5px 15px rgba(51, 255, 51, 0.3)';
                });

                logo.addEventListener("mouseout", function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });

            // Animation de chargement pour les galeries d'images
            const galleryItems = document.querySelectorAll('.gallery-item');
            galleryItems.forEach((item, index) => {
                item.style.opacity = '0';

                setTimeout(() => {
                    item.style.transition = 'opacity 0.5s ease';
                    item.style.opacity = '1';
                }, 200 + (index * 100));
            });

            // Ajout d'un effet de glitch aléatoire sur le header
            const headerTitle = document.querySelector('.terminal-title-bar');
            if (headerTitle) {
                setInterval(() => {
                    if (Math.random() > 0.97) {
                        headerTitle.classList.add('glitch');
                        setTimeout(() => {
                            headerTitle.classList.remove('glitch');
                        }, 200);
                    }
                }, 2000);
            }
        });