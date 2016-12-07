<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
/**
 * @author Amin Debli
 * 
 * Condición para comprobar si Reiniciar esta definicido para reiniciar el "juego".
 */
if (!isset($_POST['Reiniciar'])) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
            <style>
                *{
                    margin: 0 auto;
                }
                body{
                    width: 1000px;
                    height: 800px;
                    margin: 0 auto;
                    text-align: center;

                }
                h1{
                    color:red;
                    padding:20px;
                }
                fieldset{
                    background-color: lightgoldenrodyellow;
                    margin-top: 200px;
                }
            </style>
        </head>
        <body>
            <form action="index.php" method="post">
                <fieldset>
                    <h1>Adivina el número</h1>
                    <p>Inserta el numero, tienes 10 intentos:</p>
                    <input type="number" min="0"  name="numero1" id="n1">

                    <?php
                    /**
                     * @author Amin Debli
                     * 
                     * Contador para controlar el numero de intentos. 
                     * Si el contador ya esta definido, se ira incrementando +1.
                     * Si no, se genera el contador con valor 0.
                     */
                    // contador
                    if (isset($_POST['contador'])) {
                        $contador = $_POST['contador'];
                        $contador = $contador + 1;
                        echo '<input type="hidden"  name="contador" value="' . $contador . '">';
                    } else {
                        echo '<input type="hidden"  name="contador" value="0">';
                        $contador = 0;
                        
                    }

                    /**
                     * @author Amin Debli
                     * 
                     * Se genera el número random que vamos a tener que adivinar.
                     * si el numero insertado en el formulario está definido, el valor del numero que buscamos se almacena
                     * en la variable num1.
                     * Si no esta definido, se crea el numero random que se va a tener que adivinar.
                     */
                    if (isset($_POST['numero1'])) {
                        $num1 = $_POST['num'];
                        echo '<input type="hidden"  name="num" value="' . $num1 . '">';
                    } else {
                        global $num1;
                        $num1 = rand(1, 50); 
                        echo '<input type="hidden"  name="num" value="' . $num1 . '">';
                    }
                    ?>

                    <input type="submit" value="Aceptar"> 

                    <?php
                    /**
                     * @author Amin Debli
                     * Si el numero1 esta definido y el contador és menor o igual a 10,
                     * entramos en los bucles.
                     * Si el numero que buscamos es igual al numero insertado, lo habremos adivinado y mostraremos el boton para reiniciar el juego.
                     * También si el numero insertado es menor que el numero que buscamos, saldrá un mensaje como que el numero que buscamos es mayor.
                     * Lo mismo pasará pero al revés.
                     * 
                     * En cada momento no adivinado, se imprimirá el numero de intentos que has consumido.
                     * 
                     * Si el contador llega a 10, saldrá un mensaje como que has superado el numero de intentos y saldrá el
                     * boton para reiniciar.
                     * 
                     */
                    if (isset($_POST['numero1']) and $contador <= 10) {
                        $num2 = $_POST['numero1'];
                        if ($num2 == $num1) {
                            echo "<br/>" . "Lo has adivinado!";
                            echo "<form action='index.php' method='post'><input type='hidden' name='Reiniciar'><input type='submit' value='Reiniciar'></form>";
                        } else if ($num2 < $num1) {
                            echo "<br/>" . "El número és Mayor" . "<br/>";
                            echo "Numero de intentos: " . $contador;
                        } else if ($num2 > $num1) {
                            echo "<br/>" . "El número és Menor" . "<br/>";
                            echo "Numero de intentos: " . $contador;
                        }
                    } else if ($contador > 10) {
                        echo "<br/>" . "Has alcanzado el máximo intentos" . "<br/>";
                        echo "<form action='index.php' method='post'><input type='hidden' name='Reiniciar'><input type='submit' value='Reiniciar'></form>";
                    }
                    ?>
                </fieldset>

            </form>
        </body>
    </html>
    <?php
    /**
     * @author Amin Debli
     * Para reiniciar la página desde cero como si reinciasemos el navegador y asi los $_POST desaparecen.
     */
} else {
    header('Location: index.php');
}
?>