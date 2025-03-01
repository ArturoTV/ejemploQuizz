<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>QUIZZ EJEMPLO PHP</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    </head>
    <body>
        <?php
            include('./funciones.php');
            $mysqli = conectaBBDD();
        
            $consulta = $mysqli -> query("SELECT * FROM preguntas ;");
            $num_filas = $consulta -> num_rows;
            $listaPreguntas = array();
            
            for ($i = 0; $i<$num_filas; $i++){
                $resultado = $consulta ->fetch_array();
                $listaPreguntas[$i][0]= $resultado['numero'];
                $listaPreguntas[$i][1]= $resultado['tema'];
                $listaPreguntas[$i][2]= $resultado['enunciado'];
                $listaPreguntas[$i][3]= $resultado['r1'];
                $listaPreguntas[$i][4]= $resultado['r2'];
                $listaPreguntas[$i][5]= $resultado['r3'];
                $listaPreguntas[$i][6]= $resultado['r4'];
                $listaPreguntas[$i][7]= $resultado['correcta'];
            }
           
            $preguntaElegida = rand(0,$num_filas-1);
            $r1 = rand(3,6);
            $r2 = rand(3,6); while ($r2 == $r1){$r2 = rand(3,6);}
            $r3 = rand(3,6); while ($r3 == $r1 || $r3 == $r2){$r3 = rand(3,6);}
            $r4 = rand(3,6); while ($r4 == $r1 || $r4 == $r2 || $r4 == $r3){$r4 = rand(3,6);}
            
            $correcta = $listaPreguntas[$preguntaElegida][7];
        
//            $numeros = range(3, 6);
//            shuffle($numeros);
//            foreach ($numeros as $numero) {
//                echo "$numero ";
//            }
?>
        
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button  class="btn btn-block btn-warning disabled">
                        <?php echo $listaPreguntas[$preguntaElegida][2];?>
                    </button>
                    <br><br>
                    <button id="1" class="btn btn-block btn-primary " onclick="chequeaRespuesta('1');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r1];?>
                    </button> 
                    <br><br>
                    <button id="2" class="btn btn-block btn-primary " onclick="chequeaRespuesta('2');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r2];?>
                    </button> 
                    <br><br>
                    <button id="3"class="btn btn-block btn-primary " onclick="chequeaRespuesta('3')">
                        <?php echo $listaPreguntas[$preguntaElegida][$r3];?>
                    </button> 
                    <br><br>                                                            
                    <button id="4" class="btn btn-block btn-primary " onclick="chequeaRespuesta('4');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r4];?>
                    </button> 
                    <br>
                    <br>
<!--                    <button id="continuar" class="btn btn-default btn btn-block btn-primary" onclick="recarga();">
                       Continuar
                    </button>-->
                    <div id="continuar"></div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        
        
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
         <script>
            
            var respuesta = '<?php echo $correcta; ?>';
            
            function recarga(){
                location.reload();
            }
            function chequeaRespuesta(_respuesta){
                if( respuesta === _respuesta){
                   $('#continuar').append('<button class ="btn btn-info" onclick="recarga();">Continuar</button>');
                }
                else{
                    $('#continuar').append('<button class ="btn btn-danger" onclick="recarga();">Continuar</button>');
                }
            }
        </script>
    </body>
</html>
