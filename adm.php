<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adm</title>
    <!-- link rel="stylesheet" type="text/css" media="screen" href="main.css" -->
</head>
<body>
    <!-- form cadastro de jornalista -->
    <fieldset> <legend> Cadastro de jornalista </legend> 
        <form action="jornalista.php" method="post" enctype="multipart/form-data">
        <table>
        <tr>
            <td>Digite Nome:</td> <td><input type="text" name="nome"></td>
        </tr>
        <tr> 
            <td>Selecione Sexo:</td> 
            <td><input type="radio" name="sexo" value="m"> Masculino 
            <input type="radio" name="sexo" value="f"> Feminino</td> 
		</tr>
        <tr>
            <td>Digite Celular:</td> <td><input type="text" name="Cel"></td>
        </tr> 
        <tr>
            <td>Digite email:</td>   <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Digite Senha:</td> <td><input type="password" name="senha"></td>
        <tr>
        <tr>
            <td>Foto:</td> <td><input type = "file" name = "foto"></td>
        </tr>
        <tr>
            <td><input type = "submit" value = "Cadastrar"></td>
        </tr>
        </table>
        </form>
    </fieldset>

    <p> <a href="upJornalista.php"> Atualizar Jornalista </a> </p>
    <p> <a href="delJornalista.php">  Deletar Jornalista </a> </p> 
    


</body>
</html>


