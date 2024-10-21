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

  <title>Dirigente</title>

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
                      <th colspan="2">Dirigente</th>
                    </tr>
                    <tr>
                      <th colspan="2">D</th>
                    </tr>
                    <tr>
                      <th colspan="2">Características</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="col-sm-6">Mando</td>
                      <td class="col-md-6">Son personas que se hacen cargo de una situación y ejercen el poder con naturalidad</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Valentía</td>
                      <td class="col-md-6">Son combativos, les gusta la acción y la aventura, son agresivos físicamente</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Metas</td>
                      <td class="col-md-6">Tienen el punto de mira siempre puestos en sus objetivos, no les cuesta tomar decisiones y son capaces de valerse por sí mismos</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Críticas</td>
                      <td class="col-md-6">No asimilan bien las críticas y suelen defenderse ante estas, prefieren ver lo malo en los demás</td>
                    </tr>
                    <tr>
                      <td class="col-md-6">Competitividad</td>
                      <td class="col-md-6">Les gusta competir y hacen gala de un gran arrojo en situaciones difíciles, les encanta llegar a lo más alto y quedarse ahí</td>
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
