<article class="article" style="text-align:center; min-height:300px;">
    <div style="
        background-color:#ececec;
        width:500px;
        margin:40px auto;
        padding:20px;
        border:1px solid #888;
    ">
        <h1 class="heading">Resultat</h1>
        <div style="width:400px;margin: 0 auto;text-align:left;">
            <p><?= $data["valid"] ?><br>
            <?= $data["domain"] ?></p>

            <p><b>Stad:</b> <?= $data["location"]["city"] ?><br>
            <b>Land:</b> <?= $data["location"]["country_name"] ?><br>
            <b>Longitud:</b> <?= $data["location"]["longitude"] ?><br>
            <b>Latitud:</b> <?= $data["location"]["latitude"] ?></p><br>
        </div>
    <a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ip" style="
        color:#666;
        background-color:white;
        padding:10px;
        text-decoration:none;
        border: 1px solid #888;
    ">BÖRJA OM</a>
    <br><br>
    </div>
</article>
