<?php
  //Connecting to sql db.
  $connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");
  mysqli_set_charset($connect, "utf8");

  mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

  $ClientID = mysqli_real_escape_string($connect,$_POST["ClientID"]);

  $query = "SELECT ID,descricao,flexFlow,height,width,fontFamily,fontSize,color,border,borderRadius,fontWeight,background FROM style WHERE IDClient = $ClientID";
  $result=mysqli_query($connect,$query);
    echo "<tr style='pointer-events:none'><td>Descrição<td>Orientação<td>Altura<td>Comprimento<td>Tipo de Letra<td>Tamanho de Letra<td>Cor de Letra<td>Estilo da Borda<td>Arco da Borda<td>Grossura da Letra<td>Fundo</tr>";  
  while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
  echo "<tr><td style='display:none'>".$row["ID"]."<td>".$row['descricao']."<td>".($row["flexFlow"]=="row wrap"?"Horizontal":"Vertical")."<td>".$row['height']."<td>".$row['width']."<td>".$row['fontFamily']."<td>".$row['fontSize']."<td style='background-color:".$row['color'].";'><td style='border:".$row['border'].";'><td>".$row['borderRadius']."<td>".($row["fontWeight"]=="bold"?"Negrito":"Normal")."<td style='background:".$row['background'].";'></tr>";
  };

  mysqli_close($connect);
?>