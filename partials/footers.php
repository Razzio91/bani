</body>
<footer>
  <strong>
    <h5>Contact:<br>
      -----------------------------------------------------------<br>
      Bani | Supermarkt<br>
      Adres: DieEneAdresVanBani 1 <br>
      Postcode: 1111 AA Amsterergens<br><br>

      Telefoonnummer: 020-1234567<br>
      E-mail: Bani@Supermarkt.nl<br><br>


      Bani is telefonisch bereikbaar op werkdagen, <br>tussen 09:00 en 18:00</h5>



  </strong>

  <strong>
    <h5>Openingstijden:<br>
      -------------------------------------- <br>
      Maandag: 08:00 - 18:00<br>
      Dinsdag: 08:00 - 16:00<br>
      Woensdag: 08:00 - 10:00<br>
      Donderdag: 08:00 - 11:00<br>
      Vrijdag: 08:00 - 15:00<br>
      Zaterdag: 08:00 - 10:00<br>
      Zondag: 08:00 - 08:10<br>
      Feestdagen: Dicht</h5>
  </strong>
  <h5>
    <Strong>Menu</Strong><br>
    ----------------------------------- <br>
    <?php if ((!isset($_SESSION["klant_id"]))) : ?>

      <a href="login.php">Login</a><br>
      <a href="signup.php">Registreren</a><br>
    <?php else : ?>
      <a href="categories.php">Categorieën</a><br>
      <a href="#">Bestelling</a><br>
    <?php endif ?>



  </h5>
</footer>

</html>