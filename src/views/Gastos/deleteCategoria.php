<section id="form_categoria_delete_disabled" class="form-categoria">
    <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " onclick="closeMessage('form_categoria_delete','enabled', true)"> <strong>cerrar</strong> </button>

    <h3 style="margin-top:0;margin-bottom:0;margin-left:5vw;">Eliminar Categoria</h3>
    <div class="popup-container-categoria">
        <form action="/delete-categoria" method="POST">
            <div class="row">
                <div class="col-25" style="text-align:center" >
                    <label for="categoria">Categoría</label>
                </div>
                <div class="col-75">
                    <select id="categoria" name="categoria">
                        <?php

                        foreach ($categorias as $categoria) {
                            $titulo = $categoria['titulo'];

                            $str = <<<EOD
                            <option value="$titulo">$titulo</option>
                            EOD;
                            echo $str;
                        }
                        ?>
                    </select>
                </div>
            </div>

            <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " type="submit" class="btn-filled-dark" value="Submit">Eliminar</button>
        </form>
    </div>
</section>