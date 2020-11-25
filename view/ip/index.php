
<article class="article" style="text-align:center; min-height:300px;">
    <h1>Validera IP-adress</h1>
    <p>Ange en IP-adress att kontrollera</p>
    <form method="GET" action="ip/validateIp">
        <input name="ipAdress" type="text" value="<?= $data[0] ?>"><br><br>
        <input type="submit" value="Validera">
    </form>

    <h3>Validera IP-adress med JSON-resultat</h3>

    <form method="GET" action="ipApi/validateIpApi">
        <input name="ipAdress" type="text" value="<?= $data[0] ?>"><br><br>
        <input type="submit" value="Validera med JSON-resultat">
    </form>
</article>
