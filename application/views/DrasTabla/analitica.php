<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- View Browser -->
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap_3.3.7/dist/css/bootstrap.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap_3.3.7/dist/css/bootstrap-theme.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">

<!-- View PDF-->
<link rel="stylesheet" type="text/css" href="./assets/bootstrap_3.3.7/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./assets/bootstrap_3.3.7/dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="./assets/css/dompdf.css">

  <title>Analítica</title>

</head>
<body>
  <div id="container">

    <div id="row">
      <div id="col-lg-6 col-md-12">
        <div id="panel">
          <div class="panel-body">
              <div class="horizontal-scroll">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th colspan="2">Analítica</th>
                    </tr>
                    <tr>
                      <th colspan="2">A</th>
                    </tr>
                    <tr>
                      <th colspan="2">Características</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="col-md-6">Sangre fría</td>
                      <td class="col-md-6">Tienen un temperamento ecuánime, sereno y no sentimental</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Valores</td>
                      <td class="col-md-6">Tienen profundos valores y principios morales</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Pragmatismo</td>
                      <td class="col-md-6">Son personas que se remangan y se ponen a trabajar o a hacer lo que desean sin gastar demasiadas energías emocionales</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Orden</td>
                      <td class="col-md-6">Gusta de un ordenado modo de vida</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Los pies sobre la tierra</td>
                      <td class="col-md-6">Asumen su propia conducta, les gusta la planeación para tener claridad sobre las cosas y no suelen conmoverle mucho las alabanzas ni las críticas</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div> <!-- panel-body -->
        </div> <!-- panel -->
      </div> <!-- col  -->
    </div> <!-- row -->

  </div> <!-- fin container -->
</body>
</html>
