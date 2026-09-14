
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$alert = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // reCAPTCHA server-side validation (essential to block bots)
    $recaptchaSecret = '6LfIrwksAAAAAO36BTAA-UFlDXP8DjdhIHcRkXnG'; // Replace with your reCAPTCHA Secret Key (keep private!)
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
    if (empty($recaptchaResponse)) {
        $alert = '<div class="alert alert-danger">CAPTCHA required. Please check the box.</div>';
    } else {
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaData)
            ]
        ];
        $context = stream_context_create($options);
        $recaptchaResult = file_get_contents($recaptchaUrl, false, $context);
        $recaptchaResultJson = json_decode($recaptchaResult);

        if (!$recaptchaResultJson->success) {
            $alert = '<div class="alert alert-danger">CAPTCHA verification failed. Please try again.</div>';
        } else {
            // Proceed with form processing only if CAPTCHA is valid
            $to = "hello@rensher.com";
            $subject = "Appointment Inquiry";
            $name = strip_tags($_POST["name"] ?? '');
            $email = strip_tags($_POST["email"] ?? '');
            $intent = strip_tags($_POST["intent"] ?? '');
            $comments = strip_tags($_POST["comments"] ?? ''); 

            $intentLabel = '';
            if ($intent === 'offer') {
                $intentLabel = 'offer';
            } elseif ($intent === 'request') {
                $intentLabel = 'request';
            } else {
                $intentLabel = 'inquiry';
            }

            $body = "Name: $name\nEmail: $email\nIntent: $intentLabel\nComments: $comments";
            $headers = "From: hello@rensher.com\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // Send to company
            $companySent = mail($to, $subject, $body, $headers);

            // Send confirmation to user
            $userSubject = "Thank you for your inquiry - RenSher Enterprises";
            $userBody = "Dear $name,\n\nThank you for contacting RenSher Enterprises LLC. We appreciate your interest in our services.\n\nSomeone from our team will reach out to you shortly to discuss your $intentLabel.\nIf you have any immediate questions, feel free to reply to this email.\n\nBest regards,\nThe RenSher Team\n--------\nRenSher Enterprises LLC\nCustom Web Development & More\nFlorida, USA\n+1-561-360-0081\nhello@rensher.com";
            $userHeaders = "From: hello@rensher.com\r\n";
            $userHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";

            $userSent = mail($email, $userSubject, $userBody, $userHeaders);

            if ($companySent && $userSent) {
                $alert = '<div class="alert alert-success">Message sent successfully! You will receive a confirmation email shortly.</div>';
            } elseif ($companySent) {
                $alert = '<div class="alert alert-warning">Message sent to us, but confirmation email failed. We\'ll contact you soon.</div>';
            } else {
                $alert = '<div class="alert alert-danger">Error sending message. Please try again.</div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.google.com/gtag/js?id=G-256P0XXK8Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-256P0XXK8Q');
    </script>

    <meta name="description" content="Contact RenSher Enterprises LLC for custom web development in Florida. Get a quote for your dream website! Automate your business (database)">
    <title>Contact RenSher Team</title>
    <!-- reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="canonical" href="https://www.rensher.com/contact_us.php">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    
    <style>
        /* Alert styles: Attractive, user-friendly messages */
.alert {
    padding: 15px; /* Espacio interno para legibilidad */
    margin: 20px auto; /* Centrado horizontal con espacio */
    border-radius: 8px; /* Bordes redondeados suaves */
    max-width: 500px; /* Mismo ancho que el form para consistencia */
    font-size: 16px; /* Texto legible */
    font-weight: 500; /* Negrita sutil */
    text-align: center; /* Centrado para UX amigable */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera para profundidad */
    border-left: 5px solid; /* Borde izquierdo coloreado para énfasis */
}

.alert-success {
    background-color: #d4edda; /* Verde claro para éxito */
    color: #155724; /* Texto verde oscuro */
    border-left-color: #28a745; /* Borde verde */
}

.alert-danger {
    background-color: #f8d7da; /* Rojo claro para errores */
    color: #721c24; /* Texto rojo oscuro */
    border-left-color: #dc3545; /* Borde rojo */
}

.alert-warning {
    background-color: #fff3cd; /* Amarillo claro para advertencias */
    color: #856404; /* Texto marrón */
    border-left-color: #ffc107; /* Borde amarillo */
}

/* Icono opcional (usa Font Awesome, que ya tienes) */
.alert::before {
    content: "✓"; /* Check para éxito, ! para error */
    font-weight: bold;
    margin-right: 10px;
    display: inline-block;
}

.alert-success::before {
    content: "✓"; /* Check verde */
    color: #28a745;
}

.alert-danger::before {
    content: "⚠"; /* Advertencia roja */
    color: #dc3545;
}

.alert-warning::before {
    content: "ℹ"; /* Info amarilla */
    color: #ffc107;
}

/* Responsive: En móviles, full-width y más padding */
@media (max-width: 600px) {
    .alert {
        max-width: 95%;
        margin: 10px auto;
        padding: 12px;
        font-size: 14px;
    }
}
  /* Estilos para el formulario: centrado, ancho adecuado, atractivo y responsive */
  .form-container {
    max-width: 500px; /* Ancho adecuado, no demasiado ancho */
    margin: 0 auto; /* Centrado horizontal */
    padding: 20px;
    background-color: #f9f9f9; /* Fondo sutil para atractivo */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para profundidad */
    font-family: Arial, sans-serif; /* Fuente limpia */
  }

  .form-container label {
    display: block; /* Cada label en su línea */
    margin-bottom: 5px;
    font-weight: bold;
    color: #333; /* Color de texto oscuro */
  }

  .form-container input[type="text"],
  .form-container input[type="email"] {
    width: 100%; /* Ancho completo del contenedor */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd; /* Borde sutil */
    border-radius: 5px; /* Bordes redondeados */
    box-sizing: border-box; /* Incluye padding en el ancho */
    font-size: 16px; /* Tamaño legible */
  }

  .form-container input[type="text"]:focus,
  .form-container input[type="email"]:focus {
    border-color: #007bff; /* Color azul al enfocar para atractivo */
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3); /* Efecto glow */
  }

  /* Estilos para radios: agrupados y atractivos */
  .radio-group {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff; /* Fondo blanco para resaltar */
    border-radius: 5px;
    border: 1px solid #6c85ab;
  }

  .radio-group p {
    margin: 0 0 10px 0;
    font-weight: bold;
    color: #555;
  }

 
  .radio-group input[type="radio"] {
  margin-right: 8px;
  width: 18px !important; /* Tamaño visible */
  height: 18px !important;
  -webkit-appearance: radio !important; /* Restaura círculo nativo */
  -moz-appearance: radio !important;
  -ms-appearance: radio !important;
  appearance: radio !important;
  display: inline-block !important; /* No block, para alineo horizontal */
  float: none !important; /* Quita el float que lo desalinea */
  margin-right: 10px !important; /* Espacio normal con texto */
  opacity: 1 !important; /* Visible */
  z-index: auto !important; /* No oculto */
  cursor: pointer !important;
  
}

  .radio-group label {
    display: inline; /* Inline para radios lado a lado */
    margin-right: 20px;
    font-weight: normal;
    cursor: pointer; /* Cursor pointer para interactividad */
  }

  /* Botón submit: atractivo */
  .actions {
    text-align: center; /* Centrado */
    margin-top: 20px;
  }

  .button {
    background-color: #6c85ab; /* verde*/
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-left:100%;
    transition: background-color 0.3s ease; /* Transición suave */
  }

  .button:hover {
    background-color: #567fbdff; /* verde más oscuro al hover */
  }
  .title{
    margin-left:45%;
  }


  /* Responsive: Ajustes para móviles */
  @media (max-width: 600px) {
      .title{
    margin-left:20%;
    margin-top:10%;
  }
    .form-container {
      max-width: 90%; /* Casi todo el ancho en móviles */
      padding: 15px;
      margin: 10px;
    }

    .radio-group label {
      display: block; /* Radios uno debajo del otro en móviles */
      margin-right: 0;
      margin-bottom: 10px;
    }

    .button {
      width: 100%; /* Botón full-width en móviles */
      margin-left:1%;
    }
  }
