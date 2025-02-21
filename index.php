<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPerfum - Software de Gestión para Perfumerías</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    :root {
    --color-royal-blue: #4169E1;
    --color-royal-blue-dark: #27408B;
    --color-royal-blue-light: #6495ED;
    --color-orange: #FFA500;
    --color-orange-dark: #FF8C00;
    --color-white: #FFFFFF;
    --color-light-gray: #F0F8FF;
    --color-dark-gray: #333333;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: var(--color-dark-gray);
    background-color: var(--color-white);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

header {
    background-color: var(--color-royal-blue);
    padding: 1rem 0;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--color-white);
}

nav ul {
    display: flex;
    list-style: none;
}

nav ul li {
    margin-left: 1.5rem;
}

nav ul li a {
    text-decoration: none;
    color: var(--color-white);
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: var(--color-orange);
}

main {
    margin-top: 60px;
}

section {
    padding: 4rem 0;
}

.hero {
    background-image: linear-gradient(rgba(65, 105, 225, 0.35), rgba(65, 105, 225, 0.15)), url('assets/images/background.jpg');
    background-size: cover;
    background-position: center;
    color: var(--color-white);
    text-align: center;
    padding: 6rem 0;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
    text-align: center;
    color: var(--color-royal-blue);
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.cta-button {
    padding: 0.8rem 2rem;
    font-size: 1rem;
    background-color: var(--color-orange);
    color: var(--color-white);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.cta-button:hover {
    background-color: var(--color-orange-dark);
}

#demo-form {
    display: flex;
    justify-content: center;
    gap: 10px;
}

#demo-form input {
    padding: 0.8rem;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    width: 300px;
}

.feature-grid, .reasons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature, .reason {
    background-color: var(--color-light-gray);
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature:hover, .reason:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(255, 165, 0, 0.3);
}

.feature i, .reason i {
    font-size: 3rem;
    color: var(--color-orange);
    margin-bottom: 1rem;
}

.feature h3, .reason h3 {
    margin-bottom: 1rem;
    color: var(--color-royal-blue);
}

#por-que-elegir {
    background-color: var(--color-royal-blue);
    color: var(--color-white);
}

#por-que-elegir h2 {
    color: var(--color-white);
}

#por-que-elegir .reason {
    background-color: var(--color-royal-blue-dark);
}

#por-que-elegir .reason h3 {
    color: var(--color-orange);
}

.testimonial-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial {
    background-color: var(--color-light-gray);
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    border-left: 5px solid var(--color-orange);
}

.testimonial p {
    font-style: italic;
    margin-bottom: 1rem;
}

.testimonial cite {
    font-weight: bold;
    color: var(--color-royal-blue);
}

#contact-form {
    display: flex;
    flex-direction: column;
    max-width: 500px;
    margin: 0 auto;
}

#contact-form input,
#contact-form textarea {
    margin-bottom: 1rem;
    padding: 0.8rem;
    border: 1px solid var(--color-royal-blue-light);
    border-radius: 5px;
}

#contact-form textarea {
    height: 150px;
}

footer {
    background-color: var(--color-royal-blue-dark);
    color: var(--color-white);
    text-align: center;
    padding: 2rem 0;
}

.social-links {
    margin-top: 1rem;
}

.social-links a {
    color: var(--color-orange);
    font-size: 1.5rem;
    margin: 0 10px;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: var(--color-orange-dark);
}

