<header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="banner">Envíos Gratuitos por compras de más de 100k</div>
    <nav>
        <div id="logo">

            <svg width="40" height="32" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8 32H0V21.9849C0 17.1239 4.0116 13.1839 8.96 13.1839H15.2V0.468341C15.2 0.251458 15.3792 0.0754376 15.6 0.0754376C15.7184 0.0754376 15.8308 0.127301 15.9068 0.216883L17.3616 1.92719C18.402 1.07577 19.74 0.563816 21.2 0.563816H22C23.442 0.563816 24.7656 1.06359 25.8 1.89654L27.2932 0.14066C27.3692 0.0514706 27.4812 0 27.6 0C27.8208 0 28 0.175628 28 0.392904V15.3896H23.36C17.528 15.3896 12.8 20.0337 12.8 25.7623V32Z" fill="#45413E" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.76 17.0569V12.0875C29.76 12.0836 29.76 12.0797 29.76 12.0758V6.79004C29.76 6.57435 29.9392 6.4 30.16 6.4C30.266 6.4 30.3676 6.44095 30.4424 6.51389L31.9576 7.98784C32.7864 7.42501 33.7936 7.09504 34.88 7.09504C35.97 7.09504 36.9808 7.42735 37.8112 7.99369L39.3176 6.52793C39.3924 6.45499 39.494 6.41404 39.6 6.41404C39.8208 6.41404 40 6.58878 40 6.80408V23.2632C40 28.0883 35.9884 32 31.04 32H14.4V25.7938C14.4 20.969 18.4116 17.0569 23.36 17.0569H29.76Z" fill="#45413E" />
            </svg>

            Abonos <br> Samacá
        </div>

        <ul class="navigation-menu" id="navigation-menu">
            <li><a href="#">Productos</a>
                <ul class="subnav">
                    <li>
                        <span>Humus</span>
                    </li>
                    <li>
                        <span>Bocacci</span>
                    </li>

                </ul>
            </li>
            <li><a href="#locate">Ubicación &amp; Horario de Atención</a>
            </li>
            <li>
                <a href="#">Sobre Nosotros</a>
            </li>
            <li>
                <a href="http://localhost:3000/login" target="_blank">Login</a>
            </li>
        </ul>

        <a href="javascript:void(0);" class="icon-container" onclick="toggleMenu()">
            <img id="icon-image" src="/assets/bars-solid.svg" alt="menu-icon" />
        </a>

    </nav>
</header>

<section class="hero">
    <img id="banner-image" src="/assets/cow.jpg" alt="abonos">

</section>

<!-------------------------------------------------------------------- GALLERRY ---------------------------------------------------------->


<section>
    <style>
        iframe {
            margin: 0;
            padding: 0;
            border: none;
            height: 600px;
        }

        @media only screen and (max-width: 600px) {
            iframe {
                height: 400px;
            }
        }
    </style>
    <iframe src="/assets/gallery.html" width="100%" scrolling="no" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

<!------
<iframe id="result" src="https://cdpn.io/yudizsolutions/fullpage/wvzrPoj?view=fullpage" width="90%" height="450" sandbox="allow-forms allow-modals allow-pointer-lock allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation allow-downloads allow-presentation" allow="camera; display-capture; geolocation; microphone; web-share" allowtransparency="true" allowpaymentrequest="true" allowfullscreen="true" class="result-iframe" loading="lazy">

</iframe>

------------->

<!-------------------------------------------------------------------- GALLERRY ---------------------------------------------------------->

<section>
    <h2>Nuestros Productos</h2>

    <ul class="shop-pets">
        <li class="card-large card-light" id="sup-dog">
            <div class="card-image"><img src="/assets/humus.PNG"></div>
            <ul>
                Humus Orgánico
                <li><a href="#">Nitrogeno</a></li>
                <li><a href="#">Carbono</a></li>

                <button class="btn-outline-light">Comprar<span class="material-symbols-outlined">

                    </span></button>

            </ul>


        </li>

        <li class="card-large card-dark" id="sup-cat">
            <div class="card-image"><img src="/assets/bocashi.jpg"></div>
            <ul>Bocacci
                <li><a href="#">Nitrogeno</a></li>
                <li><a href="#">Carbono</a></li>
                <button class="btn-outline-light">Comprar<span class="material-symbols-outlined">
            </ul>

        </li>

        <li class="card-large card-dark" id="sup-bird">
            <div class="card-image"><img src="/assets/supermagro.PNG"> </div>
            <ul>Supermagro
                <li><a href="#">Nitrogeno</a></li>
                <li><a href="#">Carbono</a></li>
                <button class="btn-outline-dark">Comprar<span class="material-symbols-outlined">

            </ul>

        </li>
        <li class="card-large card-light" id="sup-fish">
            <div class="card-image"><img src="/assets/compost.jpg"></div>
            <ul>
                Compost
                <li><a href="#">Nitrogeno</a></li>
                <li><a href="#">Carbono</a></li>
                <button class="btn-outline-light">Comprar<span class="material-symbols-outlined">

            </ul>

        </li>
    </ul>