</style>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <a href="index.html">Home</a>
    </header>

    <section>
        <div>
            <section>
                <header class="title">
                    <h2>Contact Us</h2>
                </header>
            </section>
            <?php echo $alert; ?>
            <!-- Updated Form -->
            <div class="form-container">
                <form id="contactForm" method="POST" action="">
                    <div class="radio-group">
                        <p>Please select your intent:</p>
                        <label>
                            <input type="radio" id="request" name="intent" value="request" required>
                            Ask for a service
                        </label><br>
                        <label>
                            <input type="radio" id="offer" name="intent" value="offer">
                            Offer a service
                        </label>
                    </div>

                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required />

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />

                    <label for="comments">Comments</label>
                    <input type="text" id="comments" name="comments" placeholder="(optional)" />

                    <!-- reCAPTCHA: With callback to enable button -->
                    <div class="g-recaptcha" 
                         data-sitekey="6LfIrwksAAAAAL2V5ZJ4FwPTaYbCFJ9Xa26rrkFN"
                         data-callback="onRecaptchaSuccess" 
                         data-size="normal">
                    </div>
                    
                    <ul class="actions">
                        <li><button type="submit" id="submitBtn" class="button" disabled>Send</button></li>
                    </ul>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <ul class="alt-icons">
            <li>
                <a href="https://github.com/rensher-enterprises" 
                   class="icon brands fa-github" 
                   aria-label="Visit RenSher Enterprises on GitHub">
                    <span class="label">GitHub</span>
                </a>
            </li>
            <li>
                <a href="tel:+15613600081" 
                   class="icon solid fa-phone" 
                   aria-label="Call RenSher Enterprises at +1-561-360-0081">
                    <span class="label">Phone</span>
                </a>
            </li>
            <li>
                <a href="mailto:RenSherEnterprisesLLC@gmail.com?subject=Inquiry%20About%20Web%20Development%20Services&body=Hello%2C%20I%27m%20interested%20in%20your%20web%20development%20services%21" 
                   class="icon solid fa-envelope" 
                   aria-label="Email RenSher Enterprises">
                    <span class="label">Email</span>
                </a>
            </li>
        </ul>
        <ul class="menu">
            <li><a href="FAQ.html">FAQ</a></li>
            <li><a href="terms.html">Terms of Use</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <p class="copyright">
            &copy; RenSher Enterprises LLC. All rights reserved
        </p>
    </footer>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/7a7cff406c.js" crossorigin="anonymous"></script>
    
    <script>
        // Function called when reCAPTCHA is marked successfully
        function onRecaptchaSuccess(token) {
            document.getElementById('submitBtn').disabled = false; // Enable button
        }

        // Optional: Disable button if expired (rare in v2)
        function onRecaptchaExpired() {
            document.getElementById('submitBtn').disabled = true;
        }

        // Extra validation on submit (backup if JS fails)
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const recaptchaResponse = grecaptcha.getResponse();
            if (recaptchaResponse.length === 0) {
                e.preventDefault(); // Block submit
                alert('Please complete the CAPTCHA before submitting.');
            }
        });
    </script>
</body>

</html>
