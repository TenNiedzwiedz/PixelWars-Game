<?php
  use app\core\Application;
  use app\models\Pixel;

  $pixelDataArray = Pixel::getDataArray();

  //echo password_hash('zaq12wsx', PASSWORD_DEFAULT);

?>

<script type="text/javascript">

  function pixelModal($id, $color) {
    document.getElementById("idPixel").innerHTML = $id;
    document.getElementById("id").value = $id;
    document.getElementById("color").value = $color;
  }

  function setLastColor($color) {
    document.getElementById("color").value = $color;
  }

</script>

<div class="container text-center">
  <div id="obrazek" style="position:relative; margin:auto;width:800px; height:800px;"><div id="buttons" style="display: grid; grid-template-columns: repeat(100, auto);"></div></div>

      <script type="text/javascript">

        var data = <?= json_encode($pixelDataArray) ?>;

        var multi = 8;

        // First, we need to create a canvas with the same dimensions as the image data:
        var canvas = document.createElement("canvas");
        canvas.height = data.length*multi;
        canvas.width = data[0].length*multi;
        canvas.setAttribute("id", "Pixels");
        canvas.setAttribute("style", "position:absolute; top:0; left:0; z-index:-2")
        //canvas.style.visibility = "hidden";
        var target = document.getElementById("obrazek");
        var newTarget = document.getElementById("buttons");
        target.appendChild(canvas);

        var pixelId = 1;

        // Now that we have canvas to work with, we need to draw the image data into it:
        var ctx = canvas.getContext("2d");

      <?php if(Application::$app->session->get('userID') == ''): ?>
        for (var y = 0; y < data.length; ++y) {
          for (var x = 0; x < data[y].length; ++x) {
            ctx.fillStyle = data[y][x];
            ctx.fillRect(x*multi, y*multi, multi, multi);
          }
        }

        var newDiv = document.createElement("div");
        newDiv.setAttribute("style", "display:inline-block; width: "+data[0].length*multi+"px; height: "+data.length*multi+"px;");
        newDiv.setAttribute("data-bs-toggle", "modal");
        newDiv.setAttribute("data-bs-target", "#loginFormModal");
        target.appendChild(newDiv);

      <?php else: ?>
        for (var y = 0; y < data.length; ++y) {
          for (var x = 0; x < data[y].length; ++x) {
            ctx.fillStyle = data[y][x];
            ctx.fillRect(x*multi, y*multi, multi, multi);

            var newDiv = document.createElement("div");
            //newDiv.setAttribute("style", "display: inline-grid; width: 10px; height: 10px;");
            newDiv.setAttribute("style", "height: "+multi+"px;");
            newDiv.setAttribute("onclick", "pixelModal('" + pixelId + "','" + data[y][x] + "')");
            newDiv.setAttribute("data-bs-toggle", "modal");
            newDiv.setAttribute("data-bs-target", "#pixelModal");
            newTarget.appendChild(newDiv);

            pixelId++;
          }
        }
      <?php endif; ?>

      </script>

<div class="modal fade" id="pixelModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="changePixelModal">Zmień kolor pixela nr <a id='idPixel'></a></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/changePixel" method="post">
        <div class="modal-body">
          <?php if (!empty($lastColors)): ?>
          Ostatnio użyte kolory:
          <div style="width: 50%; padding: 10px; margin: 0 auto; display: grid; grid-auto-flow: column;">
            <?php
              foreach($lastColors as $key => $value)
              {
                echo "
                  <div style='background: $value; height: 20px; width: 35px; margin:auto; border: solid black 1px; border-radius: 5px; display: inline-grid; cursor: pointer;' onclick='setLastColor(\"$value\")'> </div>
                  ";
              }
            ?>
          </div>
        <?php endif; ?>
          <input hidden id="id" name="id" value="1">
          <div class="mb-3 text-center">
            <label class="form-label">Wybierz kolor:</label>
            <input id="color" name="color" type="color" class="form-control form-control-color" style="margin: auto;" value="#e6e6e6">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
          <button type="submit" class="btn btn-primary">Zmień</button>
        </div>
      </form>
    </div>
  </div>
</div>

</div>
