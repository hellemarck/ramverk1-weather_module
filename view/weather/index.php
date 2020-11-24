
<article class="article" style="
    text-align:center;
    min-height:300px;
">
    <h1>Väderprognos och historik</h1>
    <p>Sök på koordinater (longitude,latitud) eller IP-adress för väderinformation om platsen</p>
    <form method="GET" action="weather/search">
        <input name="location" type="text" value="<?= $data[0] ?>"><br><br>
        <label><input type="radio" name="type" value="coming" checked> Kommande 7 dagar</label><br>
        <label><input type="radio" name="type" value="past"> Föregående 5 dagar</label><br><br>
        <input type="submit" value="Sök">
    </form>

    <p><i>Se <a src="
        http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/doc
        " style="color:#888;">dokumentationen</a> för att göra samma sökning via ett REST-API</i></p>

</article>
