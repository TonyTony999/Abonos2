
<section id="form_categoria_add_disabled" class="form-categoria" >
<button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " onclick="closeMessage('form_categoria_add','enabled', true)"> <strong>cerrar</strong> </button>

    <h3 style="margin-top:0;margin-bottom:5vh;margin-left:5vw;">Crear Categoría</h3>

    <div class="popup-container-categoria">
        <form action="/post-categoria" method="POST">
            <div class="row">
                <div class="col-25" style="text-align:center">
                    <label for="titulo" >Título</label>
                </div>
                <div class="col-75">
                    <input type="text" id="titulo" name="titulo" placeholder="Título Categoria" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25" style="text-align:center" >
                    <label for="descripcion">Descripcion</label>
                </div>
                <div class="col-75">
                    <input type="textarea" id="descripcion" name="descripcion" placeholder="Descripcion.." required>
                </div>
            </div>
            <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " type="submit" class="btn-filled-dark" value="Submit">Crear</button>
        </form>
    </div>
</section>