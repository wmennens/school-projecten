<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>admin-page</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <img style="height:60px;width:300px;margin:50px;" src="//www.day-in-the-life.nl/wp-content/uploads/2018/02/logo-The-Full-Monty-def-langwerpig-1.gif" alt="Workshop">
    <div class="wrapper">
      <form class="aanmeld-form" action="" method="post">
        <label for="naam">Voor- en achternaam: <input style="margin-left:215px;" type="text" name="naam"></label><br>
        <label for="mail">Mail: <input style="margin-left:335px;" type="text" name="mail"></label><br>
        <label for="tel">Telefoon: <input style="margin-left:304px;" type="text" name="tel"></label><br>
        <label for="stad">Stad: <input style="margin-left:331px;" type="text" name="stad"></label><br>
        <label for="beschrijving">Wil je ons nog iets vragen / vertellen? Dan kan hier: <input style="margin-left:3px;" type="text" name="beschrijving"></label><br>
        <input type="submit" name="submit" value="Submit">
      </form>
      <div class="deelnemer-raster">
        <div class="orange-line">
          <img style="height:120px;margin-left:27%;" src="//www.day-in-the-life.nl/wp-content/uploads/2018/02/logo-The-Full-Monty-def-langwerpig-1.gif" alt="Workshop">
        </div>
      <?php
        //database connectie
        $dbc = new PDO('mysql:host=localhost;dbname=14511_database','root','');
        //variabelen in database stoppen
        if (isset($_POST['submit'])) {
          $stmt = $dbc->prepare("INSERT INTO 14511_funcontwerp VALUES (?,?,?,?,?,?,?,?)");

          $stmt->bindParam(1,$id);
          $stmt->bindParam(2,$naam);
          $stmt->bindParam(3,$mail);
          $stmt->bindParam(4,$tel);
          $stmt->bindParam(5,$stad);
          $stmt->bindParam(6,$beschrijving);
          $stmt->bindParam(7,$overeenkomst);
          $stmt->bindParam(8,$factuur);
          //sanitize
          $naam = htmlentities($naam, ENT_QUOTES, 'utf-8');
          $mail = htmlentities($mail, ENT_QUOTES, 'utf-8');
          $tel = htmlentities($tel, ENT_QUOTES, 'utf-8');
          $stad = htmlentities($stad, ENT_QUOTES, 'utf-8');
          $beschrijving = htmlentities($beschrijving, ENT_QUOTES, 'utf-8');

          $id = 0;
          $naam = $_POST['naam'];
          $mail = $_POST['mail'];
          $tel = $_POST['tel'];
          $stad = $_POST['stad'];
          $beschrijving = $_POST['beschrijving'];
          $overeenkomst = 0;
          $factuur = 0;

          $stmt->execute() or die("Error verturen.");

          $to = "14511@ma-web.nl";
          $subject = "Nieuwe aanmelding";
          $msg = "Er is een nieuwe deelnemer!";

          mail($to,$subject,$msg);

        }
        //deelnemers ophalen
        $stmt = $dbc->prepare("SELECT * FROM 14511_funcontwerp ORDER BY id");
        $stmt->execute() or die("Error ophalen.");
        $num_rows = $stmt->rowCount();
        if ($num_rows > 0) {
            while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
              ?>
                <form class="deelnemer" action="" method="post">
                  <p class=""><?php echo $row['id'];?></p>
                  <p class=""><?php echo $row['naam'];?></p>
                  <div class="link-box">
                    <a style="text-decoration: none;color: black;margin-left:260px;" href="index.php?del_id=<?php echo $row['id']; ?>">verwijder</a>
                    <a id="over" style="text-decoration: none;color: black;margin-left:50px;" href="index.php?over_id=<?php echo $row['id']; ?>">stuur overeenkomst </a><?php echo $row['overeenkomst']; ?>
                    <a id="fact" style="text-decoration: none;color: black;margin-left:50px;" href="index.php?fact_id=<?php echo $row['id']; ?>">stuur factuur </a><?php echo $row['factuur']; ?>
                  </div>
                  <div class="mail-ver">
                    <a style="text-decoration: none;color: black;" href="index.php?mail_id=<?php echo $row['id']; ?>">stuur mail</a>
                    <div class="mail-ver-content">
                      <label for="subject">Onderwerp</label><br>
                      <input type="text" name="subject"><br>
                      <label for="subject">Bericht</label><br>
                      <input type="text" name="message">
                      <p>Klaar? Druk enter.</p>
                    </div>
                  </div>
                  <div class="fact-herhaling">
                    <p>deel betaling</p>
                    <div class="fact-her-content">
                      <input type="submit" name="deel1" value="1 deel">
                      <input type="submit" name="deel2" value="2 delen">
                      <input type="submit" name="deel3" value="3 delen">
                      <input type="submit" name="deel4" value="4 delen">
                      <input type="submit" name="deel5" value="5 delen">
                    </div>
                  </div>
                  <div class="deelnemer-content">
                    <p style="margin-left:700px;margin-top:60px;"><?php echo $row['tel'];?></p>
                    <p style="margin-left:480px;margin-top:60px;"><?php echo $row['mail'];?></p>
                    <p style="margin-top:60px;width:400px;"><?php echo $row['beschrijving'];?></p>
                  </div>
                </form>
              <?php
            }
          } else {
            echo "geen deelnemers gevonden";
          }
          //verwijder deelnemer
          if (isset($_GET['del_id'])) {
            $id = $_GET['del_id'];
            $stmt2 = $dbc->prepare("DELETE FROM 14511_funcontwerp WHERE id='$id'");
            $stmt2->execute() or die("Error deleting.");
            unset($_GET['del_id']);
            echo "<script>alert('De deelnemer is verwijderd');</script>";
            echo "<script>window.location.replace('index.php')</script>";
          }
          //verwijder alle deelnemers
          if (isset($_GET['del_all'])) {
            $stmt2 = $dbc->prepare("TRUNCATE TABLE 14511_funcontwerp");
            $stmt2->execute() or die("Error deleting all.");
            unset($_GET['del_all']);
            echo "<script>alert('De alle deelnemers zijn verwijderd');</script>";
            echo "<script>window.location.replace('index.php')</script>";
          }
          //verstuur overeenkomst
          if (isset($_GET['over_id'])) {
                $id = $_GET['over_id'];
                $stmt2 = $dbc->prepare("SELECT overeenkomst FROM 14511_funcontwerp WHERE id=$id");
                $stmt2->execute() or die("Error overeenkomst updaten.");
                $row=$stmt2->fetch(PDO::FETCH_ASSOC);
                $rows = $row['overeenkomst'];

                if ($rows == 1) {
                  echo "<script>alert('De overeenkomst is al gestuurd naar dzeze deelnemer');</script>";
                  echo "<script>window.location.replace('index.php')</script>";
                } else {
                  $stmt2 = $dbc->prepare("UPDATE 14511_funcontwerp SET overeenkomst='1' WHERE id=$id");
                  $stmt2->execute() or die("Error overeenkomst ophalen.");
                  if (isset($_GET['over_id'])) {
                    $stmt2 = $dbc->prepare("SELECT * FROM 14511_funcontwerp WHERE id=$id");
                    $stmt2->execute() or die("Error gegeven voor overeenkomst ophalen.");
                    //PDF genereren en opslaan
                    require('pdf/Fpdf/fpdf.php');

                    $row=$stmt2->fetch(PDO::FETCH_ASSOC);
                    $id = $row['id'];
                    $naam = $row['naam'];
                    $mail = $row['mail'];
                    //A4 width : 219mm
                    //default margin : 10mm each side
                    //writable horizontal : 219-(10*2)=189mm

                    $pdf = new FPDF('p', 'mm', 'a4');

                    $pdf->AddPage();
                    //set font to arial, bold, 14pt
                    $pdf->SetFont('Arial','B','14');

                    //Cell(width , height , text , border , end line , [align] )
                    $pdf->Cell(130,5,'overeenkomst ',1,0 );
                    $pdf->Cell(59,5,'overeenkomst 2',1,1);

                    //set font to arial, regular, 12pt
                    $pdf->SetFont('Arial','','12');

                    $pdf->Cell(130,5,'[test1]',1,0);
                    $pdf->Cell(59,5,'[test 2]',1,1);

                    $filename = "C:\wamp64\www\opdrJacquelineFuncOnt\pdf\pdfjes/$id-$naam-overeenkomst.pdf";
                    $pdf->Output($filename,'F');

                    //attach pdf to mail
                    $file_tmp_name = "pdf/pdfjes/$id-$naam-overeenkomst.pdf";
                    $file_size = 400000;

                    $handle = fopen($file_tmp_name, "r");
                    $content = fread($handle, $file_size);
                    fclose($handle);
                    $encoded_content = chunk_split(base64_encode($content));

                    $from_email = '14511@ma-web.nl';
                    $reply_to_email = '14511@ma-web.nl';

                    $boundary = md5("sanwebe");
                    $message = 'Dit is een test.';

                    //header
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "From:".$from_email."\r\n";
                    $headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
                    $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

                    //plain text
                    $body = "--$boundary\r\n";
                    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
                    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                    $body .= chunk_split(base64_encode($message));

                    //attachment
                    $body .= "--$boundary\r\n";
                    // LET OP FILETYPE
                    $body .="Content-Type: PDF; name=".$file_tmp_name."\r\n";
                    $body .="Content-Disposition: attachment; filename=".$file_tmp_name."\r\n";
                    $body .="Content-Transfer-Encoding: base64\r\n";
                    $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
                    $body .= $encoded_content;

                    $recipient_email = '14511@ma-web.nl';
                    $subject = 'Testing testing';

                    $sentMail = mail($recipient_email, $subject, $body, $headers);

                    //output success or failure messages
                    if($sentMail) {
                        die('Thank you for your email');
                        echo "<script>window.location.replace('index.php')</script>";
                    }else{
                        die('Could not send mail! Please check your PHP mail configuration.');
                    }
                    }else {
                      echo "Error pdf kon niet gegenereerd worden";
                    }
                      }
                    }

          //verstuur Factuur
          if (isset($_GET['fact_id'])) {
                  $id = $_GET['fact_id'];
                  $stmt2 = $dbc->prepare("SELECT factuur FROM 14511_funcontwerp WHERE id=$id");
                  $stmt2->execute() or die("Error factuur updophalenaten.");
                  $row=$stmt2->fetch(PDO::FETCH_ASSOC);
                  $rows = $row['factuur'];

                  if ($rows == 1) {
                    echo "<script>alert('De factuur is al gestuurd naar dzeze deelnemer');</script>";
                    echo "<script>window.location.replace('index.php')</script>";
                  } else {
                    $stmt2 = $dbc->prepare("UPDATE 14511_funcontwerp SET factuur='1' WHERE id=$id");
                    $stmt2->execute() or die("Error factuur updaten.");
                    unset($_GET['fact_id']);
                    echo "<script>window.location.replace('index.php')</script>";

                    $to = "14511@ma-web.nl";
                    $subject = "Factuur";
                    $msg = "Dit is de Factuur!";
                    $header = "From: jacqueline";
                    mail($to,$subject,$msg,$header);
                  }
                }
          //mail deelnemer
          if (isset($_GET['mail_id'])) {
            $id = $_GET['mail_id'];
            $stmt2 = $dbc->prepare("SELECT mail FROM 14511_funcontwerp WHERE id like $id");
            $stmt2->execute() or die("Error mail versturen.");
            $row=$stmt2->fetch(PDO::FETCH_ASSOC);
            unset($_GET['mail_id']);

            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $to = $row['mail'];
            $header = "From: Jacqueline";

            mail($to,$subject,$message,$header);
          }
          //mail alle deelnemers
          if (isset($_POST['sub-mail-all'])) {
            $subject = $_POST['sub-all'];
            $message = $_POST['msg-all'];

            echo $subject,$message;

            $stmt2 = $dbc->prepare("SELECT mail FROM 14511_funcontwerp ORDER BY id");
            $stmt2->execute() or die("Error alle deelnemers mailen");

            while ($row=$stmt2->fetch(PDO::FETCH_ASSOC)) {
              $to = $row['mail'];
              $header = "From: Jacqueline";

              mail($to,$subject,$message,$header);
            }
          }
       ?>
     </div>
     <a style="margin-left: 38%;color:black;text-decoration:none;font-size:210%;padding:20px;background-color: hsla(33,100%,50%,0.92)" href="index.php?del_all">verwijder alle gebrijkers</a>
     <form class="mail-all-form" action="" method="post">
       <h1>Mail alle gebriuikers</h1>
       <label for="sub-all">Onderwerp<input type="text" name="sub-all"></label><br>
       <label for="msg-all">Bericht<input type="text" name="msg-all"></label>
       <input style="border:none;font-size: 150%;padding:20px;margin-left:100px;background-color: hsla(33,100%,50%,0.92);" type="submit" name="sub-mail-all" value="alle deelnemers mailen">
     </form>
    </div>
  </body>
</html>
