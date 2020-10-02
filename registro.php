
<?php include_once 'includes/templates/header.php'; ?>


    <section class="section container">
        <h2>Registro de Usuario</h2>
        <form id="register" class="register" action="" method="post">
            <div id="user-date" class="user-date caja clearfix">

                <div class="camp">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name" placeholder="Tu Nombre">
                </div><!-- .camp -->

                <div class="camp">
                    <label for="surname">Apellido: </label>
                    <input type="text" name="surname" id="surname" placeholder="Tu Apellido">
                </div><!-- .camp -->

                <div class="camp">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Tu Email">
                </div><!-- .camp -->

                <p id="error"></p>
                <p id="errorMail"></p>

            </div><!-- #user-date .user-date .caja -->  

            <div id="packs" class="packs">
                <h3>Elige el número de boletos</h3>
                <ul class="price-list container">
                    <li>
                        <div class="price-table">
                            <h3>Pase por Día (Viernes)</h3>
                            <p class="number">$30</p>
                            <ul class="ticks">
                                <li>Bocadillos Gratis</li>
                                <li>Todas las Conferencias</li>
                                <li>Todos los Talleres</li>
                            </ul>
                            <div class="order">
                                <label for="day-pass">Boletos deseados: </label>
                                <input type="number" name="number-order" id="day-pass" min="0" size="10" placeholder="0">
                            </div>
                        </div>
                    </li>
                
                    <li>
                        <div class="price-table">
                            <h3>Todos los Días</h3>
                            <p class="number">$50</p>
                            <ul class="ticks">
                                <li>Bocadillos Gratis</li>
                                <li>Todas las Conferencias</li>
                                <li>Todos los Talleres</li>
                            </ul>
                            <div class="order">
                                <label for="all-pass">Boletos deseados: </label>
                                <input type="number" name="number-order" id="all-day-pass" min="0" size="10" placeholder="0">
                            </div>
                        </div>
                    </li>
                
                    <li>
                        <div class="price-table">
                            <h3>Pase por 2 Días (Viernes y Sábado)</h3>
                            <p class="number">$45</p>
                            <ul class="ticks">
                                <li>Bocadillos Gratis</li>
                                <li>Todas las Conferencias</li>
                                <li>Todos los Talleres</li>
                            </ul>
                            <div class="order">
                                <label for="two-pass">Boletos deseados: </label>
                                <input type="number" name="number-order" id="two-days-pass" min="0" size="10" placeholder="0">
                            </div>
                        </div>
                    </li>
                </ul><!-- .price-list .container -->
            </div><!-- #packs .packs -->

            <!-- Imported from "https://gist.github.com/juanpablogdl/d3c12e82fb6b78b8a7222c2b716fb3ab#" -->

            <div id="eventos" class="eventos clearfix">
                <h3>Elige tus talleres</h3>
                <div class="caja clearfix">

                    <div id="viernes" class="contenido-dia clearfix">
                        <h4>Viernes</h4>
                        <div>
                            <p>Talleres:</p>
                            <label><input type="checkbox" name="registro[]" id="taller_01" value="taller_01"><time>10:00</time> Responsive Web Design</label>
                            <label><input type="checkbox" name="registro[]" id="taller_02" value="taller_02"><time>12:00</time> Flexbox</label>
                            <label><input type="checkbox" name="registro[]" id="taller_03" value="taller_03"><time>14:00</time> HTML5 y CSS3</label>
                            <label><input type="checkbox" name="registro[]" id="taller_04" value="taller_04"><time>17:00</time> Drupal</label>
                            <label><input type="checkbox" name="registro[]" id="taller_05" value="taller_05"><time>19:00</time> WordPress</label>
                        </div>
                        <div>
                            <p>Conferencias:</p>
                            <label><input type="checkbox" name="registro[]" id="conf_01" value="conf_01"><time>10:00</time> Como ser Freelancer</label>
                            <label><input type="checkbox" name="registro[]" id="conf_02" value="conf_02"><time>17:00</time> Tecnologías del Futuro</label>
                            <label><input type="checkbox" name="registro[]" id="conf_03" value="conf_03"><time>19:00</time> Seguridad en la Web</label>
                        </div>
                        <div>
                            <p>Seminarios:</p>
                            <label><input type="checkbox" name="registro[]" id="sem_01" value="sem_01"><time>10:00</time> Diseño UI y UX para móviles</label>
                        </div>
                    </div><!--#viernes-->

                    <div id="sabado" class="contenido-dia clearfix">
                        <h4>Sábado</h4>
                        <div>
                            <p>Talleres:</p>
                            <label><input type="checkbox" name="registro[]" id="taller_06" value="taller_06"><time>10:00</time> AngularJS</label>
                            <label><input type="checkbox" name="registro[]" id="taller_07" value="taller_07"><time>12:00</time> PHP y MySQL</label>
                            <label><input type="checkbox" name="registro[]" id="taller_08" value="taller_08"><time>14:00</time> JavaScript Avanzado</label>
                            <label><input type="checkbox" name="registro[]" id="taller_09" value="taller_09"><time>17:00</time> SEO en Google</label>
                            <label><input type="checkbox" name="registro[]" id="taller_10" value="taller_10"><time>19:00</time> DePhotoshop a HTML5 y CSS3</label>
                            <label><input type="checkbox" name="registro[]" id="taller_11" value="taller_11"><time>21:00</time> PHPMedio y Avanzado</label>
                        </div>
                        <div>
                            <p>Conferencias:</p>
                            <label><input type="checkbox" name="registro[]" id="conf_04" value="conf_04"><time>10:00</time> Comocrear una tienda online que venda millones en pocos días</label>
                            <label><input type="checkbox" name="registro[]" id="conf_05" value="conf_05"><time>17:00</time> Los mejores lugares para encontrar trabajo</label>
                            <label><input type="checkbox" name="registro[]" id="conf_06" value="conf_06"><time>19:00</time> Pasos para crear un negocio rentable</label>
                        </div>
                        <div>
                            <p>Seminarios:</p>
                            <label><input type="checkbox" name="registro[]" id="sem_02" value="sem_02"><time>10:00</time> Aprende a Programar en una mañana</label>
                            <label><input type="checkbox" name="registro[]" id="sem_03" value="sem_03"><time>17:00</time> Diseño UI y UX para móviles</label>
                        </div>
                    </div><!--#sabado-->

                    <div id="domingo" class="contenido-dia clearfix">
                        <h4>Domingo</h4>
                        <div>
                            <p>Talleres:</p>
                            <label><input type="checkbox" name="registro[]" id="taller_12" value="taller_12"><time>10:00</time> Laravel</label>
                            <label><input type="checkbox" name="registro[]" id="taller_13" value="taller_13"><time>12:00</time> Creatu propia API</label>
                            <label><input type="checkbox" name="registro[]" id="taller_14" value="taller_14"><time>14:00</time> JavaScript y jQuery</label>
                            <label><input type="checkbox" name="registro[]" id="taller_15" value="taller_15"><time>17:00</time> Creando Plantillas para WordPress</label>
                            <label><input type="checkbox" name="registro[]" id="taller_16" value="taller_16"><time>19:00</time> Tiendas Virtuales en Magento</label>
                        </div>
                        <div>
                            <p>Conferencias:</p>
                            <label><input type="checkbox" name="registro[]" id="conf_07" value="conf_07"><time>10:00</time> Comohacer Marketing en línea</label>
                            <label><input type="checkbox" name="registro[]" id="conf_08" value="conf_08"><time>17:00</time> ¿Con que lenguaje debo empezar?</label>
                            <label><input type="checkbox" name="registro[]" id="conf_09" value="conf_09"><time>19:00</time> Frameworks y librerias Open Source</label>
                        </div>
                        <div>
                            <p>Seminarios:</p>
                            <label><input type="checkbox" name="registro[]" id="sem_04" value="sem_04"><time>14:00</time> Creandouna App en Android en una tarde</label>
                            <label><input type="checkbox" name="registro[]" id="sem_05" value="sem_05"><time>17:00</time> Creandouna App en iOS en una tarde</label>
                        </div>
                    </div><!--#domingo-->

                </div><!--.caja-->
            </div><!--#eventos-->

            <div id="resumen" class="resumen">
                <h3>Pagos y Extras</h3>
                <div class="caja clearfix">
                    <div class="extras">
                        <div class="orden">
                            <label for="camisa-evento">Camisa del evento $10 <small>(Promoción 7% dto.)</small></label>
                            <input type="number" id="camisa-evento" min="0" size="10" placeholder="0">
                        </div><!-- .orden -->
                        <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CCS3, JavaScript)</small></label>
                            <input type="number" id="etiquetas" min="0" size="10" placeholder="0">
                        </div><!-- .orden -->
                        <div class="orden">
                            <label for="regalo"></label>
                            <select id="regalo" required>
                                <option class="low-font" value="">-- Seleccione un Regalo --</option>
                                <option value="Etiqueta">Etiqueta</option>
                                <option value="Pulsera">Pulsera</option>
                                <option value="Pluma">Pluma</option>
                            </select>
                        </div><!-- .orden -->

                        <input type="button" id="calcular" class="button" value="Caluclar">
                    </div><!-- .extras -->

                    <div class="total">
                        
                        <p>Resumen: </p>

                        <div id="lista-productos">
                            
                        </div>

                        <p>Total: USD <span id="suma-total"></span></p>

                        <input type="submit" id="btnregistro" class="button" value="Pagar">
                    </div>
                </div>
            </div>

            <!-- Finish Imported -->

        </form>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>