@media (max-width: 768px) {
    nav {
        flex-direction: column;
    }

    nav ul {
        margin-top: 1rem;
    }

    .hero h1 {
        font-size: 2rem;
    }

    .hero p {
        font-size: 1rem;
    }

    #demo-form {
        flex-direction: column;
        align-items: center;
    }

    #demo-form input {
        width: 100%;
        max-width: 300px;
    }
}
</style>
<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo">SGPerfum</div>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#caracteristicas">Características</a></li>
                    <li><a href="#por-que-elegir">Por qué elegirnos</a></li>
                    <li><a href="#testimonios">Testimonios</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section id="inicio" class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Gestión Inteligente para tu Perfumería</h1>
                    <p>Optimiza tu negocio con SGPerfum, la solución todo en uno para perfumerías</p>
                        <a href="src/auth/login.php" class="cta-button">Ingresa a SGPerfum</a>
                </div>
            </div>
        </section>

        <section id="caracteristicas">
            <div class="container">
                <h2>Características Principales</h2>
                <div class="feature-grid">
                    <div class="feature">
                        <i class="fas fa-box-open"></i>
                        <h3>Gestión de Inventario</h3>
                        <p>Control preciso de stock en tiempo real</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-chart-line"></i>
                        <h3>Análisis de Ventas</h3>
                        <p>Informes detallados y pronósticos</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-users"></i>
                        <h3>CRM Integrado</h3>
                        <p>Gestión eficiente de clientes y fidelización</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-mobile-alt"></i>
                        <h3>Acceso Móvil</h3>
                        <p>Gestiona tu negocio desde cualquier lugar</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="por-que-elegir">
            <div class="container">
                <h2>Por Qué Elegir SGPerfum</h2>
                <div class="reasons-grid">
                    <div class="reason">
                        <i class="fas fa-rocket"></i>
                        <h3>Rápida Implementación</h3>
                        <p>Comienza a usar el sistema en cuestión de días, no meses</p>
                    </div>
                    <div class="reason">
                        <i class="fas fa-lock"></i>
                        <h3>Seguridad Avanzada</h3>
                        <p>Protección de datos de nivel bancario para tu tranquilidad</p>
                    </div>
                    <div class="reason">
                        <i class="fas fa-headset"></i>
                        <h3>Soporte 24/7</h3>
                        <p>Asistencia experta disponible en todo momento</p>
                    </div>
                    <div class="reason">
                        <i class="fas fa-sync"></i>
                        <h3>Actualizaciones Regulares</h3>
                        <p>Mejoras continuas basadas en feedback de usuarios</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonios">
            <div class="container">
                <h2>Lo Que Dicen Nuestros Clientes</h2>
                <div class="testimonial-grid">
                    <div class="testimonial">
                        <p>"SGPerfum ha revolucionado la forma en que gestionamos nuestra perfumería. Es intuitivo y potente."</p>
                        <cite>- María Rodríguez, Perfumes Élite</cite>
                    </div>
                    <div class="testimonial">
                        <p>"Desde que implementamos SGPerfum, nuestras ventas han aumentado un 30%. ¡Increíble herramienta!"</p>
                        <cite>- Carlos Gómez, Aroma Chic</cite>
                    </div>
                </div>
            </div>
        </section>

        <section id="contacto">
            <div class="container">
                <h2>¿Listo para Optimizar tu Perfumería?</h2>
                <p>Contáctanos hoy y descubre cómo SGPerfum puede transformar tu negocio</p>
                <form id="contact-form">
                    <input type="text" placeholder="Nombre" required>
                    <input type="email" placeholder="Email" required>
                    <textarea placeholder="Mensaje" required></textarea>
                    <button type="submit" class="cta-button">Enviar Mensaje</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 SGPerfum. Todos los derechos reservados.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling para los enlaces de navegación
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Manejo del formulario de demo
    const demoForm = document.getElementById('demo-form');
    demoForm.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Gracias por tu interés. Te contactaremos pronto para programar tu demo.');
        demoForm.reset();
    });

    // Manejo del formulario de contacto
    const contactForm = document.getElementById('contact-form');
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
        contactForm.reset();
    });

    // Animación de aparición para las características y razones
    const animateOnScroll = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    };

    const observer = new IntersectionObserver(animateOnScroll, {
        root: null,
        threshold: 0.1
    });

    document.querySelectorAll('.feature, .reason').forEach(item => {
        observer.observe(item);
    });

    // Cambio de color de la barra de navegación al hacer scroll
    const header = document.querySelector('header');
    const changeHeaderBg = () => {
        if (window.scrollY > 100) {
            header.style.backgroundColor = 'rgba(65, 105, 225, 0.9)';
        } else {
            header.style.backgroundColor = 'var(--color-royal-blue)';
        }
    };

    window.addEventListener('scroll', changeHeaderBg);
});
    </script>
</body>
</html>