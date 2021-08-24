<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Monitor</title>

  <link rel="stylesheet" href="libs/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="libs/fontawesome_all.css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="libs/bootstrap-table.min.css">

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"> -->
  <script src="libs/Chart.min.js"></script>
</head>

<body>
  <nav>
    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
      <a class="nav-item nav-link" id="crearon" data-toggle="tab" href="#nav-crearon" role="tab" aria-controls="nav-crearon" aria-selected="true">Cuentas creadas por fecha</a>
      <a class="nav-item nav-link" id="complementaron" data-toggle="tab" href="#nav-complementaron" role="tab" aria-controls="nav-complementaron" aria-selected="false">Personas que complementaron información</a>
      <!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
    </div>
  </nav>
  <div class="card">
    <!-- <div class="card-header">
      IECM - Reporteador
    </div> -->
    <?php $today = date("Y-m-d H:i:s"); ?>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-crearon" role="tabpanel" aria-labelledby="crearon">
        <!-- TOTAL DE REGISTROS POR FECHA -->
        <div class="card-body">
          <h5 class="card-title">Personas que se registraron (crearon una cuenta)</h5>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <table data-toggle="table" data-show-export="true" data-export-types="['csv', 'doc', 'excel']" data-search="true" data-show-columns="true" data-export-options='{"fileName": "Personas_que_crearon_una_cuenta_<?php echo $today; ?>"}' data-pagination="true">
                  <thead>
                    <tr class="tr-class-2">
                      <th data-field="star" data-sortable="true">#</th>
                      <th data-field="forks" data-sortable="true">Fecha de registro</th>
                      <th data-field="description" data-sortable="true">N&uacute;mero de registros</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include '../sqlconnector.php';
                      // echo $today;
                      $query_get_by_date = "SELECT COUNT(*) AS numero_registros, CAST(fecha_alta AS DATE) AS fecha_registro FROM ".BD_USUARIOS." WHERE perfil = ? GROUP BY CAST(fecha_alta AS DATE) ORDER BY fecha_registro;";
                      $params_query_by_date = array(1);
                      $exe_get_by_date = sqlsrv_query($conn, $query_get_by_date, $params_query_by_date);
                      if($exe_get_by_date){
                        $i = 1;
                        while ($row_by_ate = sqlsrv_fetch_array($exe_get_by_date)) {
                          echo '<tr id="tr-id-'.$i.'" class="tr-class-'.$i.'">
                                  <td id="td-id-'.$i.'" class="td-class-'.$i.'">'.$i.'</td>
                                  <td>'.$row_by_ate['fecha_registro'].'</td>
                                  <td>'.$row_by_ate['numero_registros'].'</td>
                                </tr>';
                                $i++;
                        }
                      } else{
                        echo "<tr><td colspan='3'>Error: ".die( print_r( sqlsrv_errors(), true) )."</td></tr>";
                      }
                      sqlsrv_free_stmt($exe_get_by_date);
                      //sqlsrv_close($conn);
                      //die( print_r( sqlsrv_errors(), true) )
                       ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="nav-complementaron" role="tabpanel" aria-labelledby="complementaron">
        <!-- PERSONA REGISTRADAS -->
        <div class="card-body">
          <h5 class="card-title">Personas que complementaron información</h5>
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <table data-toggle="table" data-show-export="true" data-export-types="['csv', 'doc', 'excel']" data-search="false" data-show-columns="true" data-export-options='{"fileName": "Personas_que_complementaron_información_<?php echo $today; ?>"}'>
                    <thead>
                      <tr class="tr-class-2" style="font-size: 13px;">
                        <th data-field="categoria" data-sortable="true">Categoría</th>
                        <th data-field="num_regist" data-sortable="true">N&uacute;mero de registros</th>
                        <th data-field="con_folio" data-sortable="true">Con folio</th>
                        <th data-field="sin_folio" data-sortable="true">Sin folio</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query_get_by_category = "SELECT categoria, COUNT(*) AS numero_registros, SUM (CASE WHEN folio IS NOT NULL THEN 1 ELSE 0 END) AS con_folio, SUM (CASE WHEN folio IS NULL THEN 1 ELSE 0 END) AS sin_folio FROM ".BD_PARTICIPANTES." GROUP BY categoria;";
                      $params_query_by_category = array();
                      $exe_get_by_category = sqlsrv_query($conn, $query_get_by_category, $params_query_by_category);
                      $arr_con_folio = array();
                      //            categoria1, categoría2
                      $arr_sin_folio = array();
                      //            categoria1, categoría2
                      if($exe_get_by_category){
                        $i = 1;
                        //unset($arr_con_folio, $arr_sin_folio);
                        $categorias = array();
                        while ($row_by_category = sqlsrv_fetch_array($exe_get_by_category)) {
                          echo '<tr id="tr-id-'.$i.'" class="tr-class-'.$i.'">
                                  <td>'.$row_by_category['categoria'].'</td>
                                  <td>'.$row_by_category['numero_registros'].'</td>
                                  <td>'.$row_by_category['con_folio'].'</td>
                                  <td>'.$row_by_category['sin_folio'].'</td>
                                </tr>';
                                $i++;
                                $categoria_row = $row_by_category['categoria'];
                                $con_folio = $row_by_category['con_folio'];
                                $sin_folio = $row_by_category['sin_folio'];
                                $categorias[] = ["categoria" => $categoria_row,
                                                  "con_sin" => array($con_folio, $sin_folio)
                                              ];
                        }
                        // echo "<pre>";
                        // var_dump($categorias);
                        // echo "</pre>";
                        $labels = "";
                        $existe1 = false;
                        $existe2 = false;
                        $data_con_to_array = "";
                        $data_sin_to_array = "";
                        $nuevo = array();
                        for ($j=0; $j <=count($categorias)-1 ; $j++) {
                          if($categorias[$j]["categoria"] === 1){
                            //echo "<p style='color: #007bff;'>existe 1</p>";
                            $existe1 = true;
                          }
                          if($categorias[$j]["categoria"] === 2){
                            //echo "<p style='color: #007bff;'>existe 2</p>";
                            $existe2 = true;
                          }
                          $data_con_to_array = $categorias[$j]["con_sin"][0];
                          $$data_sin_to_array = $categorias[$j]["con_sin"][1];
                          $nuevo[] = [$data_con_to_array, $$data_sin_to_array];
                        }

                        list($list_con_folio, $list_sin_folio) = $nuevo[0];
                        $data_con = "[".$list_con_folio."]";
                        $data_sin = "[".$list_sin_folio."]";
                        if($existe1 && !$existe2){
                          //echo "existe 1 y no 2<br>";
                          $labels = '["Categoría 1"]';
                        } elseif($existe2 && !$existe1){
                          //echo "existe 2 y no 1<br>";
                          $labels = '["Categoría 2"]';
                        } else{
                          //echo "Existen los 2";
                          $labels = '["Categoría 1", "Categoría 2"]';
                          list($complemento_con_folio, $complemento_sin_folio) = $nuevo[1];
                          $data_con = "[".$list_con_folio.", ".$complemento_con_folio."]";
                          $data_sin = "[".$list_sin_folio.", ".$complemento_sin_folio."]";
                        }
                      } else{
                        echo "<tr><td colspan='3'>Error: ".die( print_r( sqlsrv_errors(), true) )."</td></tr>";
                      }
                      sqlsrv_free_stmt($exe_get_by_category);
                      sqlsrv_close($conn);
                       ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <!-- <h5 class="card-title"></h5> -->
                  <canvas id="chart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">C</div> -->
    </div>
  </div>

  <script src="libs/jquery.min.js"></script>
  <script src="libs/popper.min.js"></script>
  <script src="libs/bootstrap.min.js"></script>
  <script src="libs/bootstrap-table.min.js"></script>
  <script src="libs/bootstrap-table-es-MX.min.js"></script>
  <script src="libs/tableExport.min.js"></script>
  <script src="libs/bootstrap-table-export.min.js"></script>
  <script type="text/javascript">
  let ctx = document.getElementById("chart").getContext('2d');
  let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo $labels; ?>,
      datasets: [{
        label: 'Con folio',
        backgroundColor: "#008d93",
        data: <?php echo $data_con; ?>
      }, {
        label: 'Sin folio',
        backgroundColor: "#2e5468",
        data: <?php echo $data_sin; ?>
      }],
    },
    options: {
      tooltips: {
        displayColors: true,
        callbacks: {
          mode: 'x',
        },
      },
      scales: {
        xAxes: [{
          stacked: true,
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          stacked: true,
          ticks: {
            beginAtZero: true,
          },
          type: 'linear',
        }]
      },
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: 'bottom'
      },
    }
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
  });

  let activeTab = localStorage.getItem('activeTab');
  if(activeTab){
      $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }
</script>
  <!--  -->
</body>

</html>