</section>

<section>
    <h2>Nuestros Servicios</h2>

    <ul class="services">
        <li class="card-large card-dark card-wide" id="serv-groom">
            <div class="card-image"><img src="https://ouch-cdn2.icons8.com/T11rfGmMKgcStJyAFKNgtOfE79cadabx0DVMnvzA9Pk/rs:fit:368:313/czM6Ly9pY29uczgu/b3VjaC1wcm9kLmFz/c2V0cy9wbmcvNDQx/LzFlYWU4MWY3LWQ1/ZjYtNDM2Ny1hZjM5/LWVmNTFmMGM5Njk4/MS5wbmc.png"></div>
            <ul>
                Dog Grooming<span class="subtitle">Tail-wagging transformations are our specialty.</span>
                <li>
                    <a href="#">Coat Care</a>
                    <span>$80</span>
                </li>
                <li>
                    <a href="#">Nail Care</a>
                    <span>$16</span>
                </li>
                <li>
                    <a href="#">Doggie Deluxe Spa Day</a>
                    <span>$160</span>
                </li>
                <button class="btn-filled-dark"><span class="material-symbols-outlined">
                        calendar_month
                    </span>Book Now</button>

            </ul>


        </li>
        <li class="card-large card-dark card-wide" id="serv-board">
            <div class="card-image"><img src="https://ouch-cdn2.icons8.com/F5Ea1suZtMYimKDkJr0CJLO_1bju6-bTyT1EuDKEg8s/rs:fit:368:254/czM6Ly9pY29uczgu/b3VjaC1wcm9kLmFz/c2V0cy9wbmcvMjcx/LzVjMzE4NWM0LWZh/NTMtNGQ1OS05ZTM2/LTZjYzBhNGU3ODg0/NC5wbmc.png"></div>
            <ul>
                Dog Boarding<span class="subtitle">Where fun and care never take a day off.</span>
                <li>
                    <a href="#">Doggie Daycare</a>
                    <span>$80</span>
                </li>
                <li>
                    <a href="#">Short Term Boarding</a>
                    <span>$80</span>
                </li>
                <button class="btn-filled-dark"><span class="material-symbols-outlined">
                        calendar_month
                    </span>Book Now</button>
            </ul>

        </li>
    </ul>
</section>



<section id="locate">

    <div style="width:auto">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15886.003676711243!2d-73.4964588213678!3d5.492363771142053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e402ab44e99a80b%3A0xc7a030668ee44cea!2zU2FtYWPDoSwgQm95YWPDoQ!5e0!3m2!1ses!2sco!4v1703717306363!5m2!1ses!2sco" width="90%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <br>
        <h2>Ubicación &amp; Horario de Atención</h2>
        <p>Agende una visita</p>
        <div class="btn-group">
            <button class="btn-filled-dark">
                <span class="material-symbols-outlined">
                    Ubique nuestra sede
                </span>
            </button>
            <button class="btn-outline-dark btn-hover-color">
                <span class="material-symbols-outlined">
                    Contacto
                </span>
            </button>
        </div>
    </div>
</section>

<!-------------------------------------------------------------------- FORMULARIO CONTACTO ---------------------------------------------------------->

<section id="contact-form">

<h2 id="contacto" style="margin-bottom:0;" >Contáctanos</h2>

    <div class="container">
        <form action="/submit-contact-form" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre.." autocomplete="on" required >
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Email</label>
                </div>
                <div class="col-75">
                    <input type="email" id="email" name="email" placeholder="Tu Correo .." autocomplete="on" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="numero">Número</label>
                </div>
                <div class="col-75">
                    <input type="text" id="numero" name="numero" autocomplete="on" placeholder="Tu Número .." maxlength="15">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="pais">País</label>
                </div>
                <div class="col-75">
                    <select id="pais" name="pais">
                        <option value="Colombia">Colombia</option>
                        <option value="España">España</option>
                        <option value="Usa">USA</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="mensaje">Mensaje</label>
                </div>
                <div class="col-75">
                    <textarea id="mensaje" name="mensaje" placeholder="Escríbenos.." style="height:200px" autocomplete="on" required></textarea>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn-filled-dark" value="Submit" onclick="mensajeEnviado()">Enviar</button>
            </div>
        </form>
    </div>
</section>


<footer>

    <ul>
        Productos
        <li><a href="#">Abonos Orgánicos</a></li>
        <li><a href="#">Humus Líquido</a></li>
        <li><a href="#">Humus Sólido</a></li>
        <li><a href="#">Compost</a></li>
        <li><a href="#">Bocacci</a></li>
        <li><a href="#">Supermagro</a></li>
    </ul>

    <ul>
        Nuestros Servicios
        <li><a href="#">Capacitaciones</a></li>
        <li><a href="#">Acompañamiento</a></li>
    </ul>
    <ul>
        Nuestra Empresa
        <li><a href="#">Ubicación &amp; Horario de Atención</a></li>
        <li><a href="#">Sobre Nosotros</a></li>
    </ul>


</footer>